@extends('layouts.app')

@section('content')
    @php
        $metrics = [];

        if (auth()->user()->role_type !== 'support') {
            $metrics = [
                [
                    'title' => 'Total Courses',
                    'value' => $stats['total_courses'],
                    'subtitle' => 'CNE Curriculum Catalog',
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'icon_wrapper' => 'bg-brand-50 text-brand-500 dark:bg-brand-500/15',
                ],
                [
                    'title' => 'Active Courses',
                    'value' => $stats['active_courses'],
                    'subtitle' => 'Active & Available Modules',
                    'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                    'icon_wrapper' => 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15',
                ],
                [
                    'title' => 'Learning Materials',
                    'value' => $stats['total_materials'],
                    'subtitle' => 'Documents, PDFs & Multimedia',
                    'icon' => 'M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2',
                    'icon_wrapper' => 'bg-sky-50 text-sky-600 dark:bg-sky-500/15',
                ],
                [
                    'title' => 'Total Questions',
                    'value' => $stats['total_questions'],
                    'subtitle' => 'Assessment Question Pool',
                    'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'icon_wrapper' => 'bg-orange-50 text-orange-600 dark:bg-orange-500/15',
                ],
            ];
        }

        $metrics[] = [
            'title' => 'Total Users',
            'value' => $stats['total_users'],
            'subtitle' => 'Registered Portal Members',
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
            'icon_wrapper' => 'bg-purple-50 text-purple-600 dark:bg-purple-500/15',
        ];

        $metrics[] = [
            'title' => 'Active Users',
            'value' => $stats['active_users'],
            'subtitle' => 'Actively Learning/Certifying',
            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'icon_wrapper' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15',
        ];
    @endphp

    <div class="space-y-6">
        <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-r from-[#1b2450] via-[#182a5e] to-[#2b1d48] p-6 shadow-xl sm:p-8 dark:border-gray-800">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_100%_0%,rgba(236,72,153,0.16),transparent_35%)]"></div>
            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="mb-3 text-xs font-semibold tracking-[0.18em] text-logo-light-green uppercase">
                        System Administration
                    </p>
                    <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                        Welcome back, {{ auth()->user()->name }}!
                    </h1>
                    <p class="mt-3 text-sm leading-6 text-slate-200">
                        Here is a quick overview of your learning platform metrics. Monitor courses, track assessment content, and follow active user engagement.
                    </p>
                </div>
                <div class="inline-flex items-center gap-3 self-start rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                    <div>
                        <p class="text-[11px] font-medium tracking-[0.16em] text-slate-300 uppercase">Platform Status</p>
                        <p class="text-sm font-semibold text-white">Fully Operational</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-logo-light-green dark:text-logo-light-green">Platform Metrics</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">Real-time statistics across courses, materials, questions, and users.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                @foreach($metrics as $metric)
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ $metric['icon_wrapper'] }}">
                            <svg class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="{{ $metric['icon'] }}"></path>
                            </svg>
                        </div>
                        <p class="mt-5 text-xs font-semibold tracking-[0.1em] text-slate-500 uppercase dark:text-gray-400">{{ $metric['title'] }}</p>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">{{ number_format($metric['value']) }}</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">{{ $metric['subtitle'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection
