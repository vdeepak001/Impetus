@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div>
        <x-common.component-card>
            <form method="POST" action="{{ route($routePrefix . '.state-councils.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
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

                        <div class="md:col-span-2">
                            <label for="council_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Council Name</label>
                            <input id="council_name" type="text" name="council_name" value="{{ old('council_name') }}"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            @error('council_name') <span class="text-red-600 text-sm mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8 dark:border-gray-700">
                        <livewire:super-admin.state-council.course-manager />
                        @error('courses') <span class="text-red-600 text-sm mt-4 block font-bold tracking-tight">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        @include('super-admin.state-councils._split_up_fields')
                    </div>

                    <div class="flex items-center gap-2 mt-8">
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
