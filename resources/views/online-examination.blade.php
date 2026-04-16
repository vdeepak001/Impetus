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

                        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            Online Test
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                            An online test for Continuing Professional Development (CPD) for nurses is a structured assessment designed to evaluate and reinforce the knowledge, skills, and clinical judgement of nursing professionals as part of their ongoing learning. These tests help nurses maintain competence, meet regulatory requirements, and deliver safe, evidence-based patient care.
                        </p>
                        <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                            The CPD online test typically covers a wide range of topics including clinical skills, patient safety, infection prevention, medication administration, ethical practices, and emerging healthcare trends. Questions may include multiple-choice, case-based scenarios, and application-oriented formats to assess both theoretical understanding and practical decision-making abilities.
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
                        <p class="mt-5 text-lg leading-8 text-slate-600 text-justify">
                            Accessible anytime and anywhere, the online format offers flexibility for working nurses to complete assessments at their convenience. Instant feedback, performance analysis, and detailed explanations help learners identify strengths and areas for improvement, promoting continuous learning and professional development.
                        </p>
                        <ul class="mt-8 space-y-4 text-lg leading-8 text-slate-700 text-justify">
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
                    <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                        There are three levels of questions in the online test portal to evaluate the comprehensive knowledge of the participant.
                    </p>
                </div>

                <div class="mt-12 grid gap-6 lg:grid-cols-3 lg:items-stretch">
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all hover:shadow-md border-t-4 border-t-logo-light-green">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-100">
                            <img
                                src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=900&q=80"
                                alt="Study materials and preparation for a nursing examination"
                                class="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-6 flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-logo-light-green text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </span>
                                <span class="rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold text-white backdrop-blur-md">Factual  Knowledge</span>
                            </div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-slate-900 font-serif">Level - 1</h3>

                            </div>
                            <div class="mt-4 flex-1 space-y-4 text-lg leading-7 text-slate-600 text-justify">
                                <p>
                                    Level - 1 questions focus on the assessment of factual knowledge and help evaluate the participant's foundational understanding of essential nursing concepts.
                                </p>
                                <p>
                                    Supports accurate evaluation of basic theoretical knowledge required for clinical practice.
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all hover:shadow-md border-t-4 border-t-logo-blue">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-100">
                            <img
                                src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80"
                                alt="Laptop showing an online multiple-choice examination"
                                class="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-6 flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-logo-blue text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75c1.192 0 2.305.348 3.243.95m5.257-5.207a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm0 0v-3.675A55.378 55.378 0 0 0 12 8.443m7.007 11.55A5.981 5.981 0 0 1 17.25 15.75c-1.192 0-2.305.348-3.243.95M11.25 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </span>
                                <span class="rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold text-white backdrop-blur-md">Functional Knowledge</span>
                            </div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-slate-900 font-serif">Level - 2</h3>

                            </div>
                            <div class="mt-4 flex-1 space-y-4 text-lg leading-7 text-slate-600 text-justify">
                                <p>
                                    Level - 2 questions focus on the assessment of functional knowledge, measuring how well participants can apply learned concepts in practical nursing situations.
                                </p>
                                <p>
                                    Focuses on the clinical application of skills in real-world healthcare scenarios.
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="flex h-full min-h-0 flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all hover:shadow-md border-t-4 border-t-[#7a5af8]">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-slate-100">
                            <img
                                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80"
                                alt="Graduates celebrating achievement and certification"
                                class="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
                                width="900"
                                height="600"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-6 flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#7a5af8] text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-.978 0-.29-.097-.578-.285-.808a1.774 1.774 0 0 0-1.402-.741 1.774 1.774 0 0 0-1.402.741c-.188.23-.285.518-.285.808 0 .344.128.688.349.978.215.283.401.604.401.959v3.413m-2.106 3.12a3 3 0 1 0 4.212 0c-.016.016-.032.032-.048.048a1.5 1.5 0 0 1-2.116 0 1.5 1.5 0 0 1 0-2.116c.016-.016.032-.032.048-.048a3 3 0 0 0-2.096 5.116Zm-6.148-3.12a3 3 0 1 0 4.212 0c-.016.016-.032.032-.048.048a1.5 1.5 0 0 1-2.116 0 1.5 1.5 0 0 1 0-2.116c.016-.016.032-.032.048-.048a3 3 0 0 0-2.096 5.116Zm12.148-6.24v3.413m-12.148 0V6.087c0-.355-.186-.676-.401-.959a1.5 1.5 0 0 0-2.036 0c-.215.283-.401.604-.401.959v3.413m2.106 3.12a3 3 0 1 0-4.212 0c.016.016.032.032.048.048a1.5 1.5 0 0 0 2.116 0 1.5 1.5 0 0 0 0-2.116c-.016-.016-.032-.032-.048-.048a3 3 0 0 1 2.096 5.116Z" />
                                    </svg>
                                </span>
                                <span class="rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold text-white backdrop-blur-md">Problem Solving Knowledge</span>
                            </div>
                        </div>
                        <div class="flex min-h-0 flex-1 flex-col p-6 sm:p-8">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-slate-900 font-serif">Level - 3</h3>

                            </div>
                            <div class="mt-4 flex-1 space-y-4 text-lg leading-7 text-slate-600 text-justify">
                                <p>
                                    Level - 3 questions focus on the assessment of problem-solving ability, challenging participants to use clinical judgement and decision-making in more complex scenarios.
                                </p>
                                <p>
                                    Recognizing higher-order reasoning and advanced clinical application for professional development.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-lg leading-8 text-slate-700 text-justify sm:text-lg">
                        <strong class="font-semibold text-slate-900">Scoring and Feedback:</strong> Immediate scoring and grading will be provided upon completion of the test, allowing test-takers to identify areas of strength and weakness. This feedback is valuable for further learning and improvement.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
