<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
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
            'pre_test_level_1' => ['nullable', 'integer'],
            'pre_test_level_2' => ['nullable', 'integer'],
            'pre_test_level_3' => ['nullable', 'integer'],
            'mock_test_level_1' => ['nullable', 'integer'],
            'mock_test_level_2' => ['nullable', 'integer'],
            'mock_test_level_3' => ['nullable', 'integer'],
            'final_test_level_1' => ['nullable', 'integer'],
            'final_test_level_2' => ['nullable', 'integer'],
            'final_test_level_3' => ['nullable', 'integer'],
        ]);

        $validated['pre_test'] = $this->buildLevelPayload($request, 'pre_test');
        $validated['mock_test'] = $this->buildLevelPayload($request, 'mock_test');
        $validated['final_test'] = $this->buildLevelPayload($request, 'final_test');
        unset(
            $validated['pre_test_level_1'],
            $validated['pre_test_level_2'],
            $validated['pre_test_level_3'],
            $validated['mock_test_level_1'],
            $validated['mock_test_level_2'],
            $validated['mock_test_level_3'],
            $validated['final_test_level_1'],
            $validated['final_test_level_2'],
            $validated['final_test_level_3'],
        );

        $validated['user_id'] = Auth::id();
        CourseDetail::create($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-details.index')->with('success', 'Course detail created successfully.');
    }

    public function edit(CourseDetail $course_detail)
    {
        return view('super-admin.course-details.edit', [
            'course' => $course_detail,
            'title' => 'Edit Course Detail',
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
            'pre_test_level_1' => ['nullable', 'integer'],
            'pre_test_level_2' => ['nullable', 'integer'],
            'pre_test_level_3' => ['nullable', 'integer'],
            'mock_test_level_1' => ['nullable', 'integer'],
            'mock_test_level_2' => ['nullable', 'integer'],
            'mock_test_level_3' => ['nullable', 'integer'],
            'final_test_level_1' => ['nullable', 'integer'],
            'final_test_level_2' => ['nullable', 'integer'],
            'final_test_level_3' => ['nullable', 'integer'],
        ]);

        $validated['pre_test'] = $this->buildLevelPayload($request, 'pre_test');
        $validated['mock_test'] = $this->buildLevelPayload($request, 'mock_test');
        $validated['final_test'] = $this->buildLevelPayload($request, 'final_test');
        unset(
            $validated['pre_test_level_1'],
            $validated['pre_test_level_2'],
            $validated['pre_test_level_3'],
            $validated['mock_test_level_1'],
            $validated['mock_test_level_2'],
            $validated['mock_test_level_3'],
            $validated['final_test_level_1'],
            $validated['final_test_level_2'],
            $validated['final_test_level_3'],
        );

        $course_detail->update($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-details.index')->with('success', 'Course detail updated successfully.');
    }

    public function destroy(CourseDetail $course_detail)
    {
        $course_detail->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-details.index')->with('success', 'Course detail deleted successfully.');
    }

    private function buildLevelPayload(Request $request, string $prefix): string
    {
        return json_encode([
            'level_1' => $request->input($prefix.'_level_1'),
            'level_2' => $request->input($prefix.'_level_2'),
            'level_3' => $request->input($prefix.'_level_3'),
        ]);
    }
}
