@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div>
        <x-common.component-card title="Material Information">
            <form method="POST" action="{{ route($routePrefix . '.title-materials.update', $material) }}" enctype="multipart/form-data">
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
                                <option value="{{ $course->id }}" {{ old('course_id', $material->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->couse_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Title Selection -->
                    <div>
                        <label for="course_title_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Title
                        </label>
                        <select id="course_title_id" name="course_title_id" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            @foreach($titles as $title)
                                <option value="{{ $title->id }}" {{ old('course_title_id', $material->course_title_id) == $title->id ? 'selected' : '' }}>
                                    {{ $title->title_name }} ({{ $title->course->couse_name ?? 'No Course' }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_title_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description', $material->description) }}</textarea>
                        @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Existing Attachments -->
                    @if($material->attachment && count($material->attachment) > 0)
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Existing Attachments
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                @foreach($material->attachment as $path)
                                    <div class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded-md">
                                        <a href="{{ asset($path) }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 truncate max-w-[150px]">
                                            {{ basename($path) }}
                                        </a>
                                        <div class="flex items-center ml-2">
                                            <input type="checkbox" name="remove_attachments[]" value="{{ $path }}" class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                            <span class="ml-1 text-xs text-red-600">Delete</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Attachments -->
                    <div>
                        <label for="attachments" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Upload New Files
                        </label>
                        <input id="attachments" type="file" name="attachments[]" multiple
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('attachments.*') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.title-materials.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Update Material
                    </x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
