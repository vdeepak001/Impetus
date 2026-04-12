@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div>
    <div x-data="{
        questionType: '{{ old('question_type', 'mcq') }}',
        courseId: '{{ old('course_id') }}',
        questionLevel: '{{ old('question_level') }}',
        questionCode: '{{ old('question_code') }}',
        async fetchNextCode() {
            if (this.courseId && this.questionLevel) {
                try {
                    const response = await fetch(`{{ route($routePrefix . '.course-questions.get-next-code') }}?course_id=${this.courseId}&level=${this.questionLevel}`);
                    const data = await response.json();
                    this.questionCode = data.code;
                } catch (error) {
                    console.error('Error fetching question code:', error);
                }
            } else {
                this.questionCode = '';
            }
        }
    }">
        <x-common.component-card title="Question Information">
            <form method="POST" action="{{ route($routePrefix . '.course-questions.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Course
                        </label>
                        <select id="course_id" name="course_id" required autofocus
                            x-model="courseId" @change="fetchNextCode()"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select a Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->couse_name }}-{{ $course->course_code }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Question Type -->
                    <div>
                        <label for="question_type" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Question Type
                        </label>
                        <select id="question_type" name="question_type" required x-model="questionType"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="mcq">Multiple Choice (MCQ)</option>
                            <option value="text">Short/Long Answer (Text)</option>
                        </select>
                        @error('question_type') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Question Level -->
                    <div>
                        <label for="question_level" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Question Level
                        </label>
                        <select id="question_level" name="question_level" required
                            x-model="questionLevel" @change="fetchNextCode()"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select Level</option>
                            <option value="Level 1" {{ old('question_level') == 'Level 1' ? 'selected' : '' }}>Level 1</option>
                            <option value="Level 2" {{ old('question_level') == 'Level 2' ? 'selected' : '' }}>Level 2</option>
                            <option value="Level 3" {{ old('question_level') == 'Level 3' ? 'selected' : '' }}>Level 3</option>
                        </select>
                        @error('question_level') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Question Code -->
                    <div>
                        <label for="question_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Question Code (Auto Generated)
                        </label>
                        <input id="question_code" type="text" name="question_code" x-model="questionCode" readonly
                            class="dark:bg-dark-900 shadow-theme-xs bg-gray-50 dark:bg-gray-800 cursor-not-allowed focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('question_code') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>



                    <!-- Question Text (Full Width) -->
                    <div class="md:col-span-2">
                        <label for="question" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Question
                        </label>
                        <textarea id="question" name="question" rows="3" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('question') }}</textarea>
                        @error('question') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- MCQ choices - Only show if type is MCQ -->
                    <template x-if="questionType === 'mcq'">
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="choice_a" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Choice A</label>
                                <input id="choice_a" type="text" name="choice_a" value="{{ old('choice_a') }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                @error('choice_a') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="choice_b" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Choice B</label>
                                <input id="choice_b" type="text" name="choice_b" value="{{ old('choice_b') }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                @error('choice_b') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="choice_c" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Choice C</label>
                                <input id="choice_c" type="text" name="choice_c" value="{{ old('choice_c') }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                @error('choice_c') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="choice_d" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Choice D</label>
                                <input id="choice_d" type="text" name="choice_d" value="{{ old('choice_d') }}"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                                @error('choice_d') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </template>

                    <!-- Answer Field -->
                    <div class="md:col-span-2">
                        <label for="answer" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Correct Answer</label>

                        <!-- Show dropdown for MCQ -->
                        <div x-show="questionType === 'mcq'">
                            <select id="answer_mcq" name="answer" :required="questionType === 'mcq'" :disabled="questionType !== 'mcq'"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="">Select Answer</option>
                                <option value="A" {{ old('answer') == 'A' ? 'selected' : '' }}>Choice A</option>
                                <option value="B" {{ old('answer') == 'B' ? 'selected' : '' }}>Choice B</option>
                                <option value="C" {{ old('answer') == 'C' ? 'selected' : '' }}>Choice C</option>
                                <option value="D" {{ old('answer') == 'D' ? 'selected' : '' }}>Choice D</option>
                            </select>
                        </div>

                        <!-- Show text field for TEXT -->
                        <div x-show="questionType === 'text'">
                            <textarea id="answer_text" name="answer" rows="2" :required="questionType === 'text'" :disabled="questionType !== 'text'"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('answer') }}</textarea>
                        </div>
                        @error('answer') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Reason -->
                    <div class="md:col-span-2">
                        <label for="reason" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Reason / Explanation</label>
                        <textarea id="reason" name="reason" rows="2"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('reason') }}</textarea>
                        @error('reason') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-questions.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Create Question
                    </x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
