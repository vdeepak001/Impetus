@extends('layouts.frontend.app')

@section('title', 'Online Examination')

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
                            Online Examination
                        </span>
                        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl font-serif">
                            Online Examination
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600">
                            The Online Examination System (OES) is a fully automated, multiple-choice question (MCQ) platform designed for nursing assessments. Unlike traditional paper-based tests, it delivers a more effective, reliable, and standardized experience with strong integration across your learning path.
                        </p>
                        <p class="mt-4 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="text-logo-blue hover:underline">Home</a>
                            <span class="mx-1">→</span>
                            <span>Online Examination</span>
                        </p>
                    </div>
                    <div class="relative w-full min-w-0">
                        <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/25 via-transparent to-logo-blue/20 blur-2xl"></div>
                        <div class="relative overflow-hidden rounded-3xl shadow-lg shadow-slate-200/70">
                            <img
                                src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80"
                                alt="Nurse completing an online multiple-choice examination"
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
                                alt="Clinical nursing assessment and continuing education"
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
                                <span>Easy accessibility.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Accuracy, increased efficiency, and time-saving.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>24/7 availability for user convenience.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Instant result generation.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Cost-effectiveness and user-friendliness.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-t border-slate-200/80 bg-white py-14 sm:py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                        <span class="text-brand-900">Impetus Healthcare Skills (IHS)</span> exam types
                    </h2>
                    <p class="mt-4 text-base leading-8 text-slate-600">
                        The IHS online examination pathway has three stages: Pre-Test, Mock Exam, and Final Exam. Each plays a distinct role in measuring progress and meeting certification requirements.
                    </p>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3 lg:items-stretch">
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-50/80 shadow-sm">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-200/90">
                            <img
                                src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=900&q=80"
                                alt="Study materials and preparation for a nursing examination"
                                class="h-full w-full object-cover"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/35 via-transparent to-transparent"></div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Pre-Test</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    A preliminary test is used to determine a user's baseline knowledge in a specific online nursing module. A pretest is administered with <strong class="font-semibold text-slate-800">30 questions</strong> relating to the module, which comprises questions from all three levels of multiple choice questions.
                                </p>
                                <p>
                                    This helps the user to do self-assessment and aids the user to prepare adequately for final examination. It is <strong class="font-semibold text-slate-800">mandatory</strong> to take the pretest for initiating the module.
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-50/80 shadow-sm">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-200/90">
                            <img
                                src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80"
                                alt="Laptop showing an online multiple-choice examination"
                                class="h-full w-full object-cover"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/35 via-transparent to-transparent"></div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Mock Exam</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    Mock examination emulates the real online examination experience. It introduces you to the final exam format and highlights knowledge gaps to address before the final online examination.
                                </p>
                                <p>
                                    The examination consists of <strong class="font-semibold text-slate-800">30 questions</strong> which are randomly chosen from all the levels of MCQ and the duration of completing the exam is <strong class="font-semibold text-slate-800">forty-five minutes</strong>.
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-50/80 shadow-sm">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-200/90">
                            <img
                                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80"
                                alt="Graduates celebrating achievement and certification"
                                class="h-full w-full object-cover"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/35 via-transparent to-transparent"></div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Final Exam</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    Final examination is taken at the end of study to earn the score needed for credit points or hours toward nursing license renewal. Questions are chosen randomly and proportionately from all levels; the same question is <strong class="font-semibold text-slate-800">never repeated</strong> for the same user. Once started, the exam <strong class="font-semibold text-slate-800">cannot be saved or paused</strong> mid-way.
                                </p>
                                <p>
                                    Results appear immediately after the exam. If you meet the score required by your state nursing council, a <strong class="font-semibold text-slate-800">digital certificate</strong> can be downloaded instantly.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-base leading-7 text-slate-700 sm:text-lg">
                        Log in to your module to access Pre-Test, Mock, and Final examinations as part of your CPD pathway.
                    </p>
                    @if (Route::has('login'))
                        <div class="mt-6 flex justify-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center rounded-full bg-logo-light-green px-6 py-3 text-sm font-semibold text-white shadow-[0_10px_30px_rgba(131,186,45,0.35)] transition-all hover:-translate-y-0.5 hover:shadow-[0_15px_40px_rgba(131,186,45,0.5)]">
                                    Go to dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center rounded-full bg-logo-light-green px-6 py-3 text-sm font-semibold text-white shadow-[0_10px_30px_rgba(131,186,45,0.35)] transition-all hover:-translate-y-0.5 hover:shadow-[0_15px_40px_rgba(131,186,45,0.5)]">
                                    Log in to continue
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
