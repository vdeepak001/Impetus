<div class="space-y-8">
    <div class="flex items-end gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200 dark:bg-gray-800/30 dark:border-gray-700">
        <div class="flex-1">
            <label for="newCourseId" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Add a Course</label>
            <select id="newCourseId" wire:model.defer="newCourseId"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                <option value="">Select a Course to add...</option>
                @foreach($allCourses as $course)
                    <option value="{{ $course->id }}" {{ isset($selectedCourses[$course->id]) ? 'disabled' : '' }}>
                        {{ $course->couse_name }} ({{ $course->course_code }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="button" wire:click="addCourse"
            class="h-11 px-6 rounded-lg bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-500/10 group">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Course
            </span>
        </button>
    </div>

    <div class="space-y-6">
        @forelse($selectedCourses as $courseId => $v)
            <div class="group relative bg-white rounded-3xl border border-gray-200 shadow-sm dark:bg-gray-900 dark:border-gray-700 transition-all hover:shadow-md">
                {{-- Course Header --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-brand-50 rounded-lg dark:bg-brand-900/30">
                            <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-gray-800 dark:text-white/90">{{ $v['name'] }}</h4>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-tight">{{ $v['code'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" wire:click="removeCourse({{ $courseId }})"
                            class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all dark:hover:bg-red-900/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>

                {{-- Course Settings --}}
                <div class="p-6">
                    <div class="grid grid-cols-5 gap-x-3 gap-y-4">
                        <div>
                            <label class="mb-1 block text-[10px] font-bold text-gray-400 uppercase tracking-tight">MRP</label>
                            <input type="number" name="courses[{{ $courseId }}][mrp]" wire:model.defer="selectedCourses.{{ $courseId }}.mrp"
                                placeholder="100"
                                class="h-9 w-full rounded-lg border border-gray-200 bg-white px-2 text-sm text-gray-800 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white/90 transition-all" />
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold text-gray-400 uppercase tracking-tight">Offer Price</label>
                            <input type="number" name="courses[{{ $courseId }}][offer_price]" wire:model.defer="selectedCourses.{{ $courseId }}.offer_price"
                                placeholder="99"
                                class="h-9 w-full rounded-lg border border-gray-200 bg-white px-2 text-sm text-gray-800 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white/90 transition-all" />
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold text-gray-400 uppercase tracking-tight">Validity</label>
                            <input type="number" name="courses[{{ $courseId }}][valid_days]" wire:model.defer="selectedCourses.{{ $courseId }}.valid_days"
                                placeholder="30"
                                class="h-9 w-full rounded-lg border border-gray-200 bg-white px-2 text-sm text-gray-800 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white/90 transition-all" />
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold text-gray-400 uppercase tracking-tight">Pass %</label>
                            <input type="number" name="courses[{{ $courseId }}][pass_percentage]" wire:model.defer="selectedCourses.{{ $courseId }}.pass_percentage"
                                placeholder="40"
                                class="h-9 w-full rounded-lg border border-gray-200 bg-white px-2 text-sm text-gray-800 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white/90 transition-all" />
                        </div>
                        <div>
                            <label class="mb-1 block text-[10px] font-bold text-gray-400 uppercase tracking-tight">Credit Points</label>
                            <input type="number" name="courses[{{ $courseId }}][points]" wire:model.defer="selectedCourses.{{ $courseId }}.points"
                                placeholder="10"
                                class="h-9 w-full rounded-lg border border-gray-200 bg-white px-2 text-sm text-gray-800 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white/90 transition-all" />
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="flex flex-col items-center justify-center p-12 bg-white rounded-3xl border border-dashed border-gray-300 text-center dark:bg-gray-900 dark:border-gray-700 transition-all">
                <div class="mb-4 p-4 bg-gray-50 rounded-full dark:bg-gray-800">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h5 class="text-sm font-bold text-gray-800 dark:text-white/90">No Courses Added</h5>
                <p class="text-xs text-gray-500 mt-1 max-w-[240px]">Please select a course above and click "Add Course" to configure settings for this council.</p>
            </div>
        @endforelse
    </div>
</div>
