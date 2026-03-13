<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\CourseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseQuestionController extends Controller
{
    public function index()
    {
        return view('super-admin.course-questions.index', ['title' => 'Course Questions']);
    }

    public function create()
    {
        $courses = CourseDetail::orderBy('couse_name')->get();
        return view('super-admin.course-questions.create', [
            'title' => 'Create Course Question',
            'courses' => $courses
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_code' => ['nullable', 'string', 'max:55'],
            'course_id' => ['required', 'exists:course_details,id'],
            'question_type' => ['required', 'string', 'in:mcq,text'],
            'question_level' => ['nullable', 'string', 'max:20'],
            'question' => ['required', 'string'],
            'choice_a' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_b' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_c' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_d' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
        ]);

        if ($validated['question_type'] === 'text') {
            $validated['choice_a'] = null;
            $validated['choice_b'] = null;
            $validated['choice_c'] = null;
            $validated['choice_d'] = null;
        }

        $validated['user_id'] = Auth::id();
        CourseQuestion::create($validated);

        return redirect()->route('course-questions.index')->with('success', 'Course question created successfully.');
    }

    public function edit(CourseQuestion $course_question)
    {
        $courses = CourseDetail::orderBy('couse_name')->get();
        return view('super-admin.course-questions.edit', [
            'question' => $course_question,
            'courses' => $courses,
            'title' => 'Edit Course Question'
        ]);
    }

    public function update(Request $request, CourseQuestion $course_question)
    {
        $validated = $request->validate([
            'question_code' => ['nullable', 'string', 'max:55'],
            'course_id' => ['required', 'exists:course_details,id'],
            'question_type' => ['required', 'string', 'in:mcq,text'],
            'question_level' => ['nullable', 'string', 'max:20'],
            'question' => ['required', 'string'],
            'choice_a' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_b' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_c' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'choice_d' => ['required_if:question_type,mcq', 'nullable', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
        ]);

        if ($validated['question_type'] === 'text') {
            $validated['choice_a'] = null;
            $validated['choice_b'] = null;
            $validated['choice_c'] = null;
            $validated['choice_d'] = null;
        }

        $course_question->update($validated);

        return redirect()->route('course-questions.index')->with('success', 'Course question updated successfully.');
    }

    public function destroy(CourseQuestion $course_question)
    {
        $course_question->delete();
        return redirect()->route('course-questions.index')->with('success', 'Course question deleted successfully.');
    }
}
