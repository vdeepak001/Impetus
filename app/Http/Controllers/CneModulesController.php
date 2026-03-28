<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use Illuminate\Contracts\View\View;

class CneModulesController extends Controller
{
    /**
     * Public CNE modules listing: active courses ordered by sequence.
     */
    public function index(): View
    {
        $courses = CourseDetail::query()
            ->where('active_status', 1)
            ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get();

        return view('cne-modules', [
            'courses' => $courses,
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

        return view('cne-module-detail', [
            'course' => $course_detail,
        ]);
    }
}
