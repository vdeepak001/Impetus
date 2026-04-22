<div>
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 dark:bg-gray-800">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[200px] relative">
                <input type="text" wire:model.live.debounce.500ms="search"
                       class="block w-full pl-3 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                       placeholder="Search state, council or course...">
                <div wire:loading wire:target="search" class="absolute right-3 top-2.5">
                    <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <a href="{{ route($routePrefix . '.state-councils.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 flex-shrink-0">
                Add New
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 cursor-pointer" wire:click="sortBy('id')">#</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">State</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Council</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Course</th>
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Sequence</th> --}}
                  
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($stateCouncils as $stateCouncil)
                    <tr wire:key="state-council-{{ $stateCouncil->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ ($stateCouncils->currentPage() - 1) * $stateCouncils->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $stateCouncil->state?->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $stateCouncil->council_name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            <div class="flex flex-col gap-1.5">
                                @forelse($stateCouncil->courseDetails as $index => $course)
                                    <div class="flex items-start">
                                        <span class="inline-flex items-center justify-center min-w-[1.5rem] h-5 mr-1.5 text-[10px] font-bold bg-gray-100 text-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="leading-5">{{ $course->couse_name }}</span>
                                    </div>
                                @empty
                                    <span class="text-gray-400 italic">No courses assigned</span>
                                @endforelse
                            </div>
                        </td>
                        {{-- <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $stateCouncil->courseDetails->pluck('sequence')->filter()->join(', ') ?: '—' }}
                        </td> --}}
                       

                        <td class="px-6 py-4 whitespace-nowrap">
                            <button type="button" wire:click="toggleStatus({{ $stateCouncil->id }})" class="focus:outline-none" wire:loading.attr="disabled">
                                @if ($stateCouncil->active_status)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-400 cursor-pointer hover:opacity-90">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-400 cursor-pointer hover:opacity-90">Inactive</span>
                                @endif
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route($routePrefix . '.state-councils.edit', $stateCouncil) }}"
                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                    Edit
                                </a>
                                <form action="{{ route($routePrefix . '.state-councils.destroy', $stateCouncil) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this state council?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $viewType === 'modules' ? 12 : 8 }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center dark:text-gray-400">
                            No state councils found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $stateCouncils->links() }}
        </div>
    </div>
</div>
