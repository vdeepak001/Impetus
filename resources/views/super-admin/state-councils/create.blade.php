@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div>
        <x-common.component-card title="State Council Information">
            <form method="POST" action="{{ route($routePrefix . '.state-councils.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="state_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">State</label>
                        <select id="state_id" name="state_id" required autofocus
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state_id') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="council_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Council Name</label>
                        <input id="council_name" type="text" name="council_name" value="{{ old('council_name') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('council_name') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="course_detail_ids" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Courses (hold Ctrl/Cmd to select multiple)</label>
                        <select id="course_detail_ids" name="course_detail_ids[]" multiple required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 min-h-[120px] w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ in_array($course->id, old('course_detail_ids', [])) ? 'selected' : '' }}>
                                    {{ $course->couse_name }} ({{ $course->course_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_detail_ids') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                        @error('course_detail_ids.*') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="pass_percentage" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pass Percentage (comma-separated)</label>
                        <input id="pass_percentage" type="text" name="pass_percentage" value="{{ is_array(old('pass_percentage')) ? implode(', ', old('pass_percentage')) : old('pass_percentage') }}"
                            placeholder="e.g. 40, 50, 60"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('pass_percentage') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="mrp" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">MRP (comma-separated)</label>
                        <input id="mrp" type="text" name="mrp" value="{{ is_array(old('mrp')) ? implode(', ', old('mrp')) : old('mrp') }}"
                            placeholder="e.g. 100, 200"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('mrp') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="price" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Price (comma-separated)</label>
                        <input id="price" type="text" name="price" value="{{ is_array(old('price')) ? implode(', ', old('price')) : old('price') }}"
                            placeholder="e.g. 99, 199"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('price') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="points" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Points (comma-separated)</label>
                        <input id="points" type="text" name="points" value="{{ is_array(old('points')) ? implode(', ', old('points')) : old('points') }}"
                            placeholder="e.g. 10, 20"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('points') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="valid_days" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Valid Days (comma-separated)</label>
                        <input id="valid_days" type="text" name="valid_days" value="{{ is_array(old('valid_days')) ? implode(', ', old('valid_days')) : old('valid_days') }}"
                            placeholder="e.g. 30, 60, 90"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        @error('valid_days') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="active_status" type="checkbox" name="active_status" value="1" {{ old('active_status', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-600 dark:bg-gray-800" />
                        <label for="active_status" class="text-sm font-medium text-gray-700 dark:text-gray-400">Active</label>
                        @error('active_status') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8">
                    <x-ui.button variant="outline" type="button" onclick="window.location='{{ route($routePrefix . '.state-councils.state-wise-modules') }}'">
                        Cancel
                    </x-ui.button>
                    <x-ui.button type="submit">Create State Council</x-ui.button>
                </div>
            </form>
        </x-common.component-card>
    </div>
@endsection
