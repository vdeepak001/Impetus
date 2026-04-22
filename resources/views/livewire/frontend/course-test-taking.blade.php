<div class="pb-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if ($fatalError)
            <div class="rounded-2xl border border-amber-200 bg-amber-50 px-6 py-8 text-amber-900 shadow-sm">
                <p class="text-lg font-semibold">This test cannot be loaded</p>
                <p class="mt-2 whitespace-pre-line text-sm text-amber-800/90">{{ $fatalError }}</p>
                <a
                    href="{{ route('cne.modules.show', $course->couse_name) }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl border border-amber-300 bg-white px-5 py-2.5 text-sm font-semibold text-amber-900 shadow-sm transition hover:bg-amber-100"
                >
                    Back to module
                </a>
            </div>
        @else
            @php
                $wrongCount = max(0, $totalQuestions - $correctCount);
                $pctCorrect = $totalQuestions > 0 ? round(100 * (float)$correctCount / $totalQuestions, 1) : 0.0;
                $pctWrong = round(100 - $pctCorrect, 1);
                $banner = $type->resultBannerLabel();
            @endphp
            {{-- Questions View --}}
            <div @if ($submitted) class="pointer-events-none select-none" aria-hidden="true" @endif>
            <div class="mb-6 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between lg:gap-6">
                <div class="min-w-0 flex-1">
                    <a
                        href="{{ route('cne.modules.show', $course->couse_name) }}"
                        class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-logo-blue hover:text-brand-600"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                        Module
                    </a>
                    <h1 class="mt-2 font-serif text-2xl font-bold tracking-tight text-brand-900 sm:text-3xl">
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
                            @if (! empty($q['level']))
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-slate-600">
                                    {{ $q['level'] }}
                                </span>
                            @endif
                            <h2 class="mt-4 text-lg font-semibold leading-relaxed text-slate-900 sm:text-xl">
                                {{ $q['text'] }}
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

            {{-- Score Card Modal --}}
            @if ($submitted)
                <div 
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                    role="dialog"
                    aria-modal="true"
                    x-data
                    x-init="document.body.style.overflow = 'hidden'"
                >
                    <div class="absolute inset-0 bg-black/10 transition-opacity" aria-hidden="true"></div>
                    
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
                            <a 
                                href="{{ route('cne.modules.show', $course->couse_name) }}"
                                class="rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                            >
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>

                        <div class="px-6 py-6 sm:px-8">
                            <div class="text-center">
                                <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-logo-blue/80">{{ $banner }}</p>
                                <div class="mt-2 inline-flex items-end gap-1">
                                    <span class="text-5xl font-black tabular-nums tracking-tight text-brand-900">{{ number_format((float) $scorePercent, 1) }}</span>
                                    <span class="mb-1 text-2xl font-bold text-slate-400">%</span>
                                </div>
                                <p class="mt-2 text-sm font-semibold text-slate-500">{{ $course->couse_name }}</p>
                            </div>

                            <div class="mt-8 grid grid-cols-2 gap-3">
                                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-4 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Questions</p>
                                    <p class="mt-1 text-xl font-bold text-slate-900">{{ $totalQuestions }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-slate-50/50 p-4 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Duration</p>
                                    <p class="mt-1 text-xl font-bold text-slate-900">{{ $formattedDuration ?? '—' }}</p>
                                </div>
                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/30 p-4 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-600/80">Correct</p>
                                    <p class="mt-1 text-xl font-bold text-emerald-700">{{ $correctCount }}</p>
                                </div>
                                <div class="rounded-2xl border border-orange-100 bg-orange-50/30 p-4 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-orange-600/80">Wrong</p>
                                    <p class="mt-1 text-xl font-bold text-orange-700">{{ $wrongCount }}</p>
                                </div>
                            </div>

                            @if ($type === \App\Enums\CourseTestType::Final && $passThresholdPercent !== null)
                                <div class="mt-6 overflow-hidden rounded-2xl border p-4 {{ $passed ? 'border-emerald-200 bg-emerald-50/50' : 'border-rose-200 bg-rose-50/50' }}">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] font-bold uppercase tracking-wider {{ $passed ? 'text-emerald-700' : 'text-rose-700' }}">Result</p>
                                            <p class="text-sm font-bold {{ $passed ? 'text-emerald-900' : 'text-rose-900' }}">
                                                {{ $passed ? 'Passed successfully' : 'Not passed' }}
                                            </p>
                                        </div>
                                        <div class="flex size-10 items-center justify-center rounded-xl {{ $passed ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                                            @if ($passed)
                                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                            @else
                                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-8">
                                <a
                                    href="{{ route('cne.modules.show', $course->couse_name) }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-logo-blue py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-xl shadow-logo-blue/20 transition hover:bg-brand-600"
                                >
                                    Back to module
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
