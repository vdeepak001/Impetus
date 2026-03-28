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
    @endphp

    <main class="pb-16" x-data="{}">
        <div class="h-[100px]" aria-hidden="true"></div>

        {{-- Hero + overview (aligned with Practice Test / site theme) --}}
        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 pb-14 sm:pb-20">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                    <div class="min-w-0 flex-1">
                        <span class="inline-flex items-center rounded-full bg-logo-light-green/15 px-4 py-1.5 text-sm font-medium text-brand-900 ring-1 ring-inset ring-logo-light-green/25">
                            CNE module
                        </span>
                        <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl font-serif">
                            {{ $title }}
                        </h1>
                        <p class="mt-4 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="text-logo-blue hover:underline">CNE Home</a>
                            <span class="mx-1.5 text-slate-300">→</span>
                            <a href="{{ route('cne.modules') }}" class="text-logo-blue hover:underline">Type of Module</a>
                            <span class="mx-1.5 text-slate-300">→</span>
                            <a href="{{ route('cne.modules') }}" class="text-logo-blue hover:underline">CNE Modules</a>
                            <span class="mx-1.5 text-slate-300">→</span>
                            <span class="text-slate-600">{{ $title }}</span>
                        </p>
                    </div>
                    @if ($buyUrl)
                        @auth
                            <a
                                href="{{ $buyUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex shrink-0 items-center justify-center rounded-xl bg-logo-blue px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                            >
                                Buy now
                            </a>
                        @else
                            @if (Route::has('login'))
                                <button
                                    type="button"
                                    @click="$dispatch('open-login-modal')"
                                    class="inline-flex shrink-0 items-center justify-center rounded-xl bg-logo-blue px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                                >
                                    Buy now
                                </button>
                            @else
                                <a
                                    href="{{ $buyUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex shrink-0 items-center justify-center rounded-xl bg-logo-blue px-8 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/25 transition hover:bg-brand-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2"
                                >
                                    Buy now
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <div class="mt-12 grid items-start gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                    <div class="order-2 min-w-0 lg:order-1">
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 font-serif sm:text-3xl">
                            What you will learn in {{ $title }}?
                        </h2>
                        @if (filled($course->description))
                            <div class="mt-6 text-lg leading-8 text-slate-600">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        @else
                            <p class="mt-6 text-lg leading-8 text-slate-500">Details for this module will be available soon.</p>
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

        {{-- Learning resources (qa_content): cream band, theme accents --}}
        @if (filled($course->qa_content))
            <section class="relative z-10 -mt-px border-t border-amber-200/50 bg-gradient-to-b from-[#fffdf8] via-[#fdf8ee] to-[#faf3e8] py-16 sm:py-24">
                <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-300/40 to-transparent"></div>
                <div class="pointer-events-none absolute left-1/4 top-20 h-40 w-40 rounded-full bg-logo-light-green/10 blur-3xl"></div>
                <div class="pointer-events-none absolute bottom-10 right-1/4 h-32 w-32 rounded-full bg-logo-blue/10 blur-2xl"></div>

                <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="flex flex-col gap-12 lg:flex-row lg:items-start lg:gap-16">
                        <div class="flex shrink-0 justify-center lg:w-52 lg:justify-start">
                            <div class="relative h-36 w-44 sm:h-40 sm:w-52">
                                <div class="absolute left-0 top-3 flex h-[5.25rem] w-[6.5rem] items-center justify-center rounded-2xl bg-gradient-to-br from-logo-light-green to-[#6fa828] text-white shadow-lg shadow-logo-light-green/30 ring-2 ring-white/40">
                                    <svg class="h-11 w-11 drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="absolute bottom-0 right-0 flex h-[5.25rem] w-[6.5rem] items-center justify-center rounded-2xl bg-gradient-to-br from-logo-blue to-brand-600 text-white shadow-lg shadow-logo-blue/25 ring-2 ring-white/40">
                                    <svg class="h-10 w-10 drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="inline-flex flex-col gap-2 border-l-4 border-logo-light-green pl-5 sm:pl-6">
                                <h2 class="text-2xl font-bold tracking-tight text-emerald-900 font-serif sm:text-3xl">
                                    Learning resources
                                </h2>
                                <p class="text-sm font-medium text-slate-500">Question &amp; answer format for deeper understanding</p>
                            </div>
                            <div class="mt-8 max-w-3xl text-base leading-relaxed text-slate-800 lg:text-lg lg:leading-8">
                                {!! nl2br(e($course->qa_content)) !!}
                            </div>
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
                                Practice test
                            </h2>
                            <p class="mt-2 text-sm font-medium text-slate-500">Levels I–III · Multiple choice</p>
                            <div class="mt-8 space-y-4 text-base leading-relaxed text-slate-700">
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
