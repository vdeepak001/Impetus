@extends('layouts.frontend.app')

@section('title', 'Learning Materials')

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
                            CPD Learning Materials
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                            The Continuous Professional Development (CPD) learning materials in Nursing are delivered through well-structured PowerPoint presentations and comprehensive PDF resources, designed to provide clear, concise, and practical knowledge for nursing professionals.
                        </p>
                        <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                            These materials are designed to support effective learning by combining visual clarity with detailed explanations, enabling nurses to understand, retain, and apply knowledge in clinical practice.
                        </p>
                        
                    </div>
                    <div class="relative w-full min-w-0">
                        <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/25 via-transparent to-logo-blue/20 blur-2xl"></div>
                        <div class="relative overflow-hidden rounded-3xl shadow-lg shadow-slate-200/70">
                            <img
                                src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80"
                                alt="Nurse reviewing online learning resources and study materials"
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
                                src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80"
                                alt="Healthcare team collaboration and nursing education"
                                class="aspect-[4/3] w-full object-cover lg:aspect-auto lg:h-[22rem]"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="order-1 min-w-0 lg:order-2">
                        <h2 class="text-2xl font-bold tracking-tight text-logo-light-green sm:text-3xl font-serif">PowerPoint Slide Materials</h2>
                        <p class="mt-5 text-lg leading-8 text-slate-600 text-justify">
                            Our PowerPoint presentations simplify complex concepts with visually engaging structured content. Each slide highlights key learning points, making it ideal for quick understanding and revision.
                        </p>
                        <ul class="mt-8 space-y-4 text-lg leading-8 text-slate-700 text-justify">
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Clear and concise bullet-points</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Use of diagrams, flowcharts, and clinical illustrations</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Step-by-step explanations of procedures and protocols</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Case-based scenarios for practical understanding</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-logo-light-green" aria-hidden="true"></span>
                                <span>Ideal for online sessions, and self-learning</span>
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
                            <span class="text-brand-900">PDF Learning Resources</span>
                        </h2>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                            The PDF materials offer comprehensive explanations to supplement the slide presentations. These resources serve as reliable references for ongoing study and practice.
                        </p>
                        <p class="mt-5 text-lg leading-8 text-slate-600 text-justify">
                            These learning materials are designed to enhance knowledge retention, clinical competence, and evidence-based practice. They help nurses meet CPD requirements and enable continuous learning in a flexible, accessible format.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-lg font-semibold text-brand-900">Structured Coverage</p>
                            <p class="mt-2 text-lg text-slate-700 text-justify">Comprehensive topic coverage with structured content</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm">
                            <p class="text-lg font-semibold text-brand-900">Evidence-Based</p>
                            <p class="mt-2 text-lg text-slate-700 text-justify">Evidence-based guidelines and clinical protocols</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm sm:col-span-2">
                            <p class="text-lg font-semibold text-brand-900">Detailed Explanations</p>
                            <p class="mt-2 text-lg text-slate-700 text-justify">Detailed explanations of nursing procedures and concepts</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200/80 bg-slate-50/80 p-5 shadow-sm sm:col-span-2">
                            <p class="text-lg font-semibold text-brand-900">Quick Reference</p>
                            <p class="mt-2 text-lg text-slate-700 text-justify">Tables, charts, and summary points for quick reference, suitable for offline access and long-term learning</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-lg leading-8 text-slate-700 text-justify sm:text-lg">
                        <strong class="font-semibold text-slate-900">Purpose:</strong> These learning materials are designed to enhance knowledge retention, clinical competence, and evidence-based practice. They support CPD requirements while enabling continuous learning in a flexible and accessible format.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
