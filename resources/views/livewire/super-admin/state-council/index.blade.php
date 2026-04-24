<div>
    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-4 mb-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex-1 max-w-md relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live.debounce.500ms="search"
                       class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200"
                       placeholder="Search states, councils or courses...">
                <div wire:loading wire:target="search" class="absolute right-3 top-2.5">
                    <svg class="animate-spin h-4 w-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <a href="{{ route($routePrefix . '.state-councils.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm shadow-indigo-200 transition-all active:scale-[0.98] flex-shrink-0">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Council
            </a>
        </div>
    </div>

    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        #
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400 cursor-pointer hover:text-indigo-600 transition-colors" wire:click="sortBy('states.name')">
                        <div class="flex items-center gap-1">
                            State
                            @if($sortField === 'states.name')
                                <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400 cursor-pointer hover:text-indigo-600 transition-colors" wire:click="sortBy('council_name')">
                        <div class="flex items-center gap-1">
                            Council
                            @if($sortField === 'council_name')
                                <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Courses
                    </th>
                    <th scope="col" class="px-4 py-3 text-center text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-3 text-right text-[11px] font-semibold text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($stateCouncils as $stateCouncil)
                    <tr wire:key="state-council-{{ $stateCouncil->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-4 py-3 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            {{ ($stateCouncils->currentPage() - 1) * $stateCouncils->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $stateCouncil->state?->name ?? '—' }}
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $stateCouncil->council_name ?? '—' }}
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @forelse($stateCouncil->courseDetails as $index => $course)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-900/20 dark:text-indigo-300 dark:border-indigo-800">
                                        {{ $course->couse_name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-400 italic">No courses</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            <button type="button" wire:click="toggleStatus({{ $stateCouncil->id }})" class="focus:outline-none" wire:loading.attr="disabled">
                                @if ($stateCouncil->active_status)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-200 dark:border-gray-600">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-gray-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </button>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route($routePrefix . '.state-councils.edit', $stateCouncil) }}"
                                   class="p-1 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 dark:text-gray-400 dark:hover:text-indigo-400 dark:hover:bg-indigo-900/20 transition-all" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route($routePrefix . '.state-councils.destroy', $stateCouncil) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this state council?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-lg text-gray-500 hover:text-rose-600 hover:bg-rose-50 dark:text-gray-400 dark:hover:text-rose-400 dark:hover:bg-rose-900/20 transition-all" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 whitespace-nowrap text-sm text-gray-500 text-center dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-8 h-8 text-gray-300 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <p>No state councils found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            {{ $stateCouncils->links() }}
        </div>
    </div>
</div>
