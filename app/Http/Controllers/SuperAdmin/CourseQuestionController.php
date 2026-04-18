<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\CourseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'courses' => $courses,
        ]);
    }

    public function getNextCode(Request $request)
    {
        $courseId = $request->query('course_id');
        $level = $request->query('level');

        if (! $courseId || ! $level) {
            return response()->json(['code' => '']);
        }

        $course = CourseDetail::findOrFail($courseId);
        $levelCode = 'L1';
        if ($level === 'Level 2') {
            $levelCode = 'L2';
        }
        if ($level === 'Level 3') {
            $levelCode = 'L3';
        }

        // Count existing questions for this course and level
        $lastQuestion = CourseQuestion::where('course_id', $courseId)
            ->where('question_level', $level)
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1001;
        if ($lastQuestion) {
            // Extract sequence from existing code: BLS001/1001/L1
            $parts = explode('/', $lastQuestion->question_code);
            if (count($parts) === 3) {
                $sequence = (int) $parts[1] + 1;
            } else {
                // Fallback: just count
                $sequence = CourseQuestion::where('course_id', $courseId)
                    ->where('question_level', $level)
                    ->count() + 1001;
            }
        }

        $code = "{$course->course_code}/{$sequence}/{$levelCode}";

        return response()->json(['code' => $code]);
    }

    public function store(Request $request)
    {
        $mcqOrShort = Rule::requiredIf(fn () => in_array($request->input('question_type'), ['mcq', 'short'], true));

        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'question_type' => ['required', 'string', 'in:mcq,text,short'],
            'question_level' => ['required', 'string', 'max:20'],
            'question' => ['required', 'string'],
            'choice_a' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_b' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_c' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_d' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
        ]);

        // Auto generate question code if not provided or to ensure correctness
        $course = CourseDetail::findOrFail($validated['course_id']);
        $levelCode = 'L1';
        if ($validated['question_level'] === 'Level 2') {
            $levelCode = 'L2';
        }
        if ($validated['question_level'] === 'Level 3') {
            $levelCode = 'L3';
        }

        $lastQuestion = CourseQuestion::where('course_id', $validated['course_id'])
            ->where('question_level', $validated['question_level'])
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1001;
        if ($lastQuestion) {
            $parts = explode('/', $lastQuestion->question_code);
            if (count($parts) === 3) {
                $sequence = (int) $parts[1] + 1;
            } else {
                $sequence = CourseQuestion::where('course_id', $validated['course_id'])
                    ->where('question_level', $validated['question_level'])
                    ->count() + 1001;
            }
        }

        $validated['question_code'] = "{$course->course_code}/{$sequence}/{$levelCode}";

        if ($validated['question_type'] === 'text') {
            $validated['choice_a'] = null;
            $validated['choice_b'] = null;
            $validated['choice_c'] = null;
            $validated['choice_d'] = null;
        }

        $validated['active_status'] = $request->input('active_status') === '1';
        $validated['user_id'] = Auth::id();
        CourseQuestion::create($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-questions.index')->with('success', 'Course question created successfully.');
    }

    public function edit(CourseQuestion $course_question)
    {
        $courses = CourseDetail::orderBy('couse_name')->get();

        return view('super-admin.course-questions.edit', [
            'question' => $course_question,
            'courses' => $courses,
            'title' => 'Edit Course Question',
        ]);
    }

    public function update(Request $request, CourseQuestion $course_question)
    {
        $mcqOrShort = Rule::requiredIf(fn () => in_array($request->input('question_type'), ['mcq', 'short'], true));

        $validated = $request->validate([
            'course_id' => ['required', 'exists:course_details,id'],
            'question_type' => ['required', 'string', 'in:mcq,text,short'],
            'question_level' => ['required', 'string', 'max:20'],
            'question' => ['required', 'string'],
            'choice_a' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_b' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_c' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'choice_d' => [$mcqOrShort, 'nullable', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
        ]);

        // If course or level changed, we might need to regenerate the code?
        // But the user said "not editable", implying it shouldn't change.
        // However, if they change the course/level, the code MUST change to stay valid.
        if ($course_question->course_id != $validated['course_id'] || $course_question->question_level != $validated['question_level']) {
            $course = CourseDetail::findOrFail($validated['course_id']);
            $levelCode = 'L1';
            if ($validated['question_level'] === 'Level 2') {
                $levelCode = 'L2';
            }
            if ($validated['question_level'] === 'Level 3') {
                $levelCode = 'L3';
            }

            $lastQuestion = CourseQuestion::where('course_id', $validated['course_id'])
                ->where('question_level', $validated['question_level'])
                ->orderBy('id', 'desc')
                ->first();

            $sequence = 1001;
            if ($lastQuestion) {
                $parts = explode('/', $lastQuestion->question_code);
                if (count($parts) === 3) {
                    $sequence = (int) $parts[1] + 1;
                } else {
                    $sequence = CourseQuestion::where('course_id', $validated['course_id'])
                        ->where('question_level', $validated['question_level'])
                        ->count() + 1001;
                }
            }
            $validated['question_code'] = "{$course->course_code}/{$sequence}/{$levelCode}";
        }

        if ($validated['question_type'] === 'text') {
            $validated['choice_a'] = null;
            $validated['choice_b'] = null;
            $validated['choice_c'] = null;
            $validated['choice_d'] = null;
        }

        $validated['active_status'] = $request->input('active_status') === '1';

        $course_question->update($validated);

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-questions.index')->with('success', 'Course question updated successfully.');
    }

    public function destroy(CourseQuestion $course_question)
    {
        $course_question->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.course-questions.index')->with('success', 'Course question deleted successfully.');
    }
}
