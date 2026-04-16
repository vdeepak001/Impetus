<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\CourseMaterial;
use App\Models\CourseTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseMaterialController extends Controller
{
    public function index()
    {
        return view('super-admin.course-materials.index', ['title' => 'Course Materials']);
    }

    public function create()
    {
        $courses = CourseDetail::orderBy('couse_name')->get();
        // We'll load titles dynamically via Livewire or just pass all for simplicity in standard view
        $titles = CourseTitle::orderBy('title_name')->get();

        return view('super-admin.course-materials.create', [
            'title' => 'Create Sub-Title Course Material',
            'courses' => $courses,
            'titles' => $titles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'course_title_id' => ['required', 'exists:course_title,id'],
            // 'description' => ['nullable', 'string'],
            'attachments.*' => ['required', 'file', 'mimes:pdf,ppt,pptx', 'max:10240'], // 10MB max per file
        ]);

        $paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $paths[] = $file->storeAs('materials', $filename, 'public');
            }
        }

        CourseMaterial::create([
            'user_id' => Auth::id(),
            'course_id' => $validated['course_id'],
            'course_title_id' => $validated['course_title_id'],
            // 'description' => $validated['description'],
            'attachment' => $paths,
        ]);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.title-materials.index')->with('success', 'Course material created successfully.');
    }

    public function edit(CourseMaterial $title_material)
    {
        $courses = CourseDetail::orderBy('couse_name')->get();
        $titles = CourseTitle::where('course_id', $title_material->course_id)->orderBy('title_name')->get();

        return view('super-admin.course-materials.edit', [
            'material' => $title_material,
            'courses' => $courses,
            'titles' => $titles,
            'title' => 'Edit Sub-Title Course Material',
        ]);
    }

    public function update(Request $request, CourseMaterial $title_material)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'course_title_id' => ['required', 'exists:course_title,id'],
            // 'description' => ['nullable', 'string'],
            'attachments.*' => ['nullable', 'file', 'mimes:pdf,ppt,pptx', 'max:10240'],
        ]);

        $currentPaths = $title_material->attachment ?? [];

        // Handle adding new files
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $currentPaths[] = $file->storeAs('materials', $filename, 'public');
            }
        }

        // Handle deleting specific files (passed as array of indices to keep or paths to remove)
        if ($request->has('remove_attachments')) {
            foreach ($request->remove_attachments as $pathToRemove) {
                if (($key = array_search($pathToRemove, $currentPaths)) !== false) {
                    \Storage::disk('public')->delete($pathToRemove);
                    unset($currentPaths[$key]);
                }
            }
            $currentPaths = array_values($currentPaths); // Re-index
        }

        $title_material->update([
            'course_id' => $validated['course_id'],
            'course_title_id' => $validated['course_title_id'],
            // 'description' => $validated['description'],
            'attachment' => $currentPaths,
        ]);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.title-materials.index')->with('success', 'Course material updated successfully.');
    }

    public function destroy(CourseMaterial $title_material)
    {
        $title_material->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.title-materials.index')->with('success', 'Course material deleted successfully.');
    }

    public function getExistingAttachments(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'course_title_id' => 'required',
        ]);

        $materials = CourseMaterial::where('course_id', $request->course_id)
            ->where('course_title_id', $request->course_title_id)
            ->get();

        $attachments = [];
        foreach ($materials as $material) {
            if ($material->attachment) {
                foreach ($material->attachment as $path) {
                    $attachments[] = [
                        'name' => preg_replace('/^\d+_/', '', basename($path)),
                        'url' => asset('storage/' . $path),
                    ];
                }
            }
        }

        return response()->json($attachments);
    }
}
