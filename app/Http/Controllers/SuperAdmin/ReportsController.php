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

        // Global Statistics
        $globalStats = [
            'registered_users' => \App\Models\User::where('role_type', 'user')->count(),
            'purchased_modules' => \App\Models\Order::where('payment_status', \App\Enums\PaymentStatus::Completed)->count(),
            'modules_completed' => \App\Models\CourseTestAttempt::where('status', \App\Models\CourseTestAttempt::STATUS_COMPLETED)
                ->where('test_type', \App\Enums\CourseTestType::Final)
                ->where('passed', true)
                ->count(),
        ];

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
                $stateUsers = \App\Models\User::where('role_type', 'user')->get()
                    ->filter(fn($u) => trim((string)$u->state) === trim($selectedState->name));
                
                $nursesCount = $stateUsers->count();
                $stateUserIds = $stateUsers->pluck('id')->toArray();

                // Module-wise pass counts (Show all courses assigned to this state)
                $stateCourses = \App\Models\CourseDetail::whereHas('stateCouncils', function($q) use ($councilIds) {
                    $q->whereIn('state_councils.id', $councilIds);
                })->get();

                $passCounts = \App\Models\CourseTestAttempt::where(function($q) use ($councilIds, $stateUserIds) {
                        $q->whereIn('state_council_id', $councilIds)
                          ->orWhereIn('user_id', $stateUserIds);
                    })
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

                $purchasedModulesCount = \App\Models\Order::where(function($q) use ($councilIds, $stateUserIds) {
                        $q->whereIn('state_council_id', $councilIds)
                          ->orWhereIn('user_id', $stateUserIds);
                    })
                    ->where('payment_status', \App\Enums\PaymentStatus::Completed)
                    ->count();
            }
        }

        return view('super-admin.reports.index', [
            'title' => 'Reports',
            'states' => $states,
            'selectedState' => $selectedState,
            'stateCourses' => $stateCourses,
            'nursesCount' => $nursesCount,
            'modulesCompletedCount' => $modulesCompletedCount,
            'purchasedModulesCount' => $purchasedModulesCount ?? 0,
            'moduleWisePassed' => $moduleWisePassed,
            'globalStats' => $globalStats,
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

        $stateUserIds = \App\Models\User::where('role_type', 'user')->get()
            ->filter(fn($u) => trim((string)$u->state) === trim($selectedState->name))
            ->pluck('id')->toArray();

        // User Performance Report
        $query = \App\Models\CourseTestAttempt::with(['user', 'courseDetail'])
            ->where(function($q) use ($councilIds, $stateUserIds) {
                $q->whereIn('state_council_id', $councilIds)
                  ->orWhereIn('user_id', $stateUserIds);
            })
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

        if ($examType === 'passed') {
            $query->where('passed', true);
        } elseif ($examType) {
            $query->where('test_type', $examType);
        }

        $attempts = $query->latest('completed_at')->get();

        // Fetch all relevant orders to match attempts for grouping
        $userIds = $attempts->pluck('user_id')->unique();
        $courseIds = $attempts->pluck('course_detail_id')->unique();
        $orders = \App\Models\Order::whereIn('user_id', $userIds)
            ->whereIn('course_detail_id', $courseIds)
            ->where('payment_status', \App\Enums\PaymentStatus::Completed)
            ->get();

        // Group by user, course, and order period
        $grouped = $attempts->groupBy(function ($attempt) use ($orders) {
            $order = $orders->where('user_id', $attempt->user_id)
                ->where('course_detail_id', $attempt->course_detail_id)
                ->filter(fn($o) => $attempt->started_at->greaterThanOrEqualTo($o->created_at->subMinutes(5)))
                ->sortByDesc('created_at')
                ->first();
            
            if (!$order) {
                $order = $orders->where('user_id', $attempt->user_id)
                    ->where('course_detail_id', $attempt->course_detail_id)
                    ->filter(fn($o) => $attempt->started_at->between($o->start_date->startOfDay(), $o->end_date->endOfDay()))
                    ->sortByDesc('created_at')
                    ->first();
            }
            
            $orderId = $order ? $order->id : 'no_order';
            return $attempt->user_id . '_' . $attempt->course_detail_id . '_' . $orderId;
        });

        $userAttempts = $grouped->map(function ($group) {
            $first = $group->first();
            $pre = $group->where('test_type', \App\Enums\CourseTestType::Pre)->sortByDesc('score_percent')->first();
            $mock = $group->where('test_type', \App\Enums\CourseTestType::Mock)->sortByDesc('score_percent')->first();
            
            $finalAttempts = $group->where('test_type', \App\Enums\CourseTestType::Final)->sortBy('completed_at');
            $final1 = $finalAttempts->first();
            $final2 = $finalAttempts->count() > 1 ? $finalAttempts->skip(1)->first() : null;

            return (object)[
                'id' => $first->user_id,
                'sequence_number' => $first->user->unique_sequence_number ?? 'N/A',
                'user_name' => $first->user->name ?? 'Unknown',
                'rn_number' => $first->user->rn_number ?? 'N/A',
                'phone' => $first->user->phone ?? '-',
                'email' => $first->user->email ?? '-',
                'course_name' => $first->courseDetail->couse_name ?? 'Unknown',
                'pre_score' => $pre ? $pre->score_percent : '-',
                'mock_score' => $mock ? $mock->score_percent : '-',
                'final_score_1' => $final1 ? $final1->score_percent : '-',
                'final_score_2' => $final2 ? $final2->score_percent : '-',
                'date_of_completion' => $first->completed_at ? $first->completed_at->format('d-m-Y') : '-',
                'time_of_completion' => $first->completed_at ? $first->completed_at->format('h:i A') : '-',
                'score' => $final1 ? $final1->score_percent : ($mock ? $mock->score_percent : ($pre ? $pre->score_percent : '-')),
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

        $stateUserIds = \App\Models\User::where('role_type', 'user')->get()
            ->filter(fn($u) => trim((string)$u->state) === trim($selectedState->name))
            ->pluck('id')->toArray();

        $query = \App\Models\CourseTestAttempt::with(['user', 'courseDetail'])
            ->where(function($q) use ($councilIds, $stateUserIds) {
                $q->whereIn('state_council_id', $councilIds)
                  ->orWhereIn('user_id', $stateUserIds);
            })
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
        if ($examType === 'passed') {
            $query->where('passed', true);
        } elseif ($examType) {
            $query->where('test_type', $examType);
        }

        $attempts = $query->latest('completed_at')->get();

        // Fetch all relevant orders to match attempts for grouping
        $userIds = $attempts->pluck('user_id')->unique();
        $courseIds = $attempts->pluck('course_detail_id')->unique();
        $orders = \App\Models\Order::whereIn('user_id', $userIds)
            ->whereIn('course_detail_id', $courseIds)
            ->where('payment_status', \App\Enums\PaymentStatus::Completed)
            ->get();

        // Group by user, course, and order period
        $grouped = $attempts->groupBy(function ($attempt) use ($orders) {
            $order = $orders->where('user_id', $attempt->user_id)
                ->where('course_detail_id', $attempt->course_detail_id)
                ->filter(fn($o) => $attempt->started_at->between($o->start_date->startOfDay(), $o->end_date->endOfDay()))
                ->first();
            
            $orderId = $order ? $order->id : 'no_order';
            return $attempt->user_id . '_' . $attempt->course_detail_id . '_' . $orderId;
        });

        $filename = "ventura_user_performance_" . strtolower(str_replace(' ', '_', $selectedState->name)) . "_" . date('Ymd') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($grouped, $examType) {
            $file = fopen('php://output', 'w');
            
            $header = ['UID', 'Name', 'RN', 'Mobile No', 'Mail ID', 'Module name', 'Date of completion', 'Time of completion', 'Score (%)'];
            fputcsv($file, $header);

            foreach ($grouped as $group) {
                $first = $group->first();
                $pre = $group->where('test_type', \App\Enums\CourseTestType::Pre)->sortByDesc('score_percent')->first();
                $mock = $group->where('test_type', \App\Enums\CourseTestType::Mock)->sortByDesc('score_percent')->first();
                
                $finalAttempts = $group->where('test_type', \App\Enums\CourseTestType::Final)->sortBy('completed_at');
                $final1 = $finalAttempts->first();
                $final2 = $finalAttempts->count() > 1 ? $finalAttempts->skip(1)->first() : null;

                $score = $final1 ? $final1->score_percent : ($mock ? $mock->score_percent : ($pre ? $pre->score_percent : 0));
                
                $row = [
                    $first->user->unique_sequence_number ?? 'N/A',
                    $first->user->name ?? 'Unknown',
                    $first->user->rn_number ?? 'N/A',
                    $first->user->phone ?? '-',
                    $first->user->email ?? '-',
                    $first->courseDetail->couse_name ?? 'Unknown',
                    $first->completed_at ? $first->completed_at->format('d-m-Y') : '-',
                    $first->completed_at ? $first->completed_at->format('h:i A') : '-',
                    is_numeric($score) ? round($score) . '%' : '-',
                ];

                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
