@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
        <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-sub-titles.index') }}'">
            Back to List
        </x-ui.button>
    </div>

    <div>
        <x-common.component-card title="Sub-Title Information">
            <form method="POST" action="{{ route($routePrefix . '.course-sub-titles.update', $subTitle) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Course
                        </label>
                        <select id="course_id" name="course_id" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $subTitle->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->couse_name }} ({{ $course->course_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Title Name -->
                    <div>
                        <label for="title_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Sub-Title Name
                        </label>
                        <input id="title_name" type="text" name="title_name" value="{{ old('title_name', $subTitle->title_name) }}" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('title_name') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="title_description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="title_description" name="title_description" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('title_description', $subTitle->title_description) }}</textarea>
                        @error('title_description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.course-sub-titles.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Update Sub-Title
                    </x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
