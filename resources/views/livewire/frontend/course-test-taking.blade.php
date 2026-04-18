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
        @elseif ($submitted)
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/60">
                <h1 class="font-serif text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $type->label() }} — results
                </h1>
                <p class="mt-2 text-sm text-slate-500">{{ $course->couse_name }}</p>

                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-xl border border-slate-200 bg-slate-50/80 p-6">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Score</p>
                        <p class="mt-2 text-3xl font-bold tabular-nums text-slate-900">{{ number_format((float) $scorePercent, 2) }}%</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $correctCount }} of {{ $totalQuestions }} correct</p>
                    </div>
                    @if ($type === \App\Enums\CourseTestType::Final && $passThresholdPercent !== null)
                        <div class="rounded-xl border p-6 {{ $passed ? 'border-emerald-200 bg-emerald-50' : 'border-rose-200 bg-rose-50' }}">
                            <p class="text-xs font-bold uppercase tracking-wider {{ $passed ? 'text-emerald-700' : 'text-rose-700' }}">
                                Result vs pass mark ({{ number_format((float) $passThresholdPercent, 2) }}%)
                            </p>
                            <p class="mt-3 text-lg font-bold {{ $passed ? 'text-emerald-800' : 'text-rose-800' }}">
                                {{ $passed ? 'Passed' : 'Not passed' }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="mt-10 flex flex-wrap gap-3">
                    <a
                        href="{{ route('cne.modules.show', $course->couse_name) }}"
                        class="inline-flex items-center justify-center rounded-xl bg-logo-blue px-6 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600"
                    >
                        Back to module
                    </a>
                    @if ($errors->has('submit'))
                        <p class="w-full text-sm text-rose-600">{{ $errors->first('submit') }}</p>
                    @endif
                </div>
            </div>
        @else
            <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <a
                        href="{{ route('cne.modules.show', $course->couse_name) }}"
                        class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-logo-blue hover:text-brand-600"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                        Module
                    </a>
                    <h1 class="mt-2 font-serif text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                        {{ $type->label() }}
                    </h1>
                    <p class="text-sm text-slate-600">{{ $course->couse_name }}</p>
                </div>
                <div class="text-right text-sm text-slate-500">
                    Question {{ $currentIndex + 1 }} / {{ $totalQuestions }}
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-[minmax(0,14rem)_minmax(0,1fr)]">
                <aside class="lg:block">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-200/60">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Questions</p>
                        <p class="mt-1 text-xs text-slate-500">
                            @if ($type === \App\Enums\CourseTestType::Practice)
                                Grouped by level (max 30 questions). Click a number to jump.
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
        @endif
    </div>
</div>
