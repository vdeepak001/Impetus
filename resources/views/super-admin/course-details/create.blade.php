@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
        <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-details.index') }}'">
            Back to List
        </x-ui.button>
    </div>

    <div>
        <x-common.component-card title="Course Information">
            <form method="POST" action="{{ route($routePrefix . '.course-details.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Selection -->
                    <div class="md:col-span-2">
                        <label for="course_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Course
                        </label>
                        <select id="course_id" name="course_id" required autofocus
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select a Course to add details</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->couse_name }} ({{ $course->course_code }})
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Only courses created in the 'Course Titles' section are listed here.</p>
                        @error('course_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Course URL -->
                    <div>
                        <label for="course_url" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course URL
                        </label>
                        <input id="course_url" type="text" name="course_url" value="{{ old('course_url') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('course_url') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sequence -->
                    <div>
                        <label for="sequence" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Sequence
                        </label>
                        <input id="sequence" type="number" name="sequence" value="{{ old('sequence', 0) }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('sequence') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                </div>

                <!-- Attachment -->
                <div class="mt-6">
                    <label for="attachment" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Attachment (PDF, Image, etc.)
                    </label>
                    <input id="attachment" type="file" name="attachment"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    @error('attachment') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                </div>

                <hr class="my-8 border-gray-200 dark:border-gray-700" />

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">SEO Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="seo_title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">SEO Title</label>
                        <input id="seo_title" type="text" name="seo_title" value="{{ old('seo_title') }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                        <label for="seo_key" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">SEO Keywords</label>
                        <input id="seo_key" type="text" name="seo_key" value="{{ old('seo_key') }}"
                            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="seo_des" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">SEO Description</label>
                        <textarea id="seo_des" name="seo_des" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('seo_des') }}</textarea>
                    </div>
                </div>

                <hr class="my-8 border-gray-200 dark:border-gray-700" />

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Test Settings</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Pre Test -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 border-b pb-2">Pre Test</h4>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 1</label>
                            <input type="number" name="pre_test_level_1" value="{{ old('pre_test_level_1', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 2</label>
                            <input type="number" name="pre_test_level_2" value="{{ old('pre_test_level_2', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 3</label>
                            <input type="number" name="pre_test_level_3" value="{{ old('pre_test_level_3', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                    </div>

                    <!-- Mock Test -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 border-b pb-2">Mock Test</h4>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 1</label>
                            <input type="number" name="mock_test_level_1" value="{{ old('mock_test_level_1', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 2</label>
                            <input type="number" name="mock_test_level_2" value="{{ old('mock_test_level_2', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 3</label>
                            <input type="number" name="mock_test_level_3" value="{{ old('mock_test_level_3', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                    </div>

                    <!-- Final Test -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 border-b pb-2">Final Test</h4>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 1</label>
                            <input type="number" name="final_test_level_1" value="{{ old('final_test_level_1', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 2</label>
                            <input type="number" name="final_test_level_2" value="{{ old('final_test_level_2', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Level 3</label>
                            <input type="number" name="final_test_level_3" value="{{ old('final_test_level_3', 0) }}" class="h-10 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-200 dark:border-gray-700" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Q&A Content -->
                    <div>
                        <label for="qa_content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Q&A Content</label>
                        <textarea id="qa_content" name="qa_content" rows="4"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('qa_content') }}</textarea>
                    </div>

                    <!-- Practice Content -->
                    <div>
                        <label for="practice_content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Practice Content</label>
                        <textarea id="practice_content" name="practice_content" rows="4"
                            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('practice_content') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-details.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Create Course
                    </x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
