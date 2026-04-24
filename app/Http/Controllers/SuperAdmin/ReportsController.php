<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function index(Request $request): View
    {
        $states = \App\Models\State::where('status', 'active')->orderBy('name')->get();
        $selectedStateId = $request->query('state_id');

        $selectedState = null;
        $nursesCount = 0;
        $modulesCompletedCount = 0;
        $moduleWisePassed = collect();
        $stateCourses = collect();

        if ($selectedStateId) {
            $selectedState = \App\Models\State::find($selectedStateId);
            if ($selectedState) {
                $stateCouncils = \App\Models\StateCouncil::where('state_id', $selectedState->id)->get();
                $councilIds = $stateCouncils->pluck('id')->toArray();

                // Count nurses (Filtered in-memory due to encryption)
                $nursesCount = \App\Models\User::where('role_type', 'user')
                    ->get()
                    ->filter(fn($u) => trim((string)$u->state) === trim($selectedState->name))
                    ->count();

                // Module-wise pass counts (Show all courses assigned to this state)
                $stateCourses = \App\Models\CourseDetail::whereHas('stateCouncils', function($q) use ($councilIds) {
                    $q->whereIn('state_councils.id', $councilIds);
                })->get();

                $passCounts = \App\Models\CourseTestAttempt::whereIn('state_council_id', $councilIds)
                    ->where('status', \App\Models\CourseTestAttempt::STATUS_COMPLETED)
                    ->where('passed', true)
                    ->select('course_detail_id', \Illuminate\Support\Facades\DB::raw('count(*) as passed_count'))
                    ->groupBy('course_detail_id')
                    ->pluck('passed_count', 'course_detail_id');

                $moduleWisePassed = $stateCourses->map(function ($course) use ($passCounts) {
                    return (object)[
                        'id' => $course->id,
                        'name' => $course->couse_name ?? 'Unknown',
                        'passed_count' => $passCounts[$course->id] ?? 0
                    ];
                });

                $modulesCompletedCount = $passCounts->sum();
            }
        }

        return view('super-admin.reports.index', [
            'title' => 'Reports',
            'states' => $states,
            'selectedState' => $selectedState,
            'stateCourses' => $stateCourses,
            'nursesCount' => $nursesCount,
            'modulesCompletedCount' => $modulesCompletedCount,
            'moduleWisePassed' => $moduleWisePassed,
        ]);
    }

    public function userPerformance(Request $request): View
    {
        $selectedStateId = $request->query('state_id');
        $selectedCourseId = $request->query('course_id');
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');
        $examType = $request->query('exam_type');

        $selectedState = \App\Models\State::findOrFail($selectedStateId);
        $stateCouncils = \App\Models\StateCouncil::where('state_id', $selectedState->id)->get();
        $councilIds = $stateCouncils->pluck('id')->toArray();

        $stateCourses = \App\Models\CourseDetail::whereHas('stateCouncils', function($q) use ($councilIds) {
            $q->whereIn('state_councils.id', $councilIds);
        })->get();

        // User Performance Report
        $query = \App\Models\CourseTestAttempt::with(['user', 'courseDetail'])
            ->whereIn('state_council_id', $councilIds)
            ->where('status', \App\Models\CourseTestAttempt::STATUS_COMPLETED);

        if ($selectedCourseId) {
            $query->where('course_detail_id', $selectedCourseId);
        }

        if ($fromDate) {
            $query->whereDate('completed_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('completed_at', '<=', $toDate);
        }

        if ($examType) {
            $query->where('test_type', $examType);
        }

        $attempts = $query->latest('completed_at')->get();

        // Group by user and course to get the best scores for each type
        $grouped = $attempts->groupBy(fn($a) => $a->user_id . '_' . $a->course_detail_id);

        $userAttempts = $grouped->map(function ($group) {
            $first = $group->first();
            $pre = $group->where('test_type', \App\Enums\CourseTestType::Pre)->sortByDesc('score_percent')->first();
            $mock = $group->where('test_type', \App\Enums\CourseTestType::Mock)->sortByDesc('score_percent')->first();
            $final = $group->where('test_type', \App\Enums\CourseTestType::Final)->sortByDesc('score_percent')->first();

            return (object)[
                'user_name' => $first->user->name ?? 'Unknown',
                'ihs_id' => $first->user->rn_number ?? 'N/A',
                'course_name' => $first->courseDetail->couse_name ?? 'Unknown',
                'pre_score' => $pre ? number_format($pre->score_percent, 2) : '-',
                'mock_score' => $mock ? number_format($mock->score_percent, 2) : '-',
                'final_score' => $final ? number_format($final->score_percent, 2) : '-',
                'completed_on' => $first->completed_at->format('d-m-Y'),
            ];
        });

        return view('super-admin.reports.user-performance', [
            'title' => 'User Performance Report',
            'selectedState' => $selectedState,
            'stateCourses' => $stateCourses,
            'userAttempts' => $userAttempts,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $selectedStateId = $request->query('state_id');
        $selectedCourseId = $request->query('course_id');
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');
        $examType = $request->query('exam_type');

        $selectedState = \App\Models\State::findOrFail($selectedStateId);
        $stateCouncils = \App\Models\StateCouncil::where('state_id', $selectedState->id)->get();
        $councilIds = $stateCouncils->pluck('id')->toArray();

        $query = \App\Models\CourseTestAttempt::with(['user', 'courseDetail'])
            ->whereIn('state_council_id', $councilIds)
            ->where('status', \App\Models\CourseTestAttempt::STATUS_COMPLETED);

        if ($selectedCourseId) {
            $query->where('course_detail_id', $selectedCourseId);
        }
        if ($fromDate) {
            $query->whereDate('completed_at', '>=', $fromDate);
        }
        if ($toDate) {
            $query->whereDate('completed_at', '<=', $toDate);
        }
        if ($examType) {
            $query->where('test_type', $examType);
        }

        $attempts = $query->latest('completed_at')->get();
        $grouped = $attempts->groupBy(fn($a) => $a->user_id . '_' . $a->course_detail_id);

        $filename = "user_performance_" . strtolower(str_replace(' ', '_', $selectedState->name)) . "_" . date('Ymd') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($grouped) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'IHS ID', 'Module Name', 'Pre-Test', 'Mock Exam', 'Final', 'Completed On']);

            foreach ($grouped as $group) {
                $first = $group->first();
                $pre = $group->where('test_type', \App\Enums\CourseTestType::Pre)->sortByDesc('score_percent')->first();
                $mock = $group->where('test_type', \App\Enums\CourseTestType::Mock)->sortByDesc('score_percent')->first();
                $final = $group->where('test_type', \App\Enums\CourseTestType::Final)->sortByDesc('score_percent')->first();

                fputcsv($file, [
                    $first->user->name ?? 'Unknown',
                    $first->user->rn_number ?? 'N/A',
                    $first->courseDetail->couse_name ?? 'Unknown',
                    $pre ? number_format($pre->score_percent, 2) : '-',
                    $mock ? number_format($mock->score_percent, 2) : '-',
                    $final ? number_format($final->score_percent, 2) : '-',
                    $first->completed_at->format('d-m-Y'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
