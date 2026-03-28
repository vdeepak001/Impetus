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
                            Practice Test
                        </span>
                        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl font-serif">
                            Practice Test
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600">
                            Practice tests are an established strategy for improving nurses’ learning ability and theoretical knowledge. The platform helps optimize skill-based knowledge and problem-solving through clinical scenarios, incorporating the latest trends and technological advancements.
                        </p>
                        <p class="mt-4 text-lg leading-8 text-slate-600">
                            The practice test helps you familiarize yourself with the look, feel, and navigation of the final online exam. It also gives you an opportunity to revise different sets of questions within your specialty.
                        </p>
                        <p class="mt-4 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="text-logo-blue hover:underline">Home</a>
                            <span class="mx-1">→</span>
                            <span>Practice Test</span>
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
                        <h2 class="text-2xl font-bold tracking-tight text-logo-light-green sm:text-3xl font-serif">Benefits</h2>
                        <ul class="mt-8 space-y-4 text-base leading-7 text-slate-700">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Helps identify the strengths and weaknesses of the learner.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Repetitive practice reinforces learning and aids the learner in mastering the topic.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Provides immediate feedback to the learners.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Helps to improve the performance of learners in the final examination.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Learner centered, easily accessible and user friendly.</span>
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
                            <span class="text-brand-900">Impetus Healthcare Skills (IHS)</span> — MCQ levels
                        </h2>
                        <p class="mt-6 text-base leading-8 text-slate-600">
                            <strong class="font-semibold text-slate-800">Impetus Healthcare Skills (IHS)</strong> offers tests in the form of Multiple Choice Questions (MCQs) categorized into three levels:
                        </p>
                        <ul class="mt-6 space-y-3 text-base leading-7 text-slate-700">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong class="font-semibold text-slate-800">Level I:</strong> Questions related to factual knowledge.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong class="font-semibold text-slate-800">Level II:</strong> Questions related to functional knowledge.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span><strong class="font-semibold text-slate-800">Level III:</strong> Questions related to problem-solving approaches.</span>
                            </li>
                        </ul>
                        <p class="mt-6 text-base leading-8 text-slate-600">
                            Each level of MCQs has about <strong class="font-semibold text-slate-800">eight sets</strong> of questions. Each set contains <strong class="font-semibold text-slate-800">twenty questions</strong>. All MCQs have <strong class="font-semibold text-slate-800">four options</strong> to answer. <strong class="font-semibold text-slate-800">Rationale</strong> is provided immediately after choosing an answer for each question. Results are displayed at the end of the test. You can practice each level <strong class="font-semibold text-slate-800">three times</strong> to familiarize yourself with the module.
                        </p>
                        <p class="mt-5 text-base leading-8 text-slate-600">
                            There are approximately <strong class="font-semibold text-slate-800">6,000 MCQs</strong> in the practice test section. We recommend practicing before taking the Mock and Final Examination to obtain better results.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Question bank</p>
                            <p class="mt-2 text-2xl font-bold text-logo-blue">~6,000</p>
                            <p class="text-sm text-slate-600">MCQs in practice</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Levels</p>
                            <p class="mt-2 text-2xl font-bold text-logo-blue">3</p>
                            <p class="text-sm text-slate-600">I, II &amp; III</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Per set</p>
                            <p class="mt-2 text-2xl font-bold text-logo-blue">20</p>
                            <p class="text-sm text-slate-600">questions</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-brand-900">Sets per level</p>
                            <p class="mt-2 text-2xl font-bold text-logo-blue">~8</p>
                            <p class="text-sm text-slate-600">question sets</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm sm:col-span-2">
                            <p class="text-sm font-semibold text-brand-900">Practice attempts</p>
                            <p class="mt-2 text-slate-700">Each level can be practiced up to three times.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-base leading-7 text-slate-700 sm:text-lg">
                        Log in to access practice tests in your learning module. We recommend completing them before your <strong class="font-semibold text-slate-900">Mock</strong> and <strong class="font-semibold text-slate-900">Final</strong> examinations.
                    </p>

                </div>
            </div>
        </section>
    </main>
@endsection
