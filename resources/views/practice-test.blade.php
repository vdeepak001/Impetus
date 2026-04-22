@extends('layouts.frontend.app')

@section('title', 'Practice Test')

@section('content')
    <main class="pb-16">
        <div class="h-[100px]" aria-hidden="true"></div>

        {{-- Breadcrumbs Section --}}
        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                    <div class="max-w-2xl">
                        <h1 class="font-serif text-4xl font-extrabold tracking-tight text-brand-900 sm:text-5xl">
                            Practice Test
                        </h1>
                        <p class="mt-6 text-lg leading-relaxed text-slate-600">
                            Practice test is designed for the user to practice the questions in E-Learning platform. Each module has many sets of questions and each set has 20 questions. Each set is allowed to practice for two times for repetitive learning. It is advised to practice the test provided in this section before taking Mock / Final examination to obtain better score in the examination.
                        </p>
                    </div>

                    <div class="flex shrink-0 flex-wrap items-center gap-4">
                        <a 
                            href="{{ route('cne.modules.show', $course->couse_name) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50"
                        >
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                            Back to Module
                        </a>
                        <button 
                            type="button" 
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 px-6 py-3 text-sm font-bold uppercase tracking-wider text-white shadow-lg shadow-amber-500/30 transition hover:from-amber-500 hover:to-amber-600"
                        >
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                            Instructions for practice test
                        </button>
                    </div>
                </div>

                <div class="mt-16 space-y-20">
                    @php
                        $hasAnyQuestions = array_sum($levelCounts) > 0;
                    @endphp

                    @if(!$hasAnyQuestions)
                        <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-12 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                                <svg class="size-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-slate-900">No questions available yet</h3>
                            <p class="mt-2 text-slate-600">We couldn't find any practice questions for this module. Please check back later or contact support.</p>
                            <a href="{{ route('cne.modules.show', $course->couse_name) }}" class="mt-8 inline-flex items-center gap-2 font-semibold text-logo-blue hover:underline">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                                Back to module
                            </a>
                        </div>
                    @endif

                    @foreach (['Level 1', 'Level 2', 'Level 3', 'Other'] as $idx => $levelLabel)
                        @php
                            $isOther = $levelLabel === 'Other';
                            $levelKey = $isOther ? 'other' : (string)($idx + 1);
                            $levelNum = $isOther ? -1 : (int)$levelKey;
                            $count = $levelCounts[$levelKey] ?? 0;
                            $setCount = ceil($count / 20);
                            $themeColor = [
                                'Level 1' => ['bg' => 'bg-emerald-600', 'btn' => 'bg-emerald-600', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'light' => 'bg-emerald-50'],
                                'Level 2' => ['bg' => 'bg-sky-500', 'btn' => 'bg-sky-500', 'text' => 'text-sky-700', 'border' => 'border-sky-200', 'light' => 'bg-sky-50'],
                                'Level 3' => ['bg' => 'bg-rose-500', 'btn' => 'bg-rose-500', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'light' => 'bg-rose-50'],
                                'Other' => ['bg' => 'bg-slate-600', 'btn' => 'bg-slate-600', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'light' => 'bg-slate-50']
                            ][$levelLabel];
                        @endphp

                        @if($count > 0)
                            <div class="flex flex-col gap-8 lg:flex-row lg:items-start">
                                {{-- Level Badge --}}
                                <div class="shrink-0 lg:w-48">
                                    <div class="{{ $themeColor['bg'] }} inline-flex rounded-lg px-6 py-2.5 text-sm font-bold uppercase tracking-widest text-white shadow-lg shadow-black/5 ring-1 ring-white/20">
                                        {{ strtoupper($levelLabel) }}
                                    </div>
                                </div>

                                {{-- Level Table --}}
                                <div class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">
                                    <table class="w-full text-left">
                                        <thead class="{{ $themeColor['bg'] }} text-xs font-bold uppercase tracking-[0.15em] text-white">
                                            <tr>
                                                <th class="px-6 py-4">Questions</th>
                                                <th class="px-6 py-4 text-center">View Progress</th>
                                                <th class="px-6 py-4 text-center">Attempts</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            @for ($s = 0; $s < $setCount; $s++)
                                                @php
                                                    $start = ($s * 20) + 1;
                                                    $end = min(($s + 1) * 20, $count);
                                                    $attempts = $userAttempts[$levelNum][$s + 1] ?? 0;
                                                    $isLocked = $attempts >= 2;
                                                    $practiceUrl = route('cne.modules.test', [$course->couse_name, 'practice']) . "?level={$levelNum}&set=" . ($s + 1);
                                                @endphp
                                                <tr @class(['transition', 'hover:bg-slate-50/80' => !$isLocked, 'bg-slate-50/40 opacity-75' => $isLocked])>
                                                    <td class="px-6 py-4">
                                                        @if ($isLocked)
                                                            <div class="flex items-center gap-2 font-semibold text-slate-400">
                                                                <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] text-slate-300">SET {{ $s + 1 }}</span>
                                                                {{ $start }} - {{ $end }}
                                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                                            </div>
                                                        @else
                                                            <a href="{{ $practiceUrl }}" class="group flex items-center gap-2 font-semibold text-slate-700 hover:text-logo-blue">
                                                                <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] text-slate-400 group-hover:bg-logo-blue/10 group-hover:text-logo-blue">SET {{ $s + 1 }}</span>
                                                                {{ $start }} - {{ $end }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <button type="button" @disabled($isLocked) @class(['inline-flex rounded-lg p-2 transition', 'text-slate-400 hover:bg-logo-blue/10 hover:text-logo-blue' => !$isLocked, 'text-slate-300' => $isLocked])>
                                                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <span @class(['text-sm font-medium tabular-nums', 'text-slate-500' => !$isLocked, 'text-slate-400' => $isLocked])>{{ $attempts }}/2</span>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
