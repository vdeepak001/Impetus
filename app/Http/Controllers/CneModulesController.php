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

        $isPurchased = false;

        $viewer = auth()->user();

        if ($viewer && $viewer->role_type === 'user') {
            $isPurchased = Order::userHasActivePurchaseForCourse($viewer, $course_detail);
        }

        $courseTestProgress = null;
        if ($viewer && $viewer->role_type === 'user' && $isPurchased) {
            $mockAttempt = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Mock->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->latest('id')
                ->first();

            $preAttempt = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Pre->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->latest('id')
                ->first();

            $finalAttempt = CourseTestAttempt::query()
                ->where('user_id', $viewer->id)
                ->where('course_detail_id', $course_detail->id)
                ->where('test_type', CourseTestType::Final->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->latest('id')
                ->first();

            $courseTestProgress = [
                'mock_done' => (bool) $mockAttempt,
                'mock_score' => $mockAttempt?->score_percent,
                'pre_done' => (bool) $preAttempt,
                'pre_score' => $preAttempt?->score_percent,
                'final_done' => (bool) $finalAttempt,
                'final_score' => $finalAttempt?->score_percent,
                'final_passed' => $finalAttempt?->passed,
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

        $title = ($course_detail->couse_name ?? 'Module').' · '.$type->label();

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
