@extends('layouts.frontend.app')

@section('title', 'CPD Certifications')

@section('content')
    <main class="pb-12">
        <div class="h-[100px]" aria-hidden="true"></div>

        {{-- Hero --}}
        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 py-14 sm:py-20">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                    
                    <div class="max-w-2xl text-left">
                       
                        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            CPD Certification
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                            The Continuous Professional Development (CPD) Certification for Nurses is designed to support lifelong learning and ensure that nursing professionals remain competent, confident, and up to date with evolving healthcare practices. This certification provides structured learning opportunities to enhance clinical knowledge, strengthen critical thinking, and promote evidence-based practice.
                        </p>
                        <p class="mt-5 text-lg leading-8 text-slate-600 text-justify">
                            In today's rapidly changing healthcare environment, nurses must continuously update their skills to provide safe, effective, and patient-centered care. The CPD certification program offers a range of focused modules covering essential areas such as clinical skills, patient safety, infection control, medication management, and emerging healthcare trends.
                        </p>
                    </div>
                    <div class="relative mx-auto w-full max-w-lg lg:mx-0 lg:max-w-none">
                        <div class="pointer-events-none absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/20 via-transparent to-logo-blue/20 blur-2xl"></div>
                        <div class="relative">
                            <img
                                src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80"
                                alt="Nursing professional engaged in online continuing education and clinical learning"
                                class="h-[320px] w-full rounded-3xl object-cover shadow-2xl shadow-slate-300/40 sm:h-[400px] lg:h-[min(480px,52vh)]"
                                width="1200"
                                height="800"
                                loading="eager"
                                decoding="async"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Feature cards --}}
        <section class="relative py-16 sm:py-24">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-slate-50 to-transparent"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">Key Features</h2>
                    <p class="mt-4 mx-auto max-w-2xl text-lg leading-8 text-slate-600 text-justify sm:text-center">A structured and practical certification experience built for working nurses.</p>
                </div>

                <div class="grid gap-8 lg:grid-cols-3">
                    <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-8 shadow-lg shadow-slate-200/50 transition duration-300 hover:-translate-y-1 hover:border-logo-blue/30 hover:shadow-2xl hover:shadow-logo-blue/10">
                        <div class="absolute right-0 top-0 h-32 w-32 rounded-full bg-blue-50 blur-3xl transition duration-300 group-hover:bg-blue-100"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-logo-blue ring-1 ring-blue-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="relative mt-8 text-2xl font-bold text-slate-900 font-serif">Structured Learning Pathways</h3>
                        <p class="relative mt-4 text-lg leading-8 text-slate-600 text-justify">
                            Well-organized online modules aligned with current clinical standards and professional guidelines.
                        </p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-8 shadow-lg shadow-slate-200/50 transition duration-300 hover:-translate-y-1 hover:border-logo-light-green/40 hover:shadow-2xl hover:shadow-logo-light-green/15 text-justify">
                        <div class="absolute right-0 top-0 h-32 w-32 rounded-full bg-emerald-50 blur-3xl transition duration-300 group-hover:bg-emerald-100"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="relative mt-8 text-2xl font-bold text-slate-900 font-serif">Flexible and Accessible</h3>
                        <p class="relative mt-4 text-lg leading-8 text-slate-600">
                            Online, self-paced learning designed to fit the busy schedules of working nurses worldwide.
                        </p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-8 shadow-lg shadow-slate-200/50 transition duration-300 hover:-translate-y-1 hover:border-amber-400/40 hover:shadow-2xl hover:shadow-amber-500/15">
                        <div class="absolute right-0 top-0 h-32 w-32 rounded-full bg-amber-50 blur-3xl transition duration-300 group-hover:bg-amber-100"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-amber-700 ring-1 ring-amber-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="relative mt-8 text-2xl font-bold text-slate-900 font-serif">Practice-Oriented Content</h3>
                        <p class="relative mt-4 text-lg leading-8 text-slate-600 text-justify">
                            Real-life case scenarios and practical insights to enhance day-to-day clinical performance and patient care.
                        </p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-8 shadow-lg shadow-slate-200/50 transition duration-300 hover:-translate-y-1 hover:border-indigo-400/40 hover:shadow-2xl hover:shadow-indigo-500/15">
                        <div class="absolute right-0 top-0 h-32 w-32 rounded-full bg-indigo-50 blur-3xl transition duration-300 group-hover:bg-indigo-100"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9m-9 6h9m-9 6h9M4.5 6h.008v.008H4.5V6zm0 6h.008v.008H4.5V12zm0 6h.008v.008H4.5V18z" />
                            </svg>
                        </div>
                        <h3 class="relative mt-8 text-2xl font-bold text-slate-900 font-serif">Competency Enhancement</h3>
                        <p class="relative mt-4 text-lg leading-8 text-slate-600 text-justify">
                            Strengthens decision-making, critical thinking, and clinical judgement for better outcomes.
                        </p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200/80 bg-white p-8 shadow-lg shadow-slate-200/50 transition duration-300 hover:-translate-y-1 hover:border-rose-400/40 hover:shadow-2xl hover:shadow-rose-500/15">
                        <div class="absolute right-0 top-0 h-32 w-32 rounded-full bg-rose-50 blur-3xl transition duration-300 group-hover:bg-rose-100"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 ring-1 ring-rose-100">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="relative mt-8 text-2xl font-bold text-slate-900 font-serif">Recognized Certification</h3>
                        <p class="relative mt-4 text-lg leading-8 text-slate-600 text-justify">
                            Demonstrates commitment to professional development and supports long-term career advancement.
                        </p>
                    </article>

                    <article class="group relative overflow-hidden rounded-[2rem] border-2 border-dashed border-slate-200 bg-slate-50/50 p-8 transition-colors hover:border-logo-light-green/30 hover:bg-white">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-logo-light-green shadow-sm ring-1 ring-slate-200/60">
                             <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <h3 class="mt-8 text-xl font-bold text-slate-900 font-serif">And More...</h3>
                        <p class="mt-4 text-lg leading-7 text-slate-600">Continuous content updates and new specialization pathways being added.</p>
                    </article>
                </div>

                <div class="mt-16 rounded-[2.5rem] border border-slate-200/80 bg-white p-8 shadow-2xl shadow-slate-200/60 sm:p-12">
                    <div class="lg:grid lg:grid-cols-2 lg:items-center lg:gap-16">
                        <div>
                            <h3 class="text-3xl font-bold tracking-tight text-slate-900 font-serif">Program Benefits</h3>
                            <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                                Our CPD certification is designed to provide immediate value through clinically relevant, traceable, and professional learning indicator outcomes.
                            </p>
                            <div class="mt-8 grid gap-4 text-slate-700">
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 flex-none text-logo-light-green mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span class="text-justify text-lg">Improves the quality and safety of patient care across all domains.</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 flex-none text-logo-light-green mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span class="text-justify text-lg">Keeps nurses updated with the latest evidence-based practice guidelines.</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 flex-none text-logo-light-green mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span class="text-justify text-lg">Supports regulatory requirements for license renewal and auditing.</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 flex-none text-logo-light-green mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span class="text-justify text-lg">Enhances confidence and professional credibility in clinical settings.</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 flex-none text-logo-light-green mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span class="text-justify text-lg">Opens pathways for nurse specialization and healthcare leadership roles.</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 lg:mt-0">
                            <div class="relative">
                                <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/20 via-transparent to-logo-blue/20 blur-2xl"></div>
                                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80" alt="Program Benefits" class="relative aspect-video w-full rounded-3xl object-cover shadow-xl ring-1 ring-slate-200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            </div>
        </section>

        {{-- Process flow --}}
        <section class="border-t border-slate-200/80 bg-white py-14 sm:py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">Our Goal</h2>
                    <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">To empower nurses with continuous learning opportunities that promote excellence in practice, improve healthcare outcomes, and support professional advancement in a dynamic healthcare landscape.</p>
                    <div class="mx-auto mt-4 h-1 w-24 rounded-full bg-gradient-to-r from-logo-light-green to-logo-blue"></div>
                </div>

                {{-- Mobile / tablet: vertical timeline --}}
                <div class="relative mx-auto mt-12 max-w-lg lg:hidden">
                    <div class="absolute start-6 top-3 bottom-3 w-0.5 bg-gradient-to-b from-logo-light-green via-logo-blue to-amber-400" aria-hidden="true"></div>
                    @php
                        $mobileSteps = [
                            ['label' => 'Register', 'tone' => 'from-orange-500 to-amber-500'],
                            ['label' => 'Choose a module', 'tone' => 'from-slate-500 to-slate-600'],
                            ['label' => 'Take pre-test', 'tone' => 'from-amber-400 to-yellow-500'],
                            ['label' => 'Use learning resources', 'tone' => 'from-blue-500 to-logo-blue'],
                            ['label' => 'Practice MCQs', 'tone' => 'from-emerald-500 to-teal-600'],
                            ['label' => 'Take mock exam', 'tone' => 'from-orange-500 to-orange-600'],
                            ['label' => 'Complete final exam', 'tone' => 'from-slate-500 to-slate-700'],
                            ['label' => 'Download CPD certificate', 'tone' => 'from-amber-400 to-amber-500'],
                        ];
                    @endphp
                    <ol class="relative list-none space-y-0 p-0">
                        @foreach ($mobileSteps as $index => $step)
                            <li class="relative flex gap-4 pb-10 last:pb-0">
                                <div class="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br {{ $step['tone'] }} text-sm font-bold text-white shadow-lg ring-4 ring-white">
                                    {{ $index + 1 }}
                                </div>
                                <div class="min-w-0 flex-1 pt-1">
                                    <p class="text-base font-semibold text-slate-900">{{ $step['label'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                {{-- Desktop: snake flow --}}
                <div class="mt-14 hidden lg:block">
                    @php
                        $arrowRight = '<svg class="h-8 w-8 shrink-0 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>';
                        $arrowLeft = '<svg class="h-8 w-8 shrink-0 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>';
                        $arrowDown = '<svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" /></svg>';
                    @endphp

                    <div class="mx-auto max-w-5xl">
                        {{-- Row 1: LTR --}}
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-400 to-orange-500 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-orange-500/25">Register</div>
                            {!! $arrowRight !!}
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-500 to-slate-600 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-slate-500/20">Choose a module</div>
                            {!! $arrowRight !!}
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-amber-500/25">Take pre-test</div>
                        </div>

                        <div class="flex justify-end pe-[calc(8%-1rem)] xl:pe-[calc(12.5%-2rem)]">
                            <div class="py-2">{!! $arrowDown !!}</div>
                        </div>

                        {{-- Row 2: LTR boxes; flow continues 6 → 5 → 4 (arrows point left) --}}
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-logo-blue px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-blue-500/25">Use learning resources</div>
                            {!! $arrowLeft !!}
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-emerald-500/25">Practice MCQs</div>
                            {!! $arrowLeft !!}
                            <div class="flex min-h-[88px] min-w-[160px] max-w-[200px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-orange-600/25">Take mock exam</div>
                        </div>

                        <div class="flex justify-start ps-[calc(8%-1rem)] xl:ps-[calc(12.5%-2rem)]">
                            <div class="py-2">{!! $arrowDown !!}</div>
                        </div>

                        {{-- Row 3: LTR --}}
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <div class="flex min-h-[88px] min-w-[180px] max-w-[240px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-600 to-slate-700 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-slate-600/25">Complete final exam</div>
                            {!! $arrowRight !!}
                            <div class="flex min-h-[88px] min-w-[180px] max-w-[280px] flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 px-4 py-4 text-center text-sm font-semibold text-white shadow-lg shadow-amber-500/30">Download CPD certificate</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
