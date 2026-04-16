@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
        <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-titles.index') }}'">
            Back to List
        </x-ui.button>
    </div>

    <div>
        <x-common.component-card title="Course Information">
            <form method="POST" action="{{ route($routePrefix . '.course-titles.update', $course) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Name -->
                    <div>
                        <label for="couse_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course Name
                        </label>
                        <input id="couse_name" type="text" name="couse_name" value="{{ old('couse_name', $course->couse_name) }}" required autofocus
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('couse_name') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Course Code -->
                    <div>
                        <label for="course_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Course Code
                        </label>
                        <input id="course_code" type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('course_code') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-titles.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Update Course
                    </x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
