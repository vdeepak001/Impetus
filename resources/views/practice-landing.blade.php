@extends('layouts.frontend.app')

@section('title', 'Practice Tests')

@section('content')
    <style>
        .dot-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#cbd5e1 0.75px, transparent 0.75px);
            background-size: 12px 12px;
        }

        .ribbon-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
            height: 120px;
            overflow: hidden;
            z-index: 10;
        }

        .ribbon-text {
            position: absolute;
            display: block;
            width: 180px;
            padding: 6px 0;
            background-color: #10b981;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            color: #fff;
            font-weight: 800;
            font-size: 11px;
            line-height: 1;
            text-shadow: 0 1px 1px rgba(0,0,0,0.2);
            text-transform: uppercase;
            text-align: center;
            left: -45px;
            top: 30px;
            transform: rotate(-45deg);
        }

        .ribbon-wrapper.not-purchased .ribbon-text {
            background-color: #64748b;
        }
    </style>

    <main class="pb-24">
        <div class="h-[100px]" aria-hidden="true"></div>

        <section class="relative overflow-hidden bg-white py-16 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-x-12 gap-y-16 lg:grid-cols-2 lg:items-center">
                    <div class="order-2 lg:order-1">
                        <h1 class="text-base font-semibold leading-7 text-logo-blue uppercase tracking-wider">Practice & Excellence</h1>
                        <h2 class="mt-2 text-4xl font-serif font-extrabold tracking-tight text-brand-900 sm:text-5xl">
                            Why Practice Matters
                        </h2>
                        <p class="mt-6 text-lg leading-relaxed text-slate-600">
                            Select a module below to access its practice questions. Each module contains multiple sets of 20 questions each, designed to help you prepare for your Mock and Final examinations.
                        </p>
                        
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-slate-600 lg:max-w-none">
                            <div class="relative pl-9">
                                <dt class="inline font-bold text-brand-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                    Self-Assessment.
                                </dt>
                                <dd class="inline text-sm">Identify your strengths and areas that need more focus before the final evaluation.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-bold text-brand-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                    Exam Readiness.
                                </dt>
                                <dd class="inline text-sm">Get accustomed to the question format and time constraints of the professional exams.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-bold text-brand-900">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                    Unlimited Attempts.
                                </dt>
                                <dd class="inline text-sm">Practice as many times as you need to achieve mastery over the subject matter.</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="relative order-1 lg:order-2">
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl transition-transform hover:scale-[1.02] duration-500 ring-1 ring-slate-200">
                            <img src="{{ asset('images/nursing-practice.png') }}" alt="Student practicing" class="w-full h-auto object-cover aspect-[4/3]">
                            <div class="absolute inset-0 bg-gradient-to-tr from-logo-blue/20 to-transparent pointer-events-none"></div>
                        </div>
                        {{-- Decorative elements --}}
                        <div class="absolute -bottom-10 -right-10 h-40 w-40 rounded-full bg-logo-light-green/10 blur-3xl"></div>
                        <div class="absolute -top-10 -left-10 h-40 w-40 rounded-full bg-logo-blue/10 blur-3xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 sm:py-16 bg-slate-50/50">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="max-w-2xl">
                    <h2 class="font-serif text-3xl font-extrabold tracking-tight text-brand-900 sm:text-4xl">
                        Available Modules
                    </h2>
                    <p class="mt-4 text-base text-slate-500">
                        Browse through our curriculum and start your practice session today.
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Level 1 -->
                    <div class="group relative overflow-hidden rounded-[2.5rem] border border-emerald-100 bg-white p-10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                        <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-emerald-50 transition-transform group-hover:scale-150 duration-500"></div>
                        <div class="relative">
                            <span class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-1.5 text-[11px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-emerald-600/20">Level 1</span>
                            <h3 class="mt-6 font-serif text-3xl font-black text-brand-900 leading-tight">Foundation & Core Basics</h3>
                            <p class="mt-4 text-base text-slate-500 leading-relaxed">Focuses on fundamental nursing principles, basic medical terminology, and essential patient care techniques.</p>
                            
                            <ul class="mt-8 space-y-4">
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Fundamental Nursing Skills
                                </li>
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Basic Anatomy & Physiology
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Level 2 -->
                    <div class="group relative overflow-hidden rounded-[2.5rem] border border-sky-100 bg-white p-10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                        <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-sky-50 transition-transform group-hover:scale-150 duration-500"></div>
                        <div class="relative">
                            <span class="inline-flex items-center rounded-xl bg-sky-500 px-4 py-1.5 text-[11px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-sky-500/20">Level 2</span>
                            <h3 class="mt-6 font-serif text-3xl font-black text-brand-900 leading-tight">Intermediate Clinical Skills</h3>
                            <p class="mt-4 text-base text-slate-500 leading-relaxed">Covers more complex procedures, pharmacology, and specialized patient monitoring techniques.</p>
                            
                            <ul class="mt-8 space-y-4">
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-sky-100 text-sky-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Advanced Pharmacology
                                </li>
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-sky-100 text-sky-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Surgical & Acute Care
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Level 3 -->
                    <div class="group relative overflow-hidden rounded-[2.5rem] border border-rose-100 bg-white p-10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                        <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-rose-50 transition-transform group-hover:scale-150 duration-500"></div>
                        <div class="relative">
                            <span class="inline-flex items-center rounded-xl bg-rose-500 px-4 py-1.5 text-[11px] font-black uppercase tracking-[0.2em] text-white shadow-lg shadow-rose-500/20">Level 3</span>
                            <h3 class="mt-6 font-serif text-3xl font-black text-brand-900 leading-tight">Expert Mastery & Ethics</h3>
                            <p class="mt-4 text-base text-slate-500 leading-relaxed">Advanced diagnostics, critical care management, and professional nursing ethics and leadership.</p>
                            
                            <ul class="mt-8 space-y-4">
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Critical Care Management
                                </li>
                                <li class="flex items-center gap-3 text-sm text-slate-600">
                                    <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    Ethics & Nursing Leadership
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
