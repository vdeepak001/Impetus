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
                            Online Test
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600">
                            An online test for Continuing Professional Development (CPD) for nurses is a structured assessment designed to evaluate and reinforce the knowledge, skills, and clinical judgement of nursing professionals as part of their ongoing learning. These tests help nurses maintain competence, meet regulatory requirements, and deliver safe, evidence-based patient care.
                        </p>
                        <p class="mt-4 text-base leading-8 text-slate-600">
                            The CPD online test typically covers a wide range of topics including clinical skills, patient safety, infection prevention, medication administration, ethical practices, and emerging healthcare trends. Questions may include multiple-choice, case-based scenarios, and application-oriented formats to assess both theoretical understanding and practical decision-making abilities.
                        </p>
                        <p class="mt-4 text-sm text-slate-500">
                            <a href="{{ route('home') }}" class="text-logo-blue hover:underline">Home</a>
                            <span class="mx-1">→</span>
                            <span>Online Test</span>
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
                        <h2 class="text-2xl font-bold tracking-tight text-logo-light-green sm:text-3xl font-serif">Flexible Online Assessment</h2>
                        <p class="mt-5 text-base leading-8 text-slate-600">
                            Accessible anytime and anywhere, the online format offers flexibility for working nurses to complete assessments at their convenience. Instant feedback, performance analysis, and detailed explanations help learners identify strengths and areas for improvement, promoting continuous learning and professional development.
                        </p>
                        <ul class="mt-8 space-y-4 text-base leading-7 text-slate-700">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Accessible anytime and anywhere for working nurses</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Multiple-choice, case-based, and application-oriented formats</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Instant feedback and performance analysis after completion</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Supports continuous learning and professional development</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>May contribute to CPD credits, certification, and career advancement</span>
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
                        <span class="text-brand-900">Level of Questions</span>
                    </h2>
                    <p class="mt-4 text-base leading-8 text-slate-600">
                        There are three levels of questions in the online test portal to evaluate the comprehensive knowledge of the participant.
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
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Level - 1</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    Level - 1 questions focus on the assessment of factual knowledge and help evaluate the participant's foundational understanding of essential nursing concepts.
                                </p>
                                <p>
                                    Each Level - 1 question carries <strong class="font-semibold text-slate-800">1 mark</strong>, supporting accurate evaluation of basic theoretical knowledge.
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
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Level - 2</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    Level - 2 questions focus on the assessment of functional knowledge, measuring how well participants can apply learned concepts in practical nursing situations.
                                </p>
                                <p>
                                    Each Level - 2 question carries <strong class="font-semibold text-slate-800">2 marks</strong>, reflecting a deeper level of understanding and application.
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
                            <h3 class="text-xl font-semibold text-slate-900 font-serif">Level - 3</h3>
                            <div class="mt-4 flex-1 space-y-4 text-base leading-7 text-slate-600">
                                <p>
                                    Level - 3 questions focus on the assessment of problem-solving ability, challenging participants to use clinical judgement and decision-making in more complex scenarios.
                                </p>
                                <p>
                                    Each Level - 3 question carries <strong class="font-semibold text-slate-800">3 marks</strong>, recognizing higher-order reasoning and advanced clinical application.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-base leading-7 text-slate-700 sm:text-lg">
                        <strong class="font-semibold text-slate-900">Scoring and Feedback:</strong> Immediate scoring and grading will be provided upon completion of the test, allowing test-takers to identify areas of strength and weakness. This feedback is valuable for further learning and improvement.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
