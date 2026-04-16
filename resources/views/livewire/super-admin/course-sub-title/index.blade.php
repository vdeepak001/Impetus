@php
    $user = auth()->user();
    $prefix = \App\Helpers\MenuHelper::getPrefixForRole($user?->role_type);
    $routePrefix = $prefix ?? 'super-admin';
@endphp

<div>
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 dark:bg-gray-800">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Search Bar -->
            <div class="flex-1 min-w-[200px] relative">
                <input type="text" wire:model.live.debounce.500ms="search"
                       class="block w-full pl-3 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                       placeholder="Search sub-titles...">
                <div wire:loading wire:target="search" class="absolute right-3 top-2.5">
                    <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="button" wire:click="setFilter('all')" wire:key="filter-all" wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors whitespace-nowrap {{ $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                    All ({{ $totalCount }})
                </button>
                <button type="button" wire:click="setFilter('active')" wire:key="filter-active" wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors whitespace-nowrap {{ $filter === 'active' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                    Active ({{ $activeCount }})
                </button>
                <button type="button" wire:click="setFilter('inactive')" wire:key="filter-inactive" wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors whitespace-nowrap {{ $filter === 'inactive' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                    Inactive ({{ $inactiveCount }})
                </button>
            </div>

            @if ($user->role_type === 'admin' && Route::has($routePrefix . '.course-sub-titles.create'))
                <a href="{{ route($routePrefix . '.course-sub-titles.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 flex-shrink-0">
                    Add New Sub-Title
                </a>
            @endif
        </div>
    </div>



        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Course
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 cursor-pointer" wire:click="sortBy('title_name')">
                        Sub-Title Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Created By
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 cursor-pointer" wire:click="sortBy('active_status')">
                        Status
                    </th>
                    @if ($routePrefix === 'admin')
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Action
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($subTitles as $title)
                    <tr wire:key="title-{{ $title->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ ($subTitles->currentPage() - 1) * $subTitles->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $title->course->couse_name ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $title->title_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            <div>{{ $title->user?->name ?? 'System' }}</div>
                            <div class="text-xs text-gray-500 uppercase">{{ $title->user?->role_type ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($routePrefix === 'admin')
                                <button wire:click="toggleStatus({{ $title->id }})" class="focus:outline-none">
                                    @if ($title->active_status)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                </button>
                            @else
                                @if ($title->active_status)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            @endif
                        </td>
                        @if ($routePrefix === 'admin' && Route::has($routePrefix . '.course-sub-titles.edit'))
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route($routePrefix . '.course-sub-titles.edit', $title) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                        Edit
                                    </a>
                                    @if(Route::has($routePrefix . '.course-sub-titles.destroy'))
                                    <form action="{{ route($routePrefix . '.course-sub-titles.destroy', $title) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this sub-title?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                            Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $routePrefix === 'admin' ? 6 : 5 }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center dark:text-gray-400">
                            No sub-titles found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $subTitles->links() }}
        </div>
    </div>
</div>
