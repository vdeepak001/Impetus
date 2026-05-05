<div class="pb-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if ($fatalError)
            <div class="rounded-2xl border border-amber-200 bg-amber-50 px-6 py-8 text-amber-900 shadow-sm">
                <p class="text-lg font-semibold">This test cannot be loaded</p>
                <p class="mt-2 whitespace-pre-line text-sm text-amber-800/90">{{ $fatalError }}</p>
                <a
                    href="{{ $testType === 'practice' ? route('cne.modules.test', [$course->couse_name, 'practice']) : route('cne.modules.show', $course->couse_name) }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl border border-amber-300 bg-white px-5 py-2.5 text-sm font-semibold text-amber-900 shadow-sm transition hover:bg-amber-100"
                >
                    Back to {{ $testType === 'practice' ? 'practice sets' : 'module' }}
                </a>
            </div>
        @elseif ($submitted)
            @php
                $wrongCount = max(0, $totalQuestions - $correctCount);
                $pctCorrect = $scorePercent ?? 0.0;
                $pctWrong = round(100 - $pctCorrect, 1);
                $banner = $type->resultBannerLabel();
            @endphp
            <div class="mx-auto max-w-4xl overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-2xl ring-1 ring-slate-900/5">
                <div class="relative overflow-hidden">
                    {{-- Decorative backgrounds --}}
                    <div class="pointer-events-none absolute -left-20 -top-16 h-72 w-72 rounded-full bg-logo-blue/[0.07] blur-3xl" aria-hidden="true"></div>
                    <div class="pointer-events-none absolute -bottom-24 -right-16 h-80 w-80 rounded-full bg-logo-light-green/[0.12] blur-3xl" aria-hidden="true"></div>

                    {{-- Header Section --}}
                    <div class="border-b border-slate-200/80 bg-gradient-to-br from-slate-50/95 via-white to-brand-50/30 px-6 py-8 sm:px-10">
                        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                            <div class="min-w-0">
                                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-logo-blue/80">Test completed</p>
                                <h1 class="mt-2 font-serif text-xl font-bold tracking-tight text-brand-900 sm:text-[26px]">
                                    Result for {{ $banner }} Result
                                </h1>
                                <p class="mt-1.5 text-lg font-bold text-orange-600">
                                    {{ $course->couse_name }}
                                </p>
                               
                            </div>
                            <div class="hidden shrink-0 lg:block">
                                <span class="inline-flex rounded-full border border-logo-blue/25 bg-logo-blue/10 px-4 py-1.5 text-sm font-bold text-brand-800">{{ $banner }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="bg-gradient-to-b from-white via-slate-50/30 to-white px-6 py-10 sm:px-10">
                        {{-- Quick Stats Grid --}}
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5 lg:gap-4">
                            <div class="group flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Questions</p>
                                <p class="mt-1 text-2xl font-bold tabular-nums text-slate-900">{{ $totalQuestions }}</p>
                            </div>
                            <div class="group flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Correct Answer</p>
                                <p class="mt-1 text-2xl font-bold tabular-nums text-emerald-600">{{ $correctCount }}</p>
                            </div>
                            <div class="group flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Wrong Answer</p>
                                <p class="mt-1 text-2xl font-bold tabular-nums text-orange-600">{{ $wrongCount }}</p>
                            </div>
                            <div class="group flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Obtained Score</p>
                                <p class="mt-1 text-2xl font-bold tabular-nums text-logo-blue">{{ $obtainedScore }}/{{ $maxScore }}</p>
                            </div>
                            <div class="group flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Time taken</p>
                                <p class="mt-1 text-2xl font-bold tabular-nums text-slate-900">{{ $formattedDuration ?? '—' }}</p>
                            </div>
                        </div>
 
                        {{-- Score Chart & Visuals --}}
                        <div class="mt-10 overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
                            <div class="flex flex-col gap-2 border-b border-slate-100 pb-5">
                                <h2 class="font-serif text-xl font-bold text-slate-900 sm:text-2xl">
                                    Result chart (Require Pie chart)
                                </h2>
                                <p class="text-sm text-slate-500">Visual breakdown of your performance</p>
                            </div>

                            {{-- Level Breakdown --}}
                            <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
                                @foreach($levelStats as $lvl => $stats)
                                    @if($stats['total'] > 0)
                                        <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm ring-1 ring-slate-100/50">
                                            <div class="flex items-center gap-2">
                                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-logo-blue/10 text-[10px] font-bold text-logo-blue">L{{ $lvl }}</span>
                                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Level {{ $lvl }}</p>
                                            </div>
                                            <p class="mt-3 text-xs font-medium text-slate-500">
                                                <span class="font-bold text-slate-700">{{ $stats['correct'] }}/{{ $stats['total'] }}</span> answers · {{ $stats['weight'] }} marks each
                                            </p>
                                            <div class="mt-2 flex items-baseline gap-1">
                                                <span class="text-xl font-bold text-logo-blue">{{ $stats['score'] }}</span>
                                                <span class="text-xs font-bold text-slate-400">/ {{ $stats['max'] }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="mt-10 flex flex-col items-center justify-center gap-10 lg:flex-row lg:gap-16">
                                <div class="relative size-56 shrink-0 sm:size-64">
                                    {{-- Modern Pie Chart using SVG for better control --}}
                                    <svg class="size-full -rotate-90 transform" viewBox="0 0 100 100">
                                        {{-- Wrong Percentage (Orange) --}}
                                        <circle
                                            cx="50" cy="50" r="40"
                                            fill="transparent"
                                            stroke="rgb(249 115 22)"
                                            stroke-width="20"
                                            stroke-dasharray="251.32"
                                            stroke-dashoffset="0"
                                        />
                                        {{-- Correct Percentage (Green) --}}
                                        <circle
                                            cx="50" cy="50" r="40"
                                            fill="transparent"
                                            stroke="rgb(16 185 129)"
                                            stroke-width="20"
                                            stroke-dasharray="251.32"
                                            stroke-dashoffset="{{ 251.32 * (1 - $pctCorrect / 100) }}"
                                            class="transition-all duration-1000 ease-out"
                                        />
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center rounded-full">
                                        <div class="flex flex-col items-center justify-center size-32 rounded-full bg-white shadow-lg ring-1 ring-slate-100">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Score</span>
                                            <span class="font-serif text-2xl font-bold tabular-nums text-slate-900">({{ $correctCount }}/{{ $totalQuestions }})</span>
                                        </div>
                                    </div>
                                </div>
 
                                <div class="flex w-full max-w-xs flex-col gap-4">
                                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/50 p-4 transition hover:bg-slate-50">
                                        <div class="flex items-center gap-3">
                                            <span class="size-4 shrink-0 rounded-full bg-emerald-500 shadow-sm ring-2 ring-white"></span>
                                            <span class="text-base font-bold text-slate-700">Correct percentage</span>
                                        </div>
                                        <span class="text-lg font-bold tabular-nums text-emerald-600">{{ number_format($pctCorrect, 1) }}%</span>
                                    </div>
                                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/50 p-4 transition hover:bg-slate-50">
                                        <div class="flex items-center gap-3">
                                            <span class="size-4 shrink-0 rounded-full bg-orange-500 shadow-sm ring-2 ring-white"></span>
                                            <span class="text-base font-bold text-slate-700">Wrong percentage</span>
                                        </div>
                                        <span class="text-lg font-bold tabular-nums text-orange-600">{{ number_format($pctWrong, 1) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pass/Fail Outcome Section --}}
                        @if ($type === \App\Enums\CourseTestType::Final && $passThresholdPercent !== null)
                            <div class="mt-10 flex flex-col items-center justify-center text-center">
                                @if ($passed)
                                    <div class="space-y-4">
                                        <h3 class="text-2xl font-black tracking-widest text-emerald-600 sm:text-3xl">CONGRATULATIONS!</h3>
                                        <p class="text-lg font-bold text-slate-800">You have Successfully Completed the Exam</p>
                                        
                                        <div class="flex flex-col items-center gap-3 py-6" x-data="{ hoverRating: 0, currentRating: @entangle('rating').live }">
                                            <p class="text-sm font-bold text-slate-600">Feedback (Give a Star Rating)</p>
                                            <div class="flex gap-1">
                                                @foreach(range(1, 5) as $i)
                                                    <button 
                                                        type="button" 
                                                        @click="$wire.setRating({{ $i }})"
                                                        @mouseenter="hoverRating = {{ $i }}"
                                                        @mouseleave="hoverRating = 0"
                                                        class="transition-transform hover:scale-110"
                                                    >
                                                        <svg 
                                                            class="size-10 transition-colors" 
                                                            :class="(hoverRating || currentRating) >= {{ $i }} ? 'text-amber-400 fill-amber-400' : 'text-slate-300 fill-transparent'"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        >
                                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                        </svg>
                                                    </button>
                                                @endforeach
                                            </div>
                                            <template x-if="currentRating > 0">
                                                <p class="text-xs font-semibold text-emerald-600">Thank you for your feedback!</p>
                                            </template>
                                        </div>

                                        @if ($orderId)
                                            @php
                                                $userName = auth()->user()->name ?: (auth()->user()->first_name . ' ' . auth()->user()->last_name);
                                                $rnNumber = auth()->user()->rn_number ?? 'N/A';
                                                $qrData = "Name: " . $userName . "\nRN #: " . $rnNumber . "\nCourse: " . $course->couse_name;
                                                $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" . urlencode($qrData);
                                            @endphp
                                            <div class="mt-6 flex flex-col items-center gap-4">
                                                <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm ring-1 ring-slate-900/5">
                                                    <img src="{{ $qrUrl }}" alt="Verification QR Code" class="size-24">
                                                    <p class="mt-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">Scan to verify</p>
                                                </div>
                                                <a 
                                                    href="{{ route('certificates.download', $orderId) }}" 
                                                    class="inline-flex items-center gap-2 rounded-xl bg-logo-blue px-8 py-3 text-sm font-bold uppercase tracking-wider text-white shadow-lg transition hover:bg-brand-600"
                                                    target="_blank"
                                                >
                                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 7.5L12 3m0 0l4.5 4.5M12 3v13.5" /></svg>
                                                    Download Certificate
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="space-y-4">
                                        <h3 class="text-2xl font-black tracking-widest text-rose-600 sm:text-3xl">SORRY!</h3>
                                        <p class="text-lg font-bold text-slate-800">You have not Completed the Exam</p>
                                        
                                        @if($finalAttemptCount < 2)
                                            <p class="text-sm font-semibold text-slate-500">You can make ONE more attempt</p>
                                        @endif

                                        <div class="mt-8">
                                            <a 
                                                href="{{ route('cne.modules.test', [$course->couse_name, 'final']) }}"
                                                class="inline-flex items-center gap-2 rounded-xl border-2 border-rose-600 px-10 py-3 text-sm font-black uppercase tracking-widest text-rose-600 transition hover:bg-rose-600 hover:text-white"
                                            >
                                                TRY AGAIN!
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="mt-10 flex flex-col items-center gap-4 border-t border-slate-100 pt-8">
                            <a
                                href="{{ $testType === 'practice' ? route('cne.modules.test', [$course->couse_name, 'practice']) : route('cne.modules.show', $course->couse_name) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-logo-blue to-brand-600 px-10 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-xl shadow-logo-blue/30 transition hover:from-brand-600 hover:to-brand-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                            >
                                Back to {{ $testType === 'practice' ? 'practice sets' : 'module' }}
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Questions View --}}
            <div class="mb-6 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between lg:gap-6">
                <div class="min-w-0 flex-1">
                    <a
                        href="{{ $testType === 'practice' ? route('cne.modules.test', [$course->couse_name, 'practice']) : route('cne.modules.show', $course->couse_name) }}"
                        class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-logo-blue hover:text-brand-600"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                        {{ $testType === 'practice' ? 'Practice Sets' : 'Module' }}
                    </a>
                    <h1 class="mt-2 font-serif text-xl font-bold tracking-tight text-brand-900 sm:text-[26px]">
                        {{ $type->label() }}
                    </h1>
                    <p class="mt-2 text-2xl font-bold leading-tight text-orange-500 sm:text-3xl lg:text-4xl">
                        {{ $course->couse_name }}
                    </p>
                </div>

                @if ($examDeadlineTs)
                    @php
                        $timerLow = ! $examTimeExpired && $examSecondsRemaining > 0 && $examSecondsRemaining <= 300;
                    @endphp
                    <div
                        wire:poll.1s="refreshExamTimer"
                        role="timer"
                        aria-label="Exam time remaining"
                        @class([
                            'relative shrink-0 overflow-hidden rounded-3xl border px-5 py-4 shadow-lg sm:min-w-[13.5rem] lg:mx-4',
                            'border-rose-200/90 bg-gradient-to-br from-rose-50 via-white to-rose-50/60 shadow-rose-200/40' => $examTimeExpired,
                            'border-amber-200/90 bg-gradient-to-br from-amber-50/90 via-white to-orange-50/50 shadow-amber-200/30' => $timerLow && ! $examTimeExpired,
                            'border-slate-200/90 bg-gradient-to-br from-white via-slate-50/40 to-brand-50/35 shadow-brand-900/[0.06]' => ! $examTimeExpired && ! $timerLow,
                        ])
                    >
                        <div
                            @class([
                                'absolute inset-x-0 top-0 h-1 rounded-t-3xl',
                                'bg-gradient-to-r from-rose-500 via-rose-400 to-amber-400' => $examTimeExpired,
                                'bg-gradient-to-r from-amber-500 via-orange-400 to-amber-400' => $timerLow && ! $examTimeExpired,
                                'bg-gradient-to-r from-logo-blue via-sky-400 to-brand-500' => ! $examTimeExpired && ! $timerLow,
                            ])
                            aria-hidden="true"
                        ></div>
                        <div class="relative mt-1 flex items-center gap-4">
                            <div
                                @class([
                                    'flex size-12 shrink-0 items-center justify-center rounded-2xl text-white shadow-lg',
                                    'bg-gradient-to-br from-rose-500 to-rose-700 shadow-rose-500/35' => $examTimeExpired,
                                    'bg-gradient-to-br from-amber-500 to-orange-600 shadow-amber-500/35' => $timerLow && ! $examTimeExpired,
                                    'bg-gradient-to-br from-logo-blue to-brand-700 shadow-logo-blue/35' => ! $examTimeExpired && ! $timerLow,
                                ])
                            >
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1 text-left">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-500">Time remaining</p>
                                <p class="mt-0.5 text-[11px] leading-tight text-slate-400">45-minute exam window</p>
                                <p
                                    @class([
                                        'mt-2 font-mono text-[1.65rem] font-bold leading-none tabular-nums tracking-tight sm:text-3xl',
                                        'text-rose-700 drop-shadow-[0_1px_0_rgba(255,255,255,0.6)]' => $examTimeExpired,
                                        'text-amber-900 drop-shadow-sm' => $timerLow && ! $examTimeExpired,
                                        'text-brand-900 drop-shadow-sm' => ! $examTimeExpired && ! $timerLow,
                                    ])
                                >{{ $examTimerDisplay }}</p>
                                @if ($examTimeExpired)
                                    <p class="mt-1 text-[11px] font-semibold text-rose-600/90">Window ended</p>
                                @elseif ($timerLow)
                                    <p class="mt-1 text-[11px] font-semibold text-amber-700/90">Less than 5 minutes left</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="shrink-0 text-right text-sm font-medium text-slate-500 sm:text-base">
                    Question {{ $currentIndex + 1 }} / {{ $totalQuestions }}
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-[minmax(0,14rem)_minmax(0,1fr)]">
                <aside class="lg:block">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-200/60">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Questions</p>
                        <p class="mt-1 text-xs text-slate-500">
                            @if ($type === \App\Enums\CourseTestType::Practice)
                                Full set of questions ordered by level. Click a number to jump.
                            @else
                                Use the grid to navigate. Your answers are saved in this session until you submit.
                            @endif
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($questions as $idx => $q)
                                @php
                                    $qid = $q['id'];
                                    $answered = filled($responses[$qid] ?? null);
                                @endphp
                                <button
                                    type="button"
                                    wire:click="gotoQuestion({{ $idx }})"
                                    class="flex h-10 w-10 items-center justify-center rounded-lg border text-sm font-bold transition
                                        {{ $idx === $currentIndex ? 'border-logo-blue bg-logo-blue text-white shadow-md shadow-logo-blue/30' : ($answered ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-slate-200 bg-white text-slate-700 hover:border-logo-blue/50') }}"
                                >
                                    {{ $q['num'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <section class="min-w-0 rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/60 sm:p-8">
                    @if ($questions === [])
                        <p class="text-slate-600">No questions to display.</p>
                    @else
                        @php($q = $questions[$currentIndex] ?? null)
                        @if ($q)
                            <h2 class="mt-4 text-lg font-semibold leading-relaxed !text-logo-blue sm:text-xl">
                                {{ $currentIndex + 1 }}. {{ $q['text'] }}
                            </h2>

                            <div class="mt-8 space-y-4" wire:key="q-{{ $q['id'] }}">
                                @foreach (['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $letter => $label)
                                    @php($choice = $q['choices'][$letter] ?? null)
                                    @if (filled($choice))
                                        <label class="flex cursor-pointer gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-logo-blue/40 hover:bg-slate-50 has-[:checked]:border-logo-blue has-[:checked]:bg-logo-blue/5">
                                            <input
                                                type="radio"
                                                class="mt-1 h-4 w-4 border-slate-300 text-logo-blue focus:ring-logo-blue"
                                                wire:model.live="responses.{{ $q['id'] }}"
                                                value="{{ $letter }}"
                                            />
                                            <span class="text-sm leading-relaxed text-slate-800">
                                                <span class="font-bold text-slate-900">{{ $label }}.</span>
                                                {{ $choice }}
                                            </span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>

                            @if ($errors->has('submit'))
                                <p class="mt-4 text-sm text-rose-600">{{ $errors->first('submit') }}</p>
                            @endif

                            <div class="mt-10 flex flex-wrap items-center justify-between gap-3">
                                <button
                                    type="button"
                                    wire:click="prevQuestion"
                                    @disabled($currentIndex === 0)
                                    class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-800 shadow-sm transition enabled:hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                                >
                                    Previous
                                </button>
                                <div class="flex flex-wrap gap-3">
                                    @if ($currentIndex < $totalQuestions - 1)
                                        <button
                                            type="button"
                                            wire:click="nextQuestion"
                                            class="rounded-xl bg-logo-blue px-6 py-2.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600"
                                        >
                                            Next
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            wire:click="submitTest"
                                            wire:loading.attr="disabled"
                                            class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-emerald-600/25 transition hover:bg-emerald-700 disabled:opacity-60"
                                        >
                                            <span wire:loading.remove wire:target="submitTest">Submit test</span>
                                            <span wire:loading wire:target="submitTest">Submitting…</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </section>
            </div>
        @endif
    </div>
</div>
