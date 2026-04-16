<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseSubTitleController extends Controller
{
    public function index()
    {
        return view('super-admin.course-sub-titles.index', ['title' => 'Course Sub-Titles']);
    }

    public function create()
    {
        $courses = CourseDetail::orderBy('couse_name')->get();

        return view('super-admin.course-sub-titles.create', [
            'title' => 'Create Course Sub-Title',
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'title_name' => ['required', 'array', 'min:1'],
            'title_name.*' => ['required', 'string', 'max:255'],
        ]);

        $subTitles = collect($validated['title_name'])
            ->map(fn ($titleName) => trim($titleName))
            ->filter()
            ->values();

        CourseTitle::create([
            'course_id' => $validated['course_id'],
            'title_name' => $subTitles->implode(' | '),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-sub-titles.index')->with('success', 'Course sub-title created successfully.');
    }

    public function edit(CourseTitle $course_sub_title)
    {
        $courses = CourseDetail::orderBy('couse_name')->get();

        return view('super-admin.course-sub-titles.edit', [
            'subTitle' => $course_sub_title,
            'courses' => $courses,
            'title' => 'Edit Course Sub-Title',
        ]);
    }

    public function update(Request $request, CourseTitle $course_sub_title)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'title_name' => ['required', 'array', 'min:1'],
            'title_name.*' => ['required', 'string', 'max:255'],
        ]);

        $subTitles = collect($validated['title_name'])
            ->map(fn ($titleName) => trim($titleName))
            ->filter()
            ->values();

        $course_sub_title->update([
            'course_id' => $validated['course_id'],
            'title_name' => $subTitles->implode(' | '),
        ]);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-sub-titles.index')->with('success', 'Course sub-title updated successfully.');
    }

    public function destroy(CourseTitle $course_sub_title)
    {
        $course_sub_title->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-sub-titles.index')->with('success', 'Course sub-title deleted successfully.');
    }
}
