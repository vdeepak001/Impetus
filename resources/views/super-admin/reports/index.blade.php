@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
            {{ $selectedState ? 'Report: ' . $selectedState->name : 'Reports' }}
        </h2>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-4 bg-white dark:bg-gray-800 px-4 py-2 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">View by State</span>
                <form action="{{ request()->url() }}" method="GET" id="stateFilterForm">
                    <select name="state_id" onchange="this.form.submit()" 
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white transition-all duration-200">
                        <option value="">--Select State--</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($selectedState)
                <a href="{{ request()->url() }}" class="inline-flex items-center px-6 py-2.5 bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back
                </a>
            @endif
        </div>
    </div>

    @if($selectedState)
        <!-- Top Stats Row: Premium Redesign -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Registered Users -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Registered Users</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($nursesCount) }}</span>
            </div>

            <!-- Purchased Modules -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Purchased Modules</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($purchasedModulesCount) }}</span>
            </div>

            <!-- Modules Completed -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Modules Completed</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($modulesCompletedCount) }}</span>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-12">
            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#0082c8]">
                            <th class="px-8 py-5 text-sm font-bold text-white uppercase tracking-widest border-b border-blue-400/20">Module Name</th>
                            <th class="px-8 py-5 text-sm font-bold text-white uppercase tracking-widest text-center border-b border-blue-400/20">Number of Nurses Completed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($moduleWisePassed as $module)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors duration-150">
                                <td class="px-8 py-5 text-base font-medium text-gray-700 dark:text-gray-300">
                                    <a href="{{ route($routePrefix . '.reports.user-performance', ['state_id' => $selectedState->id, 'course_id' => $module->id]) }}" 
                                       class="hover:text-blue-600 hover:underline transition-all duration-200">
                                        {{ $module->name }}
                                    </a>
                                </td>
                                <td class="px-8 py-5 text-base font-bold text-gray-900 dark:text-white text-center font-mono">
                                    <a href="{{ route($routePrefix . '.reports.user-performance', ['state_id' => $selectedState->id, 'course_id' => $module->id]) }}" 
                                       class="inline-flex items-center justify-center text-blue-600 hover:text-blue-700 hover:scale-110 transition-all duration-200">
                                        {{ number_format($module->passed_count) }}
                                        <svg class="w-4 h-4 ml-2 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-200 dark:text-gray-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                        <p class="text-xl font-semibold text-gray-400 dark:text-gray-500">No completion data found for this state.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <!-- Global Statistics Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Registered Users -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Registered Users</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($globalStats['registered_users']) }}</span>
            </div>

            <!-- Purchased Modules -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Purchased Modules</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($globalStats['purchased_modules']) }}</span>
            </div>

            <!-- Modules Completed -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col items-center text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 group">
                <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Modules Completed</span>
                <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ number_format($globalStats['modules_completed']) }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-2xl border border-gray-100 dark:border-gray-700 p-16 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.491V6a2 2 0 011.106-1.789l5.447-2.724a2 2 0 011.894 0l5.447 2.724A2 2 0 0118 6v9.491a2 2 0 01-1.106 1.789L11.447 20a2 2 0 01-1.894 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 8l3.5 2 3.5-2M11 10v6"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-4 tracking-tight">Select a State</h3>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-0 leading-relaxed">
                    Choose a state from the dropdown above to view detailed registration and completion reports for that specific region.
                </p>
            </div>
        </div>
    @endif
@endsection
