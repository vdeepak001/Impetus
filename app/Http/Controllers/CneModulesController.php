<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
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

        $isPurchased = false;

        $viewer = auth()->user();

        if ($viewer && $viewer->role_type === 'user') {
            $isPurchased = Order::userHasActivePurchaseForCourse($viewer, $course_detail);
        }

        return view('cne-module-detail', [
            'course' => $course_detail,
            'isPurchased' => $isPurchased,
        ]);
    }
}
