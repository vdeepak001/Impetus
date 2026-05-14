@extends('layouts.frontend.app')

@section('title', 'Practice Test')

@section('content')
    <main class="pb-16">
        <div class="h-[100px]" aria-hidden="true"></div>

        {{-- Breadcrumbs Section --}}
        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="w-full">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <h1 class="font-serif text-[32px] font-extrabold tracking-tight text-brand-900 sm:text-[44px]">
                            Practice Test
                        </h1>

                        <div class="flex shrink-0 flex-wrap items-center gap-4">
                            <a 
                                href="{{ route('cne.modules.show', $course->couse_name) }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50"
                            >
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                                Back to Module
                            </a>
                        </div>
                    </div>
                    
                    <p class="mt-8 text-justify text-lg leading-relaxed text-slate-600">
                        Practice test is designed for the user to practice the questions in E-Learning platform. Each module has many sets of questions and each set has 20 questions. Each set is allowed to practice for two times for repetitive learning. It is advised to practice the test provided in this section before taking Mock / Final examination to obtain better score in the examination.
                    </p>
                </div>

                <div class="mt-16 space-y-20">
                    @php
                        $totalSets = 0;
                        foreach($levelCounts as $c) {
                            $totalSets += floor($c / 20);
                        }
                        $hasAnyQuestions = $totalSets > 0;
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
                            $setCount = floor($count / 20);
                            $themeColor = [
                                'Level 1' => ['bg' => 'bg-emerald-600', 'btn' => 'bg-emerald-600', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'light' => 'bg-emerald-50'],
                                'Level 2' => ['bg' => 'bg-sky-500', 'btn' => 'bg-sky-500', 'text' => 'text-sky-700', 'border' => 'border-sky-200', 'light' => 'bg-sky-50'],
                                'Level 3' => ['bg' => 'bg-rose-500', 'btn' => 'bg-rose-500', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'light' => 'bg-rose-50'],
                                'Other' => ['bg' => 'bg-slate-600', 'btn' => 'bg-slate-600', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'light' => 'bg-slate-50']
                            ][$levelLabel];
                        @endphp

                        @if($setCount > 0)
                            <div class="flex flex-col gap-8 lg:flex-row lg:items-start">
                                {{-- Level Badge --}}
                                <div class="shrink-0 lg:w-48">
                                    <div class="{{ $themeColor['bg'] }} inline-flex rounded-lg px-6 py-2.5 text-sm font-bold uppercase tracking-widest text-white shadow-lg shadow-black/5 ring-1 ring-white/20">
                                        {{ strtoupper($levelLabel) }}
                                    </div>
                                </div>

                                {{-- Level Table --}}
                                <div class="w-full rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">
                                    <table class="w-full text-left">
                                        <thead class="{{ $themeColor['bg'] }} text-xs font-bold uppercase tracking-[0.15em] text-white">
                                            <tr>
                                                <th class="rounded-tl-2xl px-6 py-4">Questions</th>
                                                <th class="w-32 px-6 py-4 text-center">View Progress</th>
                                                <th class="rounded-tr-2xl px-6 py-4 text-center">Attempts</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            @for ($s = 0; $s < $setCount; $s++)
                                                @php
                                                    $start = ($s * 20) + 1;
                                                    $end = min(($s + 1) * 20, $count);
                                                    $setAttempts = $userAttempts[$levelNum][$s + 1] ?? collect();
                                                    $attemptCount = $setAttempts->count();
                                                    $isLocked = $attemptCount >= 2;
                                                    $practiceUrl = route('cne.modules.test', [$course->couse_name, 'practice']) . "?level={$levelNum}&set=" . ($s + 1);
                                                @endphp
                                                <tr @class(['transition', 'hover:bg-slate-50/80' => !$isLocked, 'bg-slate-50/40 opacity-75' => $isLocked])>
                                                    <td @class(['px-6 py-4', 'rounded-bl-2xl' => $s === $setCount - 1])>
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
                                                    <td class="w-32 px-6 py-4 text-center">
                                                        <div class="relative flex justify-center" x-data="{ open: false }">
                                                            <button 
                                                                type="button" 
                                                                @click="open = !open" 
                                                                @click.away="open = false"
                                                                @disabled($attemptCount === 0) 
                                                                @class([
                                                                    'inline-flex rounded-lg p-2 transition', 
                                                                    'text-logo-blue hover:bg-logo-blue/10' => $attemptCount > 0, 
                                                                    'text-slate-300 cursor-not-allowed' => $attemptCount === 0
                                                                ])
                                                            >
                                                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                                            </button>

                                                            {{-- Progress Popover --}}
                                                            <div 
                                                                x-show="open" 
                                                                x-transition:enter="transition ease-out duration-200"
                                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                                class="absolute left-full top-1/2 z-[60] ml-3 w-40 -translate-y-1/2"
                                                                style="display: none;"
                                                            >
                                                                <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-white p-3 shadow-2xl ring-1 ring-black/5">
                                                                    <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">Attempt History</p>
                                                                    <div class="space-y-2">
                                                                        @foreach($setAttempts as $idx => $att)
                                                                            <div class="flex items-center justify-between border-t border-slate-50 pt-2 first:border-0 first:pt-0">
                                                                                <div class="text-[11px] font-medium text-slate-700">
                                                                                    #{{ $attemptCount - $idx }}
                                                                                    <span class="ml-1 text-[9px] text-slate-500 font-normal">{{ $att->completed_at?->format('d M') }}</span>
                                                                                </div>
                                                                                <div @class([
                                                                                    'text-xs font-bold',
                                                                                    'text-emerald-600' => $att->score_percent >= 80,
                                                                                    'text-amber-600' => $att->score_percent >= 50 && $att->score_percent < 80,
                                                                                    'text-rose-600' => $att->score_percent < 50
                                                                                ])>
                                                                                    {{ round($att->score_percent) }}%
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                {{-- Arrow --}}
                                                                <div class="absolute -left-1.5 top-1/2 h-3 w-3 -translate-y-1/2 rotate-45 border-b border-l border-slate-200 bg-white"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td @class(['px-6 py-4 text-center', 'rounded-br-2xl' => $s === $setCount - 1])>
                                                        <span @class(['text-base font-semibold tabular-nums', 'text-slate-600' => !$isLocked, 'text-slate-500' => $isLocked])>{{ $attemptCount }}/2</span>
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
