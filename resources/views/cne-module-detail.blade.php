@extends('layouts.frontend.app')

@section('title', $course->couse_name ?? 'Module')

@section('content')
    @php
        $title = $course->couse_name ?? 'Module';
        $imgUrl = $course->attachmentPublicUrl();
        $isImage = $course->attachmentIsImage();
        $buyUrl = $course->course_url
            ? (\Illuminate\Support\Str::isUrl($course->course_url) ? $course->course_url : url($course->course_url))
            : null;
        $isPurchased = $isPurchased ?? false;
        $canViewLearningMaterials = auth()->check()
            && auth()->user()?->role_type === 'user'
            && $isPurchased;
        $creditPoints = 'NA';
        if (isset($course->stateCouncils) && $course->stateCouncils->count() > 0) {
            $rawPoints = $course->stateCouncils->first()->pivot->points;
            if (is_array($rawPoints)) {
                $creditPoints = array_sum($rawPoints);
            } else {
                $creditPoints = $rawPoints;
            }
            $creditPoints = filled($creditPoints) ? $creditPoints : 'NA';
        }
        $hasCourseMaterials = $hasCourseMaterials ?? false;
    @endphp

    <main
        class="pb-16"
        x-data="{
            practiceGateOpen: false,
            scoreCardOpen: false,
            scoreCardData: {
                title: '',
                score: 0,
                correct: 0,
                wrong: 0,
                total: 0,
                duration: '—'
            },
            init() {
                this.$watch('practiceGateOpen', value => {
                    document.body.style.overflow = value ? 'hidden' : '';
                });
                this.$watch('scoreCardOpen', value => {
                    document.body.style.overflow = value ? 'hidden' : '';
                });
            },
        }"
        @keydown.escape.window="practiceGateOpen = false; scoreCardOpen = false"
    >
        <div class="h-[100px]" aria-hidden="true"></div>

        {{-- Hero + overview (aligned with Practice Test / site theme) --}}
        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 py-14 sm:py-20">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                    <div class="min-w-0 flex-1">
                        <a
                            href="{{ route('cne.modules') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/90 px-3 py-1.5 text-xs font-semibold uppercase tracking-wide text-slate-600 shadow-sm transition hover:border-logo-blue hover:text-logo-blue focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                        >
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                            Back to List
                        </a>

                        <h1 class="mt-5 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            {{ $title }}
                        </h1>

                    </div>
                    @php
                        $buyButtonClass = 'inline-flex shrink-0 items-center justify-center rounded-xl bg-logo-blue px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2';
                        $purchasedButtonClass = 'inline-flex shrink-0 items-center justify-center rounded-xl bg-emerald-600 px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-emerald-600/25 ring-2 ring-emerald-500/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2';
                    @endphp
                    <div class="shrink-0">
                        @if (Auth::check())
                            @if (auth()->user()?->role_type === 'user')
                                @if ($isPurchased)
                                    <div class="flex flex-wrap items-center justify-end gap-3">
                                        @php
                                            $tp = $courseTestProgress;
                                            $mockDone = $tp['mock_done'] ?? false;
                                            $preDone = $tp['pre_done'] ?? false;
                                            $finalDone = $tp['final_done'] ?? false;

                                            $canMock = (bool) $tp;
                                            $canPre = $tp && $mockDone;
                                            $canFinal = $tp && $preDone;

                                            $nextTest = null;
                                            if ($tp) {
                                                if (! $mockDone) {
                                                    $nextTest = 'mock';
                                                } elseif (! $preDone) {
                                                    $nextTest = 'pre';
                                                } elseif (! $finalDone) {
                                                    $nextTest = 'final';
                                                }
                                            }

                                            $btnBase = 'inline-flex items-center justify-center rounded-xl border-2 px-8 py-3.5 text-base font-bold uppercase tracking-wide transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';
                                            $btnActive = 'ring-2 ring-offset-2 ring-logo-blue ring-offset-white shadow-md';

                                            $mockClass = "border-amber-500/40 bg-white text-amber-700 hover:border-amber-500 hover:bg-amber-500 hover:text-white focus-visible:ring-amber-500 " . ($nextTest === 'mock' ? $btnActive : '');
                                            $preClass = "border-emerald-500/40 bg-white text-emerald-700 hover:border-emerald-600 hover:bg-emerald-600 hover:text-white focus-visible:ring-emerald-600 " . ($nextTest === 'pre' ? $btnActive : '');
                                            $finalClass = "border-rose-500/40 bg-white text-rose-700 hover:border-rose-600 hover:bg-rose-600 hover:text-white focus-visible:ring-rose-600 " . ($nextTest === 'final' ? $btnActive : '');

                                            $doneClass = 'cursor-not-allowed border-slate-200 bg-slate-50 text-slate-400 opacity-80';
                                            $lockedClass = 'cursor-not-allowed border-slate-200/50 bg-slate-100/50 text-slate-300';
                                        @endphp

                                        {{-- Mock Test --}}
                                        @if ($mockDone)
                                            <button 
                                                type="button"
                                                @click="scoreCardOpen = true; scoreCardData = { 
                                                    title: 'Mock Test Result',
                                                    score: '{{ number_format((float) $tp['mock_score'], 1) }}',
                                                    correct: '{{ $tp['mock_correct'] }}',
                                                    wrong: '{{ $tp['mock_wrong'] }}',
                                                    total: '{{ $tp['mock_total'] }}',
                                                    duration: '{{ $tp['mock_duration'] }}'
                                                }"
                                                class="{{ $btnBase }} {{ $mockClass }} border-logo-blue/30 bg-logo-blue/5"
                                            >
                                                Mock <svg class="ml-2 h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            </button>
                                        @elseif ($canMock)
                                            <a href="{{ route('cne.modules.test', [$course->couse_name, 'mock']) }}" class="{{ $btnBase }} {{ $mockClass }}">Mock</a>
                                        @else
                                            <span class="{{ $btnBase }} {{ $lockedClass }}" title="Tests are unavailable">Mock</span>
                                        @endif

                                        {{-- Pre Test --}}
                                        @if ($preDone)
                                            <button 
                                                type="button"
                                                @click="scoreCardOpen = true; scoreCardData = { 
                                                    title: 'Pre Test Result',
                                                    score: '{{ number_format((float) $tp['pre_score'], 1) }}',
                                                    correct: '{{ $tp['pre_correct'] }}',
                                                    wrong: '{{ $tp['pre_wrong'] }}',
                                                    total: '{{ $tp['pre_total'] }}',
                                                    duration: '{{ $tp['pre_duration'] }}'
                                                }"
                                                class="{{ $btnBase }} {{ $preClass }} border-logo-blue/30 bg-logo-blue/5"
                                            >
                                                Pre <svg class="ml-2 h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            </button>
                                        @elseif ($canPre)
                                            <a href="{{ route('cne.modules.test', [$course->couse_name, 'pre']) }}" class="{{ $btnBase }} {{ $preClass }}">Pre</a>
                                        @else
                                            <span class="{{ $btnBase }} {{ $lockedClass }}" title="Complete the mock test first">Pre</span>
                                        @endif

                                        {{-- Final Test --}}
                                        @if ($finalDone && ($tp['final_passed'] ?? false))
                                            <button 
                                                type="button"
                                                @click="scoreCardOpen = true; scoreCardData = { 
                                                    title: 'Final Test Result',
                                                    score: '{{ number_format((float) $tp['final_score'], 1) }}',
                                                    correct: '{{ $tp['final_correct'] }}',
                                                    wrong: '{{ $tp['final_wrong'] }}',
                                                    total: '{{ $tp['final_total'] }}',
                                                    duration: '{{ $tp['final_duration'] }}'
                                                }"
                                                class="{{ $btnBase }} {{ $finalClass }} border-logo-blue/30 bg-logo-blue/5"
                                            >
                                                Final 
                                                <svg class="ml-2 h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            </button>
                                        @elseif ($canFinal)
                                            <a href="{{ route('cne.modules.test', [$course->couse_name, 'final']) }}" class="{{ $btnBase }} {{ $finalClass }}">
                                                @if ($finalDone)
                                                    Retake Final ({{ number_format((float) $tp['final_score'], 1) }}%)
                                                @else
                                                    Final
                                                @endif
                                            </a>
                                        @else
                                            <span class="{{ $btnBase }} {{ $lockedClass }}" title="Complete the pre test first">Final</span>
                                        @endif

                                        <span class="text-base font-bold text-green-600" role="status">
                                            Credit Point: {{ $creditPoints }}
                                        </span>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('cart.items.store', $course->couse_name) }}">
                                        @csrf
                                        <button type="submit" class="{{ $buyButtonClass }}">
                                            Buy now
                                        </button>
                                    </form>
                                @endif
                            @elseif ($buyUrl)
                                <a
                                    href="{{ $buyUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="{{ $buyButtonClass }}"
                                >
                                    Buy now
                                </a>
                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="{{ $buyButtonClass }} cursor-not-allowed opacity-90 hover:bg-logo-blue"
                                    title="Purchase link is not set for this module in the admin yet."
                                >
                                    Buy now
                                </button>
                            @endif
                        @else
                            @if (Route::has('login'))
                                <button type="button" @click="$dispatch('open-login-modal')" class="{{ $buyButtonClass }}">
                                    Buy now
                                </button>
                            @elseif ($buyUrl)
                                <a
                                    href="{{ $buyUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="{{ $buyButtonClass }}"
                                >
                                    Buy now
                                </a>
                            @else
                                <button
                                    type="button"
                                    disabled
                                    class="{{ $buyButtonClass }} cursor-not-allowed opacity-90"
                                    title="Purchase link is not set for this module."
                                >
                                    Buy now
                                </button>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="mt-12 grid items-start gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                    <div class="order-2 min-w-0 lg:order-1">
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 font-serif sm:text-3xl">
                            What you will learn in {{ $title }}?
                        </h2>
                        @if (filled($course->description))
                            <div class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        @else
                            <p class="mt-6 text-lg leading-8 text-slate-500 text-justify">Details for this module will be available soon.</p>
                        @endif
                    </div>
                    <div class="relative order-1 w-full min-w-0 lg:order-2">
                        <div class="relative">
                            <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/25 via-transparent to-logo-blue/20 blur-2xl"></div>
                            <div class="relative overflow-hidden rounded-3xl border border-slate-200/70 bg-white shadow-xl shadow-slate-300/30 ring-1 ring-slate-200/40">
                                @if ($imgUrl && $isImage)
                                    <img
                                        src="{{ $imgUrl }}"
                                        alt="{{ $title }}"
                                        class="aspect-[4/3] w-full object-cover sm:aspect-[5/4] lg:min-h-[280px]"
                                        loading="eager"
                                    >
                                @elseif ($imgUrl)
                                    <div class="flex flex-col items-center justify-center gap-4 bg-slate-50 px-8 py-16 text-center">
                                        <span class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-logo-blue shadow-sm ring-1 ring-slate-200/80">Document</span>
                                        <a
                                            href="{{ $imgUrl }}"
                                            class="font-medium text-logo-blue underline decoration-logo-blue/30 underline-offset-2 hover:text-brand-600"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Open attachment
                                        </a>
                                    </div>
                                @else
                                    <div class="flex aspect-[4/3] flex-col items-center justify-center bg-gradient-to-br from-slate-100 via-white to-logo-light-green/10 text-slate-400">
                                        <svg class="mb-3 h-12 w-12 text-logo-light-green/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3A1.5 1.5 0 001.5 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008H12V8.25z" />
                                        </svg>
                                        <span class="text-sm font-medium">No image uploaded</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Learning resources + learning materials link --}}
        @if (filled($course->qa_content) || $hasCourseMaterials)
            <section class="relative z-10 -mt-px border-t border-amber-200/50 bg-gradient-to-b from-[#fffdf8] via-[#fdf8ee] to-[#faf3e8] py-16 sm:py-24">
                <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-300/40 to-transparent"></div>
                <div class="pointer-events-none absolute left-1/4 top-20 h-40 w-40 rounded-full bg-logo-light-green/10 blur-3xl"></div>
                <div class="pointer-events-none absolute bottom-10 right-1/4 h-32 w-32 rounded-full bg-logo-blue/10 blur-2xl"></div>

                <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="grid grid-cols-1 items-start gap-10 sm:gap-12 lg:grid-cols-[minmax(0,13.5rem)_minmax(0,1fr)] lg:gap-x-12 xl:gap-x-16">
                        <div class="flex shrink-0 justify-center lg:justify-start">
                            <div class="w-52 sm:w-56">
                                <div class="relative h-36 w-44 sm:h-40 sm:w-56">
                                    <div class="absolute left-0 top-3 flex h-[5.25rem] w-[6.5rem] items-center justify-center rounded-2xl bg-gradient-to-br from-logo-light-green to-[#6fa828] text-white shadow-lg shadow-logo-light-green/30 ring-2 ring-white/40">
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border-2 border-white/80 bg-white/10">
                                            <svg class="h-6 w-6 drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75h4.5m-7.5 3h10.5m-6 3h1.5m-6 4.125h10.5A2.625 2.625 0 0020.625 17.25V6.75A2.625 2.625 0 0018 4.125H6A2.625 2.625 0 003.375 6.75v10.5A2.625 2.625 0 006 19.875z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="absolute bottom-0 right-0 flex h-[5.25rem] w-[6.5rem] items-center justify-center rounded-2xl bg-gradient-to-br from-logo-blue to-brand-600 text-white shadow-lg shadow-logo-blue/25 ring-2 ring-white/40">
                                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border-2 border-white/80 bg-white/10">
                                            <svg class="h-6 w-6 drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-1.5m0 0a4.5 4.5 0 004.5-4.5c0-1.84-1.104-3.422-2.684-4.123A4.5 4.5 0 106.75 12a4.5 4.5 0 004.5 4.5zM9.75 21h4.5" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                @if ($hasCourseMaterials && $canViewLearningMaterials)
                                    <a
                                        href="{{ route('cne.modules.materials', $course->couse_name) }}"
                                        class="group relative mt-6 block overflow-hidden rounded-2xl bg-gradient-to-br from-logo-blue to-brand-600 p-5 text-center text-white shadow-lg shadow-logo-blue/30 ring-2 ring-white/40 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-logo-blue/40 hover:ring-white/55 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2 focus-visible:ring-offset-[#fdf8ee] active:translate-y-0"
                                    >
                                        <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-white/15 blur-2xl"></div>
                                        <div class="pointer-events-none absolute -bottom-8 -left-6 h-20 w-20 rounded-full bg-logo-light-green/25 blur-2xl"></div>
                                        <div class="relative flex flex-col items-center gap-3.5">
                                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-full border-2 border-white/80 bg-white/10 shadow-inner ring-1 ring-white/25 transition group-hover:bg-white/15 group-hover:ring-white/40">
                                                <svg class="h-6 w-6 drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </span>
                                            <div class="space-y-1">
                                                <p class="text-[11px] font-extrabold uppercase tracking-[0.2em] text-white/75">
                                                    Learning materials
                                                </p>
                                                <p class="text-sm font-bold uppercase tracking-wide text-white drop-shadow-sm sm:text-[15px]">
                                                    View learning materials
                                                </p>
                                            </div>
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white/95 ring-1 ring-white/25 transition group-hover:bg-white/25 group-hover:ring-white/40">
                                                Open
                                                <svg class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="min-w-0 pl-0 sm:pl-2 lg:pl-4">
                            <div class="flex flex-col gap-2 border-l-4 border-logo-light-green pl-5 sm:pl-6">
                                <h2 class="text-2xl font-bold tracking-tight text-emerald-900 font-serif sm:text-3xl">
                                    Learning Resources
                                </h2>
                                <p class="text-sm font-medium text-slate-500">Question &amp; answer format for deeper understanding</p>
                            </div>
                            @if (filled($course->qa_content))
                                <div class="mt-8 max-w-3xl text-lg leading-8 text-slate-800 text-justify">
                                    {!! nl2br(e($course->qa_content)) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Practice test --}}
        @if (filled($course->practice_content))
            <section class="border-t border-slate-200/80 bg-gradient-to-b from-white to-slate-50/80 py-16 sm:py-24">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-14 xl:gap-20">
                        <div class="order-2 min-w-0 lg:order-1">
                            <h2 class="text-2xl font-bold tracking-tight text-logo-light-green sm:text-3xl font-serif">
                                Practice Test
                            </h2>
                            <div class="mt-8 space-y-4 text-lg leading-8 text-slate-700 text-justify">
                                {!! nl2br(e($course->practice_content)) !!}
                            </div>
                            @auth
                                @if (auth()->user()?->role_type === 'user' && ($isPurchased ?? false))
                                    @php
                                        $mockDoneForPractice = (bool) ($courseTestProgress['mock_done'] ?? false);
                                    @endphp
                                    <div class="mt-8">
                                        @if ($mockDoneForPractice)
                                            <a
                                                href="{{ route('cne.modules.test', [$course->couse_name, 'practice']) }}"
                                                class="inline-flex items-center justify-center rounded-xl bg-logo-light-green px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-light-green/30 transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-light-green focus-visible:ring-offset-2"
                                            >
                                                Open practice questions
                                            </a>
                                        @else
                                            <button
                                                type="button"
                                                class="inline-flex items-center justify-center rounded-xl bg-logo-light-green px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-light-green/30 transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-light-green focus-visible:ring-offset-2"
                                                @click="practiceGateOpen = true"
                                                aria-haspopup="dialog"
                                            >
                                                Open practice questions
                                            </button>
                                        @endif
                                        <p class="mt-3 text-sm text-slate-500">Up to 30 random questions per session, with numbered navigation.</p>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <div class="order-1 w-full min-w-0 lg:order-2">
                            <div class="relative w-full">
                                <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-logo-blue/15 via-transparent to-logo-light-green/20 blur-2xl"></div>
                                <div class="relative overflow-hidden rounded-3xl border border-slate-200/70 bg-slate-100 shadow-xl shadow-slate-300/35 ring-1 ring-slate-200/50">
                                    <img
                                        src="{{ asset('images/cne-practice-test.jpg') }}"
                                        alt="Practice assessment and multiple-choice review"
                                        class="aspect-[4/3] w-full object-cover lg:aspect-auto lg:h-[min(22rem,48vh)]"
                                        width="1400"
                                        height="933"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Score Card Modal --}}
        <div
            x-show="scoreCardOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
        >
            <div class="absolute inset-0 bg-slate-900/60 transition-opacity" @click="scoreCardOpen = false"></div>
            
            <div class="relative w-full max-w-lg rounded-[2rem] border border-white/20 bg-white shadow-2xl ring-1 ring-slate-900/10">
                <div class="flex items-center justify-between border-b border-slate-100 bg-white/95 px-6 py-4 rounded-t-[2rem]">
                    <div class="flex items-center gap-2.5">
                        <div class="flex size-9 items-center justify-center rounded-xl bg-logo-blue/10 text-logo-blue">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-slate-900">Score Card</h2>
                    </div>
                    <button 
                        @click="scoreCardOpen = false"
                        class="rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                    >
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-6 sm:px-8">
                    <div class="text-center">
                        <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-logo-blue/80" x-text="scoreCardData.title"></p>
                        <div class="mt-2 inline-flex items-end gap-1">
                            <span class="text-5xl font-black tabular-nums tracking-tight text-brand-900" x-text="scoreCardData.score"></span>
                            <span class="mb-1 text-2xl font-bold text-slate-400">%</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-slate-500">{{ $course->couse_name }}</p>
                    </div>

                    <div class="mt-8 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-4 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Questions</p>
                            <p class="mt-1 text-xl font-bold text-slate-900" x-text="scoreCardData.total"></p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-4 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Duration</p>
                            <p class="mt-1 text-xl font-bold text-slate-900" x-text="scoreCardData.duration"></p>
                        </div>
                        <div class="rounded-2xl border border-emerald-100 bg-emerald-50/30 p-4 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-600/80">Correct</p>
                            <p class="mt-1 text-xl font-bold text-emerald-700" x-text="scoreCardData.correct"></p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-orange-50/30 p-4 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-orange-600/80">Wrong</p>
                            <p class="mt-1 text-xl font-bold text-orange-700" x-text="scoreCardData.wrong"></p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button
                            @click="scoreCardOpen = false"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-logo-blue py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-xl shadow-logo-blue/20 transition hover:bg-brand-600"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gate: practice questions require completed mock test --}}
        <div
            x-show="practiceGateOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[70] flex items-center justify-center p-4 sm:p-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="practice-gate-title"
        >
            <div
                class="absolute inset-0 bg-slate-900/55"
                @click="practiceGateOpen = false"
                aria-hidden="true"
            ></div>
            <div
                class="relative z-10 w-full max-w-md overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-2xl shadow-slate-900/20 ring-1 ring-slate-200/60"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                @click.stop
            >
                <div class="border-b border-amber-100 bg-gradient-to-r from-amber-50 via-white to-amber-50/80 px-6 py-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700 ring-1 ring-amber-200/80">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </span>
                            <h3 id="practice-gate-title" class="font-serif text-lg font-bold leading-snug text-slate-900">
                                Complete the mock test first
                            </h3>
                        </div>
                        <button
                            type="button"
                            class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue"
                            @click="practiceGateOpen = false"
                            aria-label="Close dialog"
                        >
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-5">
                    <p class="text-sm leading-relaxed text-slate-600">
                        To open practice questions, you need to <span class="font-semibold text-slate-800">complete the mock test</span> for this module first. After that, you can return here and proceed to practice.
                    </p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-400 focus-visible:ring-offset-2 sm:w-auto"
                            @click="practiceGateOpen = false"
                        >
                            Close
                        </button>
                        <a
                            href="{{ route('cne.modules.test', [$course->couse_name, 'mock']) }}"
                            class="inline-flex w-full items-center justify-center rounded-xl bg-logo-blue px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2 sm:w-auto"
                            @click="practiceGateOpen = false"
                        >
                            Go to mock test
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </main>
@endsection
