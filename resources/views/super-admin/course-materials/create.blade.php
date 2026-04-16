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
            <form method="POST" action="{{ route($routePrefix . '.title-materials.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Course
                        </label>
                        <select id="course_id" name="course_id" required autofocus
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select a Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                            <option value="">Select a Title</option>
                            @foreach($titles as $title)
                                <option value="{{ $title->id }}" {{ old('course_title_id') == $title->id ? 'selected' : '' }}>
                                    {{ $title->title_name }} ({{ $title->course->couse_name ?? 'No Course' }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_title_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    {{-- <div>
                        <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div> --}}

                    <!-- Existing Attachments -->
                    <div id="existing-attachments-container" class="md:col-span-1 hidden">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Existing Attachments
                        </label>
                        <div id="existing-attachments-list" class="space-y-2 border border-brand-100 dark:border-brand-900/30 rounded-lg p-3 bg-brand-50/50 dark:bg-brand-900/10">
                            <!-- Dynamically populated -->
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="md:col-start-2">
                        <label for="attachments" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Upload Files (PDF, PPT)
                        </label>
                        <input id="attachments" type="file" name="attachments[]" multiple accept=".pdf,.ppt,.pptx"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You can select multiple files.</p>
                        @error('attachments.*') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.title-materials.index') }}'">
                        Cancel
                    </x-ui.button>

                    <x-ui.button type="submit">
                        Create Material
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
        const container = document.getElementById('existing-attachments-container');
        const list = document.getElementById('existing-attachments-list');

        function fetchAttachments() {
            const courseId = courseSelect.value;
            const titleId = titleSelect.value;

            if (courseId && titleId) {
                fetch(`{{ route($routePrefix . '.title-materials.get-existing-attachments') }}?course_id=${courseId}&course_title_id=${titleId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            list.innerHTML = '';
                            data.forEach(attachment => {
                                const item = document.createElement('div');
                                item.className = 'flex items-center gap-2 p-2 bg-white dark:bg-gray-800 rounded border border-gray-100 dark:border-gray-700 shadow-sm transition-all hover:border-brand-200';
                                item.innerHTML = `
                                    <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    <a href="${attachment.url}" target="_blank" class="text-xs text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 truncate font-medium flex-1">
                                        ${attachment.name}
                                    </a>
                                `;
                                list.appendChild(item);
                            });
                            container.classList.remove('hidden');
                        } else {
                            container.classList.add('hidden');
                        }
                    })
                    .catch(error => console.error('Error fetching attachments:', error));
            } else {
                container.classList.add('hidden');
            }
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
            fetchAttachments();
        });

        titleSelect.addEventListener('change', fetchAttachments);

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
