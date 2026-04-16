<div>
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 dark:bg-gray-800">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Search Bar -->
            <div class="flex-1 min-w-[200px] relative">
                <input type="text" wire:model.live.debounce.500ms="search"
                       class="block w-full pl-3 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                       placeholder="Search materials, courses, or titles...">
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

            @if(in_array($routePrefix, ['super-admin', 'admin']))
                <!-- Add New Button -->
                <a href="{{ route($routePrefix . '.title-materials.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 flex-shrink-0">
                    Add New Material
                </a>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 cursor-pointer" wire:click="sortBy('id')">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Course
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Sub Title
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Description
                    </th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Files
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Created By
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 cursor-pointer" wire:click="sortBy('active_status')">
                        Status
                    </th> --}}
                    @if(in_array($routePrefix, ['super-admin', 'admin']))
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Action
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($materials as $material)
                    <tr wire:key="material-{{ $material->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ ($materials->currentPage() - 1) * $materials->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $material->course->couse_name ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $material->description ?: ($material->courseTitle->title_name ?? 'N/A') }}
                            </div>
                        </td>
                        {{-- <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            <div class="truncate max-w-xs">{{ $material->description }}</div>
                        </td> --}}
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            @if($material->attachment && count($material->attachment) > 0)
                                <ul class="flex items-center gap-2 whitespace-nowrap">
                                    @foreach($material->attachment as $path)
                                        @php
                                            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                        @endphp
                                        <li class="inline-flex">
                                            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="inline-flex items-center gap-2 rounded-md border border-slate-200 bg-slate-100 px-2.5 py-1 text-blue-600 hover:bg-slate-200 hover:text-blue-900 dark:border-gray-600 dark:bg-gray-700 dark:text-blue-400 dark:hover:bg-gray-600 dark:hover:text-blue-300">
                                                @if($extension === 'pdf')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5v-15A2.25 2.25 0 016.75 2.25h7.5L19.5 8.25z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 2.25V8.25H19.5" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 16.5h7.5M8.25 13.5h4.5" />
                                                    </svg>
                                                @elseif(in_array($extension, ['ppt', 'pptx']))
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5v-15A2.25 2.25 0 016.75 2.25h7.5L19.5 8.25z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 2.25V8.25H19.5" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5v-4.5h3a2.25 2.25 0 010 4.5H9zM15.75 12v4.5" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5v-15A2.25 2.25 0 016.75 2.25h7.5L19.5 8.25z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 2.25V8.25H19.5" />
                                                    </svg>
                                                @endif
                                                <span>File {{ $loop->iteration }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400 dark:text-gray-500 italic text-xs">No files</span>
                            @endif
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            <div>{{ $material->user?->name ?? 'System' }}</div>
                            <div class="text-xs text-gray-500 uppercase">{{ $material->user?->role_type ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(in_array($routePrefix, ['super-admin', 'admin']))
                                <button wire:click="toggleStatus({{ $material->id }})" class="focus:outline-none">
                                    @if ($material->active_status)
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
                                @if ($material->active_status)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            @endif
                        </td> --}}
                        @if(in_array($routePrefix, ['super-admin', 'admin']))
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route($routePrefix . '.title-materials.edit', $material) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                        Edit
                                    </a>
                                    <form action="{{ route($routePrefix . '.title-materials.destroy', $material) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this material?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                            <td colspan="{{ in_array($routePrefix, ['super-admin', 'admin']) ? 6 : 5 }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center dark:text-gray-400">
                            No materials found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $materials->links() }}
        </div>
    </div>
</div>
