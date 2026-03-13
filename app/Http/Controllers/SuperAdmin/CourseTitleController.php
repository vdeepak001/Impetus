<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\CourseTitle;
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
        $courses = CourseDetail::orderBy('couse_name')->get();
        return view('super-admin.course-titles.create', [
            'title' => 'Create Course Title',
            'courses' => $courses
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'title_name' => ['required', 'string', 'max:255'],
            'title_description' => ['nullable', 'string'],
        ]);

        $validated['user_id'] = Auth::id();
        CourseTitle::create($validated);

        return redirect()->route('course-titles.index')->with('success', 'Course title created successfully.');
    }

    public function edit(CourseTitle $course_title)
    {
        $courses = CourseDetail::orderBy('couse_name')->get();
        return view('super-admin.course-titles.edit', [
            'courseTitle' => $course_title,
            'courses' => $courses,
            'title' => 'Edit Course Title'
        ]);
    }

    public function update(Request $request, CourseTitle $course_title)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'title_name' => ['required', 'string', 'max:255'],
            'title_description' => ['nullable', 'string'],
        ]);

        $course_title->update($validated);

        return redirect()->route('course-titles.index')->with('success', 'Course title updated successfully.');
    }

    public function destroy(CourseTitle $course_title)
    {
        $course_title->delete();
        return redirect()->route('course-titles.index')->with('success', 'Course title deleted successfully.');
    }
}
