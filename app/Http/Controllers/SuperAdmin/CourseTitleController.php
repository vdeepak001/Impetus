<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseTitleController extends Controller
{
    public function index()
    {
        return view('super-admin.course-titles.index', ['title' => 'Course Titles']);
    }

    public function create()
    {
        return view('super-admin.course-titles.create', [
            'title' => 'Create Course Title',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'couse_name' => ['required', 'string', 'max:100'],
            'course_code' => ['required', 'string', 'max:55'],
        ]);

        $validated['user_id'] = Auth::id();
        CourseDetail::create($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-titles.index')->with('success', 'Course created successfully.');
    }

    public function edit(CourseDetail $course_title)
    {
        return view('super-admin.course-titles.edit', [
            'course' => $course_title,
            'title' => 'Edit Course Title',
        ]);
    }

    public function update(Request $request, CourseDetail $course_title)
    {
        $validated = $request->validate([
            'couse_name' => ['required', 'string', 'max:100'],
            'course_code' => ['required', 'string', 'max:55'],
        ]);

        $course_title->update($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-titles.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(CourseDetail $course_title)
    {
        $course_title->subTitles()->delete();
        $course_title->materials()->delete();
        $course_question = $course_title->questions();
        $course_question->delete();

        $course_title->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-titles.index')->with('success', 'Course and its related data deleted successfully.');
    }
}
