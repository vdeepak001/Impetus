<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp', 'max:10240'],
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

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $this->storeAttachmentUnderPublicPath($request->file('attachment'));
        } else {
            unset($validated['attachment']);
        }

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
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp', 'max:10240'],
            'remove_attachment' => ['nullable', 'boolean'],
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

        unset($validated['remove_attachment']);

        if ($request->boolean('remove_attachment')) {
            $this->deleteStoredAttachment($course_detail->attachment);
            $validated['attachment'] = null;
        } elseif ($request->hasFile('attachment')) {
            $this->deleteStoredAttachment($course_detail->attachment);
            $validated['attachment'] = $this->storeAttachmentUnderPublicPath($request->file('attachment'));
        } else {
            unset($validated['attachment']);
        }

        $course_detail->update($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-details.index')->with('success', 'Course detail updated successfully.');
    }

    public function destroy(CourseDetail $course_detail)
    {
        $this->deleteStoredAttachment($course_detail->attachment);

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

    /**
     * Store upload under public/course-details (web-accessible via asset()).
     *
     * @return string Relative path from public/ (e.g. course-details/abc.pdf)
     */
    private function storeAttachmentUnderPublicPath(UploadedFile $file): string
    {
        $directory = public_path('course-details');
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = $file->hashName();
        $file->move($directory, $filename);

        return 'course-details/'.$filename;
    }

    private function deleteStoredAttachment(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $direct = public_path($relativePath);
        if (is_file($direct)) {
            unlink($direct);

            return;
        }

        $legacyStoragePublic = public_path('storage/'.$relativePath);
        if (is_file($legacyStoragePublic)) {
            unlink($legacyStoragePublic);
        }
    }
}
