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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Sequence</th>
                    @if($viewType === 'modules')
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">MRP</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Points</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Valid Days</th>
                    @else
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Pass %</th>
                    @endif
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
                            {{ $stateCouncil->courseDetails->pluck('couse_name')->join(', ') ?: '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $stateCouncil->courseDetails->pluck('sequence')->filter()->join(', ') ?: '—' }}
                        </td>
                        @if($viewType === 'modules')
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 align-top">
                                @forelse($stateCouncil->courseDetails as $course)
                                    <div class="mb-3 last:mb-0 pb-3 last:pb-0 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                        <div class="text-[9px] font-bold text-gray-400 mb-1 uppercase tracking-tight">{{ $course->course_code }}</div>
                                        @if(is_array($course->pivot->mrp) && count($course->pivot->mrp) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($course->pivot->mrp as $idx => $val)
                                                    <span class="px-1.5 py-0.5 rounded bg-slate-50 text-slate-600 dark:bg-slate-700 dark:text-slate-300 text-[9px] font-extrabold border border-slate-100 dark:border-slate-600">
                                                        L{{ $idx + 1 }}: {{ $val }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[9px] text-gray-400 italic">No settings</span>
                                        @endif
                                    </div>
                                @empty
                                    <span class="text-gray-400">—</span>
                                @endforelse
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 align-top">
                                @foreach($stateCouncil->courseDetails as $course)
                                    <div class="mb-3 last:mb-0 pb-3 last:pb-0 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                        <div class="text-[9px] font-bold text-gray-400 mb-1 uppercase tracking-tight invisible h-3">{{ $course->course_code }}</div>
                                        @if(is_array($course->pivot->offer_price) && count($course->pivot->offer_price) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($course->pivot->offer_price as $idx => $val)
                                                    <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 text-[9px] font-extrabold border border-emerald-100 dark:border-emerald-800">
                                                        L{{ $idx + 1 }}: {{ $val }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[9px] text-gray-400 italic">No settings</span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 align-top">
                                @foreach($stateCouncil->courseDetails as $course)
                                    <div class="mb-3 last:mb-0 pb-3 last:pb-0 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                        <div class="text-[9px] font-bold text-gray-400 mb-1 uppercase tracking-tight invisible h-3">{{ $course->course_code }}</div>
                                        @if(is_array($course->pivot->points) && count($course->pivot->points) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($course->pivot->points as $idx => $val)
                                                    <span class="px-1.5 py-0.5 rounded bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-[9px] font-extrabold border border-amber-100 dark:border-amber-800">
                                                        L{{ $idx + 1 }}: {{ $val }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[9px] text-gray-400 italic">No settings</span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 align-top">
                                @foreach($stateCouncil->courseDetails as $course)
                                    <div class="mb-3 last:mb-0 pb-3 last:pb-0 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                        <div class="text-[9px] font-bold text-gray-400 mb-1 uppercase tracking-tight invisible h-3">{{ $course->course_code }}</div>
                                        @if(is_array($course->pivot->valid_days) && count($course->pivot->valid_days) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($course->pivot->valid_days as $idx => $val)
                                                    <span class="px-1.5 py-0.5 rounded bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 text-[9px] font-extrabold border border-indigo-100 dark:border-indigo-800">
                                                        L{{ $idx + 1 }}: {{ $val }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[9px] text-gray-400 italic">No settings</span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                        @else
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 align-top">
                                @foreach($stateCouncil->courseDetails as $course)
                                    <div class="mb-3 last:mb-0 pb-3 last:pb-0 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                        <div class="text-[9px] font-bold text-gray-400 mb-1 uppercase tracking-tight">{{ $course->course_code }}</div>
                                        @if(is_array($course->pivot->pass_percentage) && count($course->pivot->pass_percentage) > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($course->pivot->pass_percentage as $idx => $val)
                                                    <span class="px-1.5 py-0.5 rounded bg-brand-50 text-brand-700 dark:bg-brand-900/30 dark:text-brand-400 text-[9px] font-extrabold border border-brand-100 dark:border-brand-800">
                                                        L{{ $idx + 1 }}: {{ $val }}%
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[9px] text-gray-400 italic">No settings</span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                        @endif
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
