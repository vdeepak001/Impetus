<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseDetailController extends Controller
{
    public function index()
    {
        return view('super-admin.course-details.index', ['title' => 'Course List']);
    }

    public function create()
    {
        return view('super-admin.course-details.create', ['title' => 'Create Course Detail']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => ['nullable', 'string', 'max:55'],
            'couse_name' => ['nullable', 'string', 'max:100'],
            'course_url' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'attachment' => ['nullable', 'string', 'max:255'],
            'seo_key' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_des' => ['nullable', 'string'],
            'active_status' => ['nullable', 'integer'],
            'sequence' => ['nullable', 'integer'],
            'qa_content' => ['nullable', 'string'],
            'practice_content' => ['nullable', 'string'],
            'pre_test' => ['nullable', 'string', 'max:50'],
            'mock_test' => ['nullable', 'string', 'max:50'],
            'final_test' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['user_id'] = Auth::id();
        CourseDetail::create($validated);

        return redirect()->route('course-details.index')->with('success', 'Course detail created successfully.');
    }

    public function edit(CourseDetail $course_detail)
    {
        return view('super-admin.course-details.edit', [
            'course' => $course_detail,
            'title' => 'Edit Course Detail'
        ]);
    }

    public function update(Request $request, CourseDetail $course_detail)
    {
        $validated = $request->validate([
            'course_code' => ['nullable', 'string', 'max:55'],
            'couse_name' => ['nullable', 'string', 'max:100'],
            'course_url' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'attachment' => ['nullable', 'string', 'max:255'],
            'seo_key' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_des' => ['nullable', 'string'],
            'active_status' => ['nullable', 'integer'],
            'sequence' => ['nullable', 'integer'],
            'qa_content' => ['nullable', 'string'],
            'practice_content' => ['nullable', 'string'],
            'pre_test' => ['nullable', 'string', 'max:50'],
            'mock_test' => ['nullable', 'string', 'max:50'],
            'final_test' => ['nullable', 'string', 'max:255'],
        ]);

        $course_detail->update($validated);

        return redirect()->route('course-details.index')->with('success', 'Course detail updated successfully.');
    }

    public function destroy(CourseDetail $course_detail)
    {
        $course_detail->delete();
        return redirect()->route('course-details.index')->with('success', 'Course detail deleted successfully.');
    }
}
