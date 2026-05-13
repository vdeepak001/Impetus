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
            <div class="mx-auto max-w-5xl overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-2xl ring-1 ring-slate-900/5">
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
                                    Result: {{ $banner }}
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
                        <div class="grid grid-cols-5 gap-1.5 md:gap-3">
                            {{-- Total Questions --}}
                            <div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:shadow-md md:p-4">
                                <p class="whitespace-nowrap text-center text-[8px] font-bold uppercase tracking-wider text-slate-400 md:text-[11px]">Questions</p>
                                <p class="mt-1 text-xl font-black text-slate-900 md:mt-2 md:text-2xl">{{ $totalQuestions }}</p>
                            </div>

                            {{-- Correct Answers --}}
                            <div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:shadow-md md:p-4">
                                <p class="whitespace-nowrap text-center text-[8px] font-bold uppercase tracking-widest text-slate-400 md:text-[11px]">Correct Answer</p>
                                <p class="mt-1 text-xl font-black text-emerald-600 md:mt-2 md:text-2xl">{{ $correctCount }}</p>
                            </div>

                            {{-- Wrong Answers --}}
                            <div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:shadow-md md:p-4">
                                <p class="whitespace-nowrap text-center text-[8px] font-bold uppercase tracking-widest text-slate-400 md:text-[11px]">Wrong Answer</p>
                                <p class="mt-1 text-xl font-black text-orange-600 md:mt-2 md:text-2xl">{{ $wrongCount }}</p>
                            </div>

                            {{-- Obtained Score --}}
                            <div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:shadow-md md:p-4">
                                <p class="whitespace-nowrap text-center text-[8px] font-bold uppercase tracking-widest text-slate-400 md:text-[11px]">Obtained Score</p>
                                <p class="mt-1 text-xl font-black text-logo-blue md:mt-2 md:text-2xl">{{ $obtainedScore }}/{{ $maxScore }}</p>
                            </div>

                            @if($testType !== 'practice')
                            {{-- Time Taken --}}
                            <div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:shadow-md md:p-4">
                                <p class="whitespace-nowrap text-center text-[8px] font-bold uppercase tracking-widest text-slate-400 md:text-[11px]">Time Taken</p>
                                <p class="mt-1 text-xl font-black text-slate-900 md:mt-2 md:text-2xl">{{ $formattedDuration }}</p>
                            </div>
                            @endif
                        </div>
                        {{-- Score Chart & Visuals --}}
                        <div class="mt-10 overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:p-8">
                            <div class="flex flex-col gap-2 border-b border-slate-100 pb-5">
                                <h2 class="font-serif text-xl font-bold text-slate-900 sm:text-2xl">
                                    Score: {{ $obtainedScore }}/{{ $maxScore }}
                                </h2>
                            </div>


                            @php
                                $correctAngle = ($pctCorrect / 2) * 3.6;
                                $wrongAngle = ($pctCorrect + ($pctWrong / 2)) * 3.6;
                                $dist = 25;
                                $tx_c = 50 + $dist * cos(deg2rad($correctAngle - 90));
                                $ty_c = 50 + $dist * sin(deg2rad($correctAngle - 90));
                                $tx_w = 50 + $dist * cos(deg2rad($wrongAngle - 90));
                                $ty_w = 50 + $dist * sin(deg2rad($wrongAngle - 90));
                            @endphp
                            <div class="mt-10 flex flex-col items-center justify-center">
                                <div class="relative size-64 shrink-0 sm:size-80">
                                    <svg class="size-full transform" viewBox="0 0 100 100">
                                        {{-- Wrong Percentage (Orange) --}}
                                        <circle
                                            cx="50" cy="50" r="25"
                                            fill="transparent"
                                            stroke="rgb(249 115 22)"
                                            stroke-width="50"
                                            stroke-dasharray="157.08"
                                            stroke-dashoffset="0"
                                            transform="rotate(-90, 50, 50)"
                                        />
                                        {{-- Correct Percentage (Green) --}}
                                        <circle
                                            cx="50" cy="50" r="25"
                                            fill="transparent"
                                            stroke="rgb(16 185 129)"
                                            stroke-width="50"
                                            stroke-dasharray="157.08"
                                            stroke-dashoffset="{{ 157.08 * (1 - $pctCorrect / 100) }}"
                                            transform="rotate(-90, 50, 50)"
                                            class="transition-all duration-1000 ease-out"
                                        />
                                        
                                        {{-- Percentages inside --}}
                                        @if($pctCorrect > 5)
                                            <text x="{{ $tx_c }}" y="{{ $ty_c }}" fill="white" font-size="8" font-weight="bold" text-anchor="middle" dominant-baseline="middle">
                                                {{ round($pctCorrect) }}%
                                            </text>
                                        @endif
                                        @if($pctWrong > 5)
                                            <text x="{{ $tx_w }}" y="{{ $ty_w }}" fill="white" font-size="8" font-weight="bold" text-anchor="middle" dominant-baseline="middle">
                                                {{ round($pctWrong) }}%
                                            </text>
                                        @endif
                                    </svg>
                                </div>
 
                                <div class="mt-8 flex flex-wrap justify-center gap-8">
                                    <div class="flex items-center gap-3">
                                        <span class="size-4 shrink-0 bg-emerald-500 shadow-sm"></span>
                                        <span class="text-base font-bold text-slate-700">Correct Answer</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="size-4 shrink-0 bg-orange-500 shadow-sm"></span>
                                        <span class="text-base font-bold text-slate-700">Wrong Answer</span>
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
                                                $qrData = "Unique ID: " . $orderId . "\nModule: " . $course->couse_name . "\nDate: " . now()->format('d M, Y');
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
                                        <p class="text-lg font-bold text-slate-800">You have not Successfully Completed the Exam</p>
                                        
                                        @if($finalAttemptCount < 2)
                                            <p class="text-sm font-semibold text-slate-500">You can make ONE more attempt</p>
                                            <div class="mt-8">
                                                <a 
                                                    href="{{ route('cne.modules.test', [$course->couse_name, 'final']) }}"
                                                    class="inline-flex items-center gap-2 rounded-xl border-2 border-rose-600 px-10 py-3 text-sm font-black uppercase tracking-widest text-rose-600 transition hover:bg-rose-600 hover:text-white"
                                                >
                                                    TRY AGAIN!
                                                </a>
                                            </div>
                                        @else
                                            <p class="text-sm font-semibold text-rose-600">Kindly Purchase the Module Again</p>
                                        @endif
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
            <div class="mb-6 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between lg:gap-6">
                <div class="min-w-0 lg:flex-1">
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

                @if($testType === 'practice' && $practiceLevel !== null)
                    <div class="flex shrink-0 flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs font-bold uppercase tracking-wider text-slate-500 sm:text-sm lg:flex-1">
                        <span class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-logo-blue"></span>
                            Level: {{ $practiceLevel == -1 ? 'Other' : $practiceLevel }}
                        </span>
                        <span class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-logo-blue"></span>
                            Set: {{ $practiceSet }}
                        </span>
                        <span class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-logo-blue"></span>
                            Attempt: {{ $currentAttemptNumber }} / 2
                        </span>
                    </div>
                @endif

                @if ($examDeadlineTs && $testType !== 'practice')
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

                <div class="shrink-0 text-right text-sm font-medium text-slate-500 lg:flex-1 sm:text-base">
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
                            @foreach ($questions as $idx => $question_row)
                                @php
                                    $qid = $question_row['id'];
                                    $answered = filled($responses[$qid] ?? null);
                                    $isPractice = $type === \App\Enums\CourseTestType::Practice;
                                    $isCurrent = $idx === $currentIndex;
                                    
                                    $result = $isPractice ? ($practiceResults[$qid] ?? null) : null;
                                    $isCorrect = ($result === 'correct');
                                    $isWrong = ($result === 'wrong_second');
                                    $isFirstWrong = ($result === 'wrong_first');

                                    $btnClasses = 'flex h-10 w-10 items-center justify-center rounded-lg border text-sm font-bold transition ';
                                    if ($isCurrent) {
                                        $btnClasses .= 'border-logo-blue bg-logo-blue text-white shadow-md shadow-logo-blue/30';
                                    } elseif ($isPractice) {
                                        if ($isCorrect) {
                                            $btnClasses .= 'border-emerald-300 bg-emerald-500 text-white';
                                        } elseif ($isWrong) {
                                            $btnClasses .= 'border-rose-300 bg-rose-500 text-white';
                                        } elseif ($isFirstWrong) {
                                            $btnClasses .= 'border-amber-300 bg-amber-100 text-amber-800';
                                        } elseif ($answered) {
                                            $btnClasses .= 'border-slate-300 bg-slate-100 text-slate-600';
                                        } else {
                                            $btnClasses .= 'border-slate-200 bg-white text-slate-700 hover:border-logo-blue/50';
                                        }
                                    } else {
                                        if ($answered) {
                                            $btnClasses .= 'border-emerald-300 bg-emerald-50 text-emerald-800';
                                        } else {
                                            $btnClasses .= 'border-slate-200 bg-white text-slate-700 hover:border-logo-blue/50';
                                        }
                                    }
                                @endphp
                                <button
                                    type="button"
                                    wire:click="gotoQuestion({{ $idx }})"
                                    class="{{ $btnClasses }}"
                                >
                                    {{ $question_row['num'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <section class="min-w-0 rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/60 sm:p-8">
                    @if ($questions === [])
                        <p class="text-slate-600">No questions to display.</p>
                    @else
                        @php
                            $q = $questions[$currentIndex] ?? null;
                        @endphp
                        @if ($q)
                            <h2 class="mt-4 text-lg font-semibold leading-relaxed !text-logo-blue sm:text-xl">
                                {{ $currentIndex + 1 }}. {{ $q['text'] }}
                            </h2>

                            <div class="mt-8 space-y-4" wire:key="q-{{ $q['id'] }}">
                                @php
                                    $choiceLabels = ['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'];
                                @endphp
                                @foreach ($choiceLabels as $letter => $label)
                                        @php
                                            $choice = $q['choices'][$letter] ?? null;
                                            $qid = $q['id'];
                                            $isPractice = $type === \App\Enums\CourseTestType::Practice;
                                            $showFeedback = $isPractice && ($practiceShowReasoning[$qid] ?? false);
                                            $correctLetter = $practiceCorrectAnswers[$qid] ?? null;
                                            $isSelected = ($responses[$qid] ?? null) === $letter;
                                            
                                            // New logic for disabling first wrong choice on 2nd attempt
                                            $isFirstWrongChoice = $isPractice && ($practiceFirstWrongAnswer[$qid] ?? null) === $letter && ($practiceResults[$qid] ?? null) === 'wrong_first';

                                            $labelClasses = 'flex gap-3 rounded-xl border p-4 transition ';
                                            if ($showFeedback) {
                                                $labelClasses .= 'cursor-default ';
                                                if ($letter === $correctLetter) {
                                                    $labelClasses .= 'border-emerald-500 bg-emerald-50 ring-1 ring-emerald-500';
                                                } elseif ($isSelected && $letter !== $correctLetter) {
                                                    $labelClasses .= 'border-rose-500 bg-rose-50 ring-1 ring-rose-500';
                                                } else {
                                                    $labelClasses .= 'border-slate-200 opacity-60';
                                                }
                                            } elseif ($isFirstWrongChoice) {
                                                $labelClasses .= 'cursor-not-allowed border-slate-200 bg-slate-50 opacity-40 grayscale';
                                            } else {
                                                $labelClasses .= 'cursor-pointer border-slate-200 hover:border-logo-blue/40 hover:bg-slate-50 has-[:checked]:border-logo-blue has-[:checked]:bg-logo-blue/5';
                                            }
                                        @endphp
                                        @if (filled($choice))
                                            <label class="{{ $labelClasses }}">
                                                <input
                                                    type="radio"
                                                    class="mt-1 h-4 w-4 border-slate-300 text-logo-blue focus:ring-logo-blue"
                                                    wire:model.live="responses.{{ $q['id'] }}"
                                                    value="{{ $letter }}"
                                                    @disabled($showFeedback || $isFirstWrongChoice)
                                                />
                                            <span class="text-sm leading-relaxed text-slate-800">
                                                <span class="font-bold text-slate-900">{{ $label }}.</span>
                                                {{ $choice }}
                                                @if ($showFeedback && $letter === $correctLetter)
                                                    <span class="ml-2 inline-flex items-center gap-1 font-bold text-emerald-600">
                                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                                        Correct Answer
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>

                            {{-- Practice Feedback and Reasoning --}}
                            @if ($type === \App\Enums\CourseTestType::Practice)
                                @php
                                    $qid = $q['id'];
                                    $result = $practiceResults[$qid] ?? null;
                                    $showReasoning = $practiceShowReasoning[$qid] ?? false;
                                    $attempts = $practiceAttempts[$qid] ?? 0;
                                @endphp

                                @if ($result === 'wrong_first')
                                    <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 shadow-sm">
                                        <div class="flex items-center gap-3 text-amber-800">
                                            <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                                            <p class="text-sm font-bold">Incorrect! Please try again. (Attempt 1/2)</p>
                                        </div>
                                    </div>
                                @elseif ($result === 'wrong_second')
                                    <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 shadow-sm">
                                        <div class="flex items-center gap-3 text-rose-800">
                                            <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                            <p class="text-sm font-bold">Incorrect! Here is the correct answer and rationale.</p>
                                        </div>
                                    </div>
                                @elseif ($result === 'correct')
                                    <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                                        <div class="flex items-center gap-3 text-emerald-800">
                                            <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <p class="text-sm font-bold">Correct!</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($showReasoning && filled($practiceReasoning[$qid] ?? null))
                                    <div class="mt-4 rounded-2xl border border-logo-blue/20 bg-logo-blue/5 p-5">
                                        <h4 class="text-xs font-bold uppercase tracking-wider text-logo-blue">Rationale</h4>
                                        <p class="mt-2 text-justify text-base leading-relaxed text-slate-700">
                                            {{ $practiceReasoning[$qid] }}
                                        </p>
                                    </div>
                                @endif
                            @endif

                            @if ($submitError)
                                <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="flex size-6 shrink-0 items-center justify-center rounded-full bg-rose-600 text-white">
                                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-bold text-rose-600">{{ $submitError }}</p>
                                    </div>
                                </div>
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
                                    @if ($type === \App\Enums\CourseTestType::Practice)
                                        @php
                                            $qid = $q['id'];
                                        @endphp
                                        @if (!($practiceShowReasoning[$qid] ?? false))
                                            <button
                                                type="button"
                                                wire:click="submitPracticeAnswer({{ $qid }})"
                                                class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-emerald-600/25 transition hover:bg-emerald-700"
                                            >
                                                Submit Answer
                                            </button>
                                        @endif
                                    @endif

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
