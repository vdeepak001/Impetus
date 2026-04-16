@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <x-common.component-card title="Level Score Information">
        <form method="POST" action="{{ route($routePrefix . '.level-scores.store') }}">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div>
                    <label for="level_1" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Level 1</label>
                    <input id="level_1" type="number" min="0" name="level_1" value="{{ old('level_1', $levelScore?->level_1) }}" required
                           class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    @error('level_1') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="level_2" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Level 2</label>
                    <input id="level_2" type="number" min="0" name="level_2" value="{{ old('level_2', $levelScore?->level_2) }}" required
                           class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    @error('level_2') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="level_3" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Level 3</label>
                    <input id="level_3" type="number" min="0" name="level_3" value="{{ old('level_3', $levelScore?->level_3) }}" required
                           class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    @error('level_3') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            @if (in_array(auth()->user()?->role_type, ['superadmin', 'admin'], true))
                <div class="mt-8 flex items-center justify-end">
                    <x-ui.button type="submit">
                        Save Level Score
                    </x-ui.button>
                </div>
            @endif
        </form>
    </x-common.component-card>
@endsection
