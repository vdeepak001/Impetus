@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
            User Performance: {{ $selectedState->name }}
        </h2>

        <div class="flex items-center gap-3">
            @php
                $routePrefix = request()->segment(1);
            @endphp
            <!-- CSV Download Button -->
            <a href="{{ route($routePrefix . '.reports.export-csv', request()->all()) }}" 
               class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Download CSV
            </a>

            <!-- PDF/Print Button -->
            <button onclick="window.print()" 
               class="inline-flex items-center px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Download PDF
            </button>

            <a href="{{ route($routePrefix . '.reports.index', ['state_id' => $selectedState->id]) }}" 
               class="inline-flex items-center px-6 py-2.5 bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Summary
            </a>
        </div>
    </div>

    <!-- Print-only Styles -->
    <style>
        @media print {
            nav, .bg-gray-800, form, .gap-3, a, button {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .rounded-3xl {
                border-radius: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }
            .bg-white {
                background: white !important;
            }
            .shadow-2xl {
                box-shadow: none !important;
            }
            .mb-12 {
                margin-bottom: 0 !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }
            th, td {
                border: 1px solid #e5e7eb !important;
                padding: 8px !important;
            }
            .bg-[#0082c8] {
                background-color: #0082c8 !important;
                -webkit-print-color-adjust: exact;
            }
            .text-white {
                color: white !important;
                -webkit-print-color-adjust: exact;
            }
            .text-blue-600 {
                color: #2563eb !important;
            }
        }
    </style>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 mb-8">
        <form action="{{ request()->url() }}" method="GET" class="flex flex-wrap items-end gap-4">
            <input type="hidden" name="state_id" value="{{ request('state_id') }}">
            
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Course / Module</label>
                <select name="course_id" class="block w-full pl-3 pr-10 py-2.5 text-sm border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">-- Select Module --</option>
                    @foreach($stateCourses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->couse_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-44">
                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" 
                    class="block w-full px-3 py-2 text-sm border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div class="w-full md:w-44">
                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" 
                    class="block w-full px-3 py-2 text-sm border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div class="w-full md:w-44">
                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Exam Type</label>
                <select name="exam_type" class="block w-full pl-3 pr-10 py-2.5 text-sm border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">-- All Exams --</option>
                    <option value="pre" {{ request('exam_type') == 'pre' ? 'selected' : '' }}>Pre-Test</option>
                    <option value="mock" {{ request('exam_type') == 'mock' ? 'selected' : '' }}>Mock Test</option>
                    <option value="final" {{ request('exam_type') == 'final' ? 'selected' : '' }}>Final Test</option>
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none bg-[#0082c8] hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                    Search
                </button>
                <a href="{{ request()->url() }}?state_id={{ request('state_id') }}" class="flex-1 md:flex-none text-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-white font-bold py-2.5 px-8 rounded-lg transition-all duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- User Performance Report Table -->
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-12">
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#0082c8]">
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">IHS ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Module Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20 text-center">Pre-Test</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20 text-center">Mock Exam</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20 text-center">Final</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20 text-right">Completed on</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($userAttempts as $attempt)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $attempt->user_name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $attempt->ihs_id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $attempt->course_name }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-center {{ $attempt->pre_score != '-' ? 'text-blue-600' : 'text-gray-400' }}">{{ $attempt->pre_score }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-center {{ $attempt->mock_score != '-' ? 'text-blue-600' : 'text-gray-400' }}">{{ $attempt->mock_score }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-center {{ $attempt->final_score != '-' ? 'text-blue-600' : 'text-gray-400' }}">{{ $attempt->final_score }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white text-right">{{ $attempt->completed_on }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-20 text-center">
                                <p class="text-lg font-semibold text-gray-400 dark:text-gray-500">No user performance data found for the selected filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
