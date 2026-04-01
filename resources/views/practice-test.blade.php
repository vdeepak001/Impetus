@extends('layouts.frontend.app')

@section('title', 'Practice Test')

@section('content')
    <main class="pb-12">
        <div class="h-[100px]" aria-hidden="true"></div>

        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 py-14 sm:py-20">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-start gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                    <div class="min-w-0">
                        <span class="inline-flex items-center rounded-full bg-logo-light-green/15 px-4 py-1.5 text-sm font-medium text-brand-900 ring-1 ring-inset ring-logo-light-green/25">
                            Practice Tests
                        </span>
                        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-4xl font-serif">
                            Practice Tests
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 justify">
                            The <strong>Practice Tests for CPD in Nursing</strong> are designed to reinforce learning, assess knowledge, and enhance clinical decision-making skills. These tests provide nurses the opportunity to evaluate their understanding of key concepts and prepare effectively for certification and professional practice.
                        </p>
                        <p class="mt-4 text-lg leading-8 text-slate-600">
                            Aligned with current clinical guidelines and course objectives, the practice tests cover a wide range of topics relevant to contemporary nursing care. They are structured to simulate real-life scenarios, encouraging critical thinking and the application of knowledge in practical situations.
                        </p>
                        <p class="mt-4 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="text-logo-blue hover:underline">Home</a>
                            <span class="mx-1">→</span>
                            <span>Practice Tests</span>
                        </p>
                    </div>
                    <div class="relative w-full min-w-0">
                        <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/25 via-transparent to-logo-blue/20 blur-2xl"></div>
                        <div class="relative overflow-hidden rounded-3xl shadow-lg shadow-slate-200/70">
                            <img
                                src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1200&q=80"
                                alt="Nurse preparing for online practice examination and MCQ review"
                                class="h-[280px] w-full object-cover sm:h-[340px] lg:h-[min(420px,52vh)]"
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

        <section class="py-14 sm:py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">
                    <div class="relative order-2 w-full min-w-0 lg:order-1">
                        <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-logo-blue/15 via-transparent to-logo-light-green/20 blur-2xl"></div>
                        <div class="relative w-full overflow-hidden rounded-3xl shadow-lg shadow-slate-200/70">
                            <img
                                src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&q=80"
                                alt="Clinical learning and nursing skills assessment"
                                class="aspect-[4/3] w-full object-cover lg:aspect-auto lg:h-[22rem]"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="order-1 min-w-0 lg:order-2">
                        <h2 class="text-2xl font-bold tracking-tight text-logo-light-green sm:text-3xl font-serif">Key Features</h2>
                        <ul class="mt-8 space-y-4 text-base leading-7 text-slate-700">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong>Comprehensive question bank</strong> covering clinical skills, patient safety, infection control, medication management, and more.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong>Case-based questions</strong> using realistic clinical scenarios to assess problem-solving and decision-making abilities.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong>Instant feedback</strong> with immediate explanations and rationales to correct misunderstandings.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong>Self-assessment tools</strong> that help identify strengths and areas for further improvement.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong>Flexible online access</strong> and exam-oriented preparation for CPD certification assessments and competency evaluations.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-t border-slate-200/80 bg-white py-14 sm:py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-2 lg:gap-12 lg:items-start">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            <span class="text-brand-900">Benefits</span>
                        </h2>
                        <p class="mt-6 text-base leading-8 text-slate-600">
                            Practice tests strengthen knowledge retention and recall while helping nurses build confidence for assessments and real-world practice.
                        </p>
                        <ul class="mt-6 space-y-3 text-base leading-7 text-slate-700">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Strengthens knowledge retention and recall</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Builds confidence for assessments and real-world practice</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Enhances critical thinking and clinical judgement</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Supports continuous improvement and lifelong learning</span>
                            </li>
                        </ul>
                        <p class="mt-6 text-base leading-8 text-slate-600">
                            The purpose of these practice tests is to ensure that nurses gain theoretical knowledge and develop the ability to apply it effectively in clinical settings. Regular self-assessment enables nurses to maintain high standards of care and achieve professional excellence.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Question Bank</p>
                            <p class="mt-2 text-slate-700">Comprehensive topic coverage across essential nursing areas</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Clinical Scenarios</p>
                            <p class="mt-2 text-slate-700">Case-based practice for decision-making and application of knowledge</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Instant Feedback</p>
                            <p class="mt-2 text-slate-700">Immediate explanations and rationales for better learning</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Flexible Access</p>
                            <p class="mt-2 text-slate-700">Practice anytime online at your own convenience</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm sm:col-span-2">
                            <p class="text-sm font-semibold text-brand-900">Purpose</p>
                            <p class="mt-2 text-slate-700">Regular self-assessment helps nurses maintain high standards of care and achieve professional excellence.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-base leading-7 text-slate-700 sm:text-lg">
                        <strong class="font-semibold text-slate-900">Purpose:</strong> These practice tests are designed to ensure that nurses gain theoretical knowledge and develop the ability to apply it effectively in clinical settings.
                    </p>

                </div>
            </div>
        </section>
    </main>
@endsection
