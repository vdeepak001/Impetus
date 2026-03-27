@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div>
        <x-common.component-card title="Course Information">
            <form method="POST" action="{{ route($routePrefix . '.course-details.store') }}">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Name -->
                    <div>
                        <label for="couse_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course Name
                        </label>
                        <input id="couse_name" type="text" name="couse_name" value="{{ old('couse_name') }}" required autofocus
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('couse_name') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Course Code -->
                    <div>
                        <label for="course_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course Code
                        </label>
                        <input id="course_code" type="text" name="course_code" value="{{ old('course_code') }}" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('course_code') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Course URL -->
                    <div class="md:col-span-2">
                        <label for="course_url" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course URL
                        </label>
                        <input id="course_url" type="text" name="course_url" value="{{ old('course_url') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('course_url') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <!-- Description -->
                    <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <!-- Sequence -->
                    <div>
                        <label for="sequence" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Sequence
                        </label>
                        <input id="sequence" type="number" name="sequence" value="{{ old('sequence', 0) }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('sequence') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-end h-11">
                        <div x-data="{ switcherToggle: true }">
                            <input type="hidden" name="active_status" value="0">
                            <label for="active_status" class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                <div class="relative">
                                    <input type="checkbox" name="active_status" id="active_status" value="1" class="sr-only" 
                                        x-model="switcherToggle" />
                                    <div class="block h-6 w-11 rounded-full bg-gray-200 dark:bg-white/10"
                                        :class="switcherToggle ? 'bg-brand-500 dark:bg-brand-500' : 'bg-gray-200 dark:bg-white/10'">
                                    </div>
                                    <div class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear"
                                        :class="switcherToggle ? 'translate-x-full' : 'translate-x-0'">
                                    </div>
                                </div>
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-8 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Course Levels</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="qa_content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                QA Section
                            </label>
                            <textarea id="qa_content" name="qa_content" rows="4"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('qa_content') }}</textarea>
                            @error('qa_content') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="practice_content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Practice Section
                            </label>
                            <textarea id="practice_content" name="practice_content" rows="4"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('practice_content') }}</textarea>
                            @error('practice_content') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Pre Test
                                    </label>
                                    <div class="space-y-3">
                                        <input type="number" name="pre_test_level_1" value="{{ old('pre_test_level_1') }}" placeholder="Level 1"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="pre_test_level_2" value="{{ old('pre_test_level_2') }}" placeholder="Level 2"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="pre_test_level_3" value="{{ old('pre_test_level_3') }}" placeholder="Level 3"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    </div>
                                    @error('pre_test_level_1') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('pre_test_level_2') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('pre_test_level_3') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Mock Test
                                    </label>
                                    <div class="space-y-3">
                                        <input type="number" name="mock_test_level_1" value="{{ old('mock_test_level_1') }}" placeholder="Level 1"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="mock_test_level_2" value="{{ old('mock_test_level_2') }}" placeholder="Level 2"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="mock_test_level_3" value="{{ old('mock_test_level_3') }}" placeholder="Level 3"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    </div>
                                    @error('mock_test_level_1') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('mock_test_level_2') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('mock_test_level_3') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Final Test
                                    </label>
                                    <div class="space-y-3">
                                        <input type="number" name="final_test_level_1" value="{{ old('final_test_level_1') }}" placeholder="Level 1"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="final_test_level_2" value="{{ old('final_test_level_2') }}" placeholder="Level 2"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <input type="number" name="final_test_level_3" value="{{ old('final_test_level_3') }}" placeholder="Level 3"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full md:w-3/4 rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    </div>
                                    @error('final_test_level_1') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('final_test_level_2') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                    @error('final_test_level_3') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
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
