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

    <main class="pb-16" x-data="{}">
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
                        @auth
                            @if (auth()->user()?->role_type === 'user')
                                @if ($isPurchased)
                                    <div class="flex flex-wrap items-center justify-end gap-2">
                                        <a
                                            href="{{ route('online.examination', ['course' => $course->couse_name, 'test' => 'pre']) }}"
                                            class="inline-flex items-center rounded-md border border-emerald-500/40 bg-white px-4 py-2 text-sm font-semibold uppercase tracking-wide text-emerald-700 transition hover:border-emerald-600 hover:bg-emerald-600 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2"
                                        >
                                            Pre
                                        </a>
                                        <a
                                            href="{{ route('online.examination', ['course' => $course->couse_name, 'test' => 'mock']) }}"
                                            class="inline-flex items-center rounded-md border border-amber-500/40 bg-white px-4 py-2 text-sm font-semibold uppercase tracking-wide text-amber-700 transition hover:border-amber-500 hover:bg-amber-500 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2"
                                        >
                                            Mock
                                        </a>
                                        <a
                                            href="{{ route('online.examination', ['course' => $course->couse_name, 'test' => 'final']) }}"
                                            class="inline-flex items-center rounded-md border border-rose-500/40 bg-white px-4 py-2 text-sm font-semibold uppercase tracking-wide text-rose-700 transition hover:border-rose-600 hover:bg-rose-600 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-600 focus-visible:ring-offset-2"
                                        >
                                            Final
                                        </a>
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
                        @endauth
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
                            <div class="w-52">
                                <div class="relative h-36 w-44 sm:h-40 sm:w-52">
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
                                    <div class="mt-6 rounded-2xl border border-slate-200/90 bg-white px-3 py-3 shadow-lg shadow-slate-300/30 ring-1 ring-slate-100">
                                        <h3 class="text-[13px] font-extrabold uppercase tracking-wide text-slate-900">
                                            Learning Materials
                                        </h3>
                                        <a
                                            href="{{ route('cne.modules.materials', $course->couse_name) }}"
                                            class="mt-3 inline-flex w-full items-center justify-center rounded-lg bg-logo-blue px-3 py-2 text-xs font-bold uppercase tracking-wide text-white transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                                        >
                                            View Learning Materials
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="min-w-0 pl-0 sm:pl-2 lg:pl-4">
                            <div class="flex flex-col gap-2 border-l-4 border-logo-light-green pl-5 sm:pl-6">
                                <h2 class="text-2xl font-bold tracking-tight text-emerald-900 font-serif sm:text-3xl">
                                    Learning resources
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
    </main>
@endsection
