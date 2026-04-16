@extends('layouts.app')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
        <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.title-materials.index') }}'">
            Back to List
        </x-ui.button>
    </div>

    <div>
        <x-common.component-card title="Material Information">
            <form method="POST" action="{{ route($routePrefix . '.title-materials.update', $material) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            @foreach($titles as $courseTitle)
                                @php
                                    $titleParts = collect(preg_split('/\s*(?:\||!)\s*/', (string) $courseTitle->title_name))
                                        ->map(fn ($part) => trim($part))
                                        ->filter()
                                        ->values();
                                @endphp
                                @forelse($titleParts as $titlePart)
                                    <option value="{{ $courseTitle->id }}" data-title-label="{{ $titlePart }}"
                                        {{ old('course_title_id', $material->course_title_id) == $courseTitle->id && old('description', $material->description) === $titlePart ? 'selected' : '' }}>
                                        {{ $titlePart }} ({{ $courseTitle->course->couse_name ?? 'No Course' }})
                                    </option>
                                @empty
                                    <option value="{{ $courseTitle->id }}" data-title-label="{{ $courseTitle->title_name }}"
                                        {{ old('course_title_id', $material->course_title_id) == $courseTitle->id && old('description', $material->description) === $courseTitle->title_name ? 'selected' : '' }}>
                                        {{ $courseTitle->title_name }} ({{ $courseTitle->course->couse_name ?? 'No Course' }})
                                    </option>
                                @endforelse
                            @endforeach
                        </select>
                        <input type="hidden" id="selected_title_label" name="description" value="{{ old('description', $material->description) }}">
                        @error('course_title_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                        @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    {{-- <div>
                        <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description', $material->description) }}</textarea>
                        @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div> --}}

                    <!-- Existing Attachments -->
                    @if($material->attachment && count($material->attachment) > 0)
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Existing Attachments
                            </label>
                            <div class="space-y-2 border border-brand-100 dark:border-brand-900/30 rounded-lg p-3 bg-brand-50/50 dark:bg-brand-900/10">
                                @foreach($material->attachment as $path)
                                    <div class="flex items-center gap-2 p-2 bg-white dark:bg-gray-800 rounded border border-gray-100 dark:border-gray-700 shadow-sm transition-all hover:border-brand-200">
                                        <svg class="w-4 h-4 text-brand-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        <a href="{{ asset('storage/' . $path) }}" target="_blank" class="text-xs text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 truncate font-medium flex-1">
                                            {{ preg_replace('/^\d+_/', '', basename($path)) }}
                                        </a>
                                        <label class="inline-flex items-center gap-1 text-xs text-red-600 dark:text-red-400 whitespace-nowrap">
                                            <input type="checkbox" name="remove_attachments[]" value="{{ $path }}" class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                            Delete
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Attachments -->
                    <div class="md:col-start-2">
                        <label for="attachments" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Upload New Files (PDF, PPT)
                        </label>
                        <input id="attachments" type="file" name="attachments[]" multiple accept=".pdf,.ppt,.pptx"
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const courseSelect = document.getElementById('course_id');
        const titleSelect = document.getElementById('course_title_id');
        const selectedTitleLabel = document.getElementById('selected_title_label');

        function syncSelectedTitleLabel() {
            selectedTitleLabel.value = titleSelect.selectedOptions[0]?.dataset.titleLabel ?? '';
        }

        courseSelect.addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text;
            
            // Basic filtering for Title dropdown
            Array.from(titleSelect.options).forEach(option => {
                if (option.value === "") return;
                if (option.text.includes(`(${selectedText})`)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                    if (titleSelect.value === option.value) titleSelect.value = "";
                }
            });
            syncSelectedTitleLabel();
        });

        titleSelect.addEventListener('change', syncSelectedTitleLabel);

        syncSelectedTitleLabel();

        // File name preview
        const attachmentInput = document.getElementById('attachments');
        const selectedFilesContainer = document.createElement('div');
        selectedFilesContainer.id = 'selected-files-list';
        selectedFilesContainer.className = 'mt-2 space-y-1';
        attachmentInput.parentNode.appendChild(selectedFilesContainer);

        attachmentInput.addEventListener('change', function() {
            selectedFilesContainer.innerHTML = '';
            if (this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'text-xs text-brand-600 dark:text-brand-400 flex items-center gap-1 font-medium';
                    fileItem.innerHTML = `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> ${file.name}`;
                    selectedFilesContainer.appendChild(fileItem);
                });
            }
        });
    });
</script>
@endpush
