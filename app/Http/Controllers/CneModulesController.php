<?php

namespace App\Http\Controllers;

use App\Enums\CourseTestType;
use App\Models\CourseDetail;
use App\Models\CourseTestAttempt;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class CneModulesController extends Controller
{
    /**
     * Public CNE modules listing: active courses ordered by sequence.
     */
    public function index(): View
    {
        $query = CourseDetail::query()
            ->where('active_status', 1);

        $user = auth()->user();
        if ($user && $user->role_type === 'user' && filled($user->state)) {
            $stateName = trim((string) $user->state);
            $query->with(['stateCouncils' => function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            }])->whereHas('stateCouncils', function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            });
        }

        $courses = $query
            ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get();

        $purchasedCourseIds = collect();

        if ($user && $user->role_type === 'user') {
            $purchasedCourseIds = Order::purchasedCourseDetailIdsFor($user);
        }

        return view('cne-modules', [
            'courses' => $courses,
            'purchasedCourseIds' => $purchasedCourseIds,
        ]);
    }

    /**
     * General practice test landing page: lists all active modules.
     */
    public function practiceIndex(): View
    {
        $query = CourseDetail::query()
            ->where('active_status', 1);

        $user = auth()->user();
        if ($user && $user->role_type === 'user' && filled($user->state)) {
            $stateName = trim((string) $user->state);
            $query->with(['stateCouncils' => function ($stateCouncilQuery) use ($stateName) {
                $stateCouncilQuery
                    ->where('active_status', true)
                    ->whereHas('state', function ($stateQuery) use ($stateName) {
                        $stateQuery->where('name', $stateName)->where('status', 'active');
                    });
            }]);
        }

        $courses = $query
            ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get();

        $purchasedCourseIds = collect();
        if ($user && $user->role_type === 'user') {
            $purchasedCourseIds = Order::purchasedCourseDetailIdsFor($user);
        }

        return view('practice-landing', [
            'courses' => $courses,
            'purchasedCourseIds' => $purchasedCourseIds,
            'title' => 'Practice Test',
        ]);
    }

    /**
     * Single module: description, attachment, Q&A and practice content.
     */
    public function show(CourseDetail $course_detail): View
    {
        if ((int) $course_detail->active_status !== 1) {
            abort(404);
        }
        $hasCourseMaterials = $course_detail->materials()
            ->where('active_status', true)
            ->whereHas('courseTitle', function ($titleQuery) {
                $titleQuery->where('active_status', true);
            })
            ->exists();

        $activeOrder = null;
        $isPurchased = false;
        $viewer = auth()->user();

        if ($viewer && $viewer->role_type === 'user') {
            $activeOrder = Order::activeOrderFor($viewer, $course_detail);
            $isPurchased = (bool) $activeOrder;
        }

        $courseTestProgress = null;
        if ($viewer && $viewer->role_type === 'user' && $isPurchased) {
            $preAttempt = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Pre->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->when($activeOrder, fn($q) => $q->where('started_at', '>=', $activeOrder->created_at))
                ->latest('id')
                ->first();

            $mockAttempt = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Mock->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->when($activeOrder, fn($q) => $q->where('started_at', '>=', $activeOrder->created_at))
                ->latest('id')
                ->first();

            $finalAttempts = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Final->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->when($activeOrder, fn($q) => $q->where('started_at', '>=', $activeOrder->created_at))
                ->latest('id')
                ->get();

            $finalAttempt = $finalAttempts->first();
            $finalAttemptCount = $finalAttempts->count();

            $formatDuration = function($seconds) {
                if ($seconds === null) return '—';
                $seconds = (int) $seconds;
                return sprintf('%d:%02d', floor($seconds / 60), $seconds % 60);
            };

            $levelWeightsRaw = \App\Models\LevelScore::first();
            $weights = [
                1 => (int) ($levelWeightsRaw->level_1 ?? 1),
                2 => (int) ($levelWeightsRaw->level_2 ?? 2),
                3 => (int) ($levelWeightsRaw->level_3 ?? 3),
            ];

            $calculateLevelStats = function($attempt) use ($weights) {
                if (!$attempt) return ['l1' => '0/0', 'l2' => '0/0', 'l3' => '0/0', 'obtained' => 0, 'max' => 0];
                
                $results = \App\Models\CourseTestAnswer::query()
                    ->where('course_test_attempt_id', $attempt->id)
                    ->join('course_questions', 'course_test_answers.course_question_id', '=', 'course_questions.id')
                    ->select('course_questions.question_level', 'course_test_answers.is_correct')
                    ->get();

                $stats = [
                    1 => ['correct' => 0, 'total' => 0],
                    2 => ['correct' => 0, 'total' => 0],
                    3 => ['correct' => 0, 'total' => 0],
                ];

                $obtained = 0;
                $max = 0;

                foreach ($results as $row) {
                    $levelStr = (string) ($row->question_level ?? 'Level 1');
                    $levelNum = 1;
                    if (str_contains($levelStr, '2')) $levelNum = 2;
                    elseif (str_contains($levelStr, '3')) $levelNum = 3;

                    $weight = $weights[$levelNum] ?? 1;
                    $stats[$levelNum]['total']++;
                    $max += $weight;
                    if ($row->is_correct) {
                        $stats[$levelNum]['correct']++;
                        $obtained += $weight;
                    }
                }

                return [
                    'l1' => $stats[1]['correct'] . '/' . $stats[1]['total'],
                    'l2' => $stats[2]['correct'] . '/' . $stats[2]['total'],
                    'l3' => $stats[3]['correct'] . '/' . $stats[3]['total'],
                    'obtained' => $obtained,
                    'max' => $max,
                ];
            };

            $preLevelStats = $calculateLevelStats($preAttempt);
            $mockLevelStats = $calculateLevelStats($mockAttempt);
            $finalLevelStats = $calculateLevelStats($finalAttempt);

            $courseTestProgress = [
                'pre_done' => (bool) $preAttempt,
                'pre_score' => $preAttempt?->score_percent,
                'pre_correct' => $preAttempt?->correct_count,
                'pre_wrong' => $preAttempt ? (max(0, $preAttempt->total_questions - $preAttempt->correct_count)) : 0,
                'pre_total' => $preAttempt?->total_questions,
                'pre_duration' => $preAttempt && $preAttempt->started_at && $preAttempt->completed_at 
                    ? $formatDuration($preAttempt->started_at->diffInSeconds($preAttempt->completed_at)) 
                    : '—',
                'pre_l1' => $preLevelStats['l1'],
                'pre_l2' => $preLevelStats['l2'],
                'pre_l3' => $preLevelStats['l3'],
                'pre_obtained' => $preLevelStats['obtained'],
                'pre_max' => $preLevelStats['max'],

                'mock_done' => (bool) $mockAttempt,
                'mock_score' => $mockAttempt?->score_percent,
                'mock_correct' => $mockAttempt?->correct_count,
                'mock_wrong' => $mockAttempt ? (max(0, $mockAttempt->total_questions - $mockAttempt->correct_count)) : 0,
                'mock_total' => $mockAttempt?->total_questions,
                'mock_duration' => $mockAttempt && $mockAttempt->started_at && $mockAttempt->completed_at 
                    ? $formatDuration($mockAttempt->started_at->diffInSeconds($mockAttempt->completed_at)) 
                    : '—',
                'mock_l1' => $mockLevelStats['l1'],
                'mock_l2' => $mockLevelStats['l2'],
                'mock_l3' => $mockLevelStats['l3'],
                'mock_obtained' => $mockLevelStats['obtained'],
                'mock_max' => $mockLevelStats['max'],

                'final_done' => (bool) $finalAttempt,
                'final_score' => $finalAttempt?->score_percent,
                'final_correct' => $finalAttempt?->correct_count,
                'final_wrong' => $finalAttempt ? (max(0, $finalAttempt->total_questions - $finalAttempt->correct_count)) : 0,
                'final_total' => $finalAttempt?->total_questions,
                'final_duration' => $finalAttempt && $finalAttempt->started_at && $finalAttempt->completed_at 
                    ? $formatDuration($finalAttempt->started_at->diffInSeconds($finalAttempt->completed_at)) 
                    : '—',
                'final_l1' => $finalLevelStats['l1'],
                'final_l2' => $finalLevelStats['l2'],
                'final_l3' => $finalLevelStats['l3'],
                'final_obtained' => $finalLevelStats['obtained'],
                'final_max' => $finalLevelStats['max'],
                'final_passed' => $finalAttempt?->passed,
                'final_attempt_count' => $finalAttemptCount,
            ];
        }

        return view('cne-module-detail', [
            'course' => $course_detail,
            'isPurchased' => $isPurchased,
            'hasCourseMaterials' => $hasCourseMaterials,
            'courseTestProgress' => $courseTestProgress,
        ]);
    }

    public function takeTest(CourseDetail $course_detail, string $test): View
    {
        if ((int) $course_detail->active_status !== 1) {
            abort(404);
        }

        $type = CourseTestType::tryFrom($test);
        abort_unless($type, 404);

        $user = auth()->user();
        abort_unless($user, 403);
        app(\App\Services\CourseTestAuthorizer::class)->ensureCanAccess($user, $course_detail, $type);

        $title = ($course_detail->couse_name ?? 'Module').' · '.$type->label();

        if ($type === CourseTestType::Practice && !request()->has('level')) {
            $questions = \App\Models\CourseQuestion::query()
                ->where('course_id', $course_detail->id)
                ->where('active_status', true)
                ->get();

            $levelCounts = [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                'other' => 0,
            ];

            $levelAliases = [
                '1' => ['Level 1', 'L1', 'LEVEL 1', 'level 1', 'Level1', '1', 'I', 'LEVEL - I', 'LEVEL-I', 'Level - I', 'Level-I'],
                '2' => ['Level 2', 'L2', 'LEVEL 2', 'level 2', 'Level2', '2', 'II', 'LEVEL - II', 'LEVEL-II', 'Level - II', 'Level-II'],
                '3' => ['Level 3', 'L3', 'LEVEL 3', 'level 3', 'Level3', '3', 'III', 'LEVEL - III', 'LEVEL-III', 'Level - III', 'Level-III'],
            ];

            foreach ($questions as $q) {
                $level = trim((string)$q->question_level);
                $found = false;
                foreach ($levelAliases as $key => $aliases) {
                    if (in_array($level, $aliases, true)) {
                        $levelCounts[$key]++;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $levelCounts['other']++;
                }
            }

            $userAttempts = \App\Models\CourseTestAttempt::query()
                ->where('user_id', auth()->id())
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Practice->value)
                ->where('status', \App\Models\CourseTestAttempt::STATUS_COMPLETED)
                ->orderBy('completed_at', 'desc')
                ->get()
                ->groupBy('practice_level')
                ->map(fn($group) => $group->groupBy('practice_set'));

            return view('practice-test', [
                'course' => $course_detail,
                'title' => $title,
                'levelCounts' => $levelCounts,
                'userAttempts' => $userAttempts,
            ]);
        }

        return view('cne-course-test', [
            'course' => $course_detail,
            'testType' => $type,
            'title' => $title,
        ]);
    }

    public function materials(CourseDetail $course_detail): View
    {
        if ((int) $course_detail->active_status !== 1) {
            abort(404);
        }

        $course_detail->load([
            'materials' => function ($query) {
                $query
                    ->where('active_status', true)
                    ->whereHas('courseTitle', function ($titleQuery) {
                        $titleQuery->where('active_status', true);
                    })
                    ->with(['courseTitle' => function ($titleQuery) {
                        $titleQuery->where('active_status', true);
                    }])
                    ->orderBy('course_title_id')
                    ->orderBy('id');
            },
        ]);

        return view('cne-module-learning-materials', [
            'course' => $course_detail,
        ]);
    }
}
