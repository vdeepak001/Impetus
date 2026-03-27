@extends('layouts.frontend.app')

@section('title', 'About Us')

@section('content')
    <main class="pb-12">
        <div style="height: 100px;"></div>
        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-3 py-1 text-sm font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                            About Ventura Learning Solutions
                        </span>
                        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl font-serif">
                            Advancing nursing excellence through practical learning.
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600">
                            Ventura Learning Solutions helps nursing professionals improve clinical skills, stay up-to-date with standards, and earn certifications with confidence. Our platform combines structured learning with practical assessment tools.
                        </p>
                        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">10+</p>
                                <p class="text-xs text-slate-500">Years Impact</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">120+</p>
                                <p class="text-xs text-slate-500">Modules</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">98%</p>
                                <p class="text-xs text-slate-500">Satisfaction</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">24/7</p>
                                <p class="text-xs text-slate-500">Access</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img src="{{ asset('images/nursing_team.png') }}" onerror="this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80'" alt="Nursing team" class="h-[500px] w-full rounded-3xl border border-slate-200/60 object-cover shadow-2xl shadow-slate-300/40">
                    </div>
                </div>
            </div>
        </section>

        {{-- <section class="mt-12 bg-white/50 py-20 sm:mt-16 sm:py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl font-serif">What makes us different</h2>
                </div>
                <div class="mx-auto mt-12 grid max-w-5xl gap-6 md:grid-cols-3">
                    <article class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60">
                        <h3 class="text-lg font-semibold text-slate-900">Career-Focused Training</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Courses are aligned with real nursing workflows and exam patterns to support better outcomes.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60">
                        <h3 class="text-lg font-semibold text-slate-900">Trusted Certification Path</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">From CPD tracking to downloadable certificates, we simplify your compliance journey end-to-end.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60">
                        <h3 class="text-lg font-semibold text-slate-900">Continuous Support</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Our learning platform gives you on-demand resources, practice tests, and progress tracking anytime.</p>
                    </article>
                </div>
            </div>
        </section> --}}

        <section class="pt-28 pb-20 sm:pt-32 sm:pb-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl font-serif">Why Continuing Nursing Education Matters</h2>
                    <p class="mt-4 text-slate-600">Learn continuously, stay licensed, and build confidence through practical upskilling.</p>
                </div>

                <div class="mt-12 space-y-8">
                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Strengthen Clinical Skills</h3>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    Continuing Nursing Education is a systematic professional learning experience that improves nursing knowledge, skills, and attitudes for higher quality patient care. It helps nurses stay current with new concepts, healthcare developments, and practical standards of performance.
                                </p>
                            </div>
                            <div class="h-64 w-full overflow-hidden rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-300/30">
                                <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=1200&q=80" alt="Nursing education and clinical growth" class="h-full w-full object-cover">
                            </div>
                        </div>
                    </article>

                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div class="h-64 w-full overflow-hidden rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-300/30 lg:order-1">
                                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80" alt="License renewal and continuing education" class="h-full w-full object-cover">
                            </div>
                            <div class="lg:order-2">
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Meet Mandatory Requirements</h3>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    Nurses must earn continuing education credit points and hours for license renewal under established guidelines. Online CNE provides an affordable and flexible way to acquire and integrate new knowledge while balancing work schedules and limited resources.
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Advance with Impetus Healthcare Skills</h3>
                                <p class="mt-4 text-base leading-8 text-slate-600">
                                    Impetus Healthcare Skills (IHS) supports nursing professionals with trend-focused online modules. Learners can assess and reassess their knowledge, identify skill gaps, and achieve desired outcomes while working toward approved CNE credit points.
                                </p>
                            </div>
                            <div class="h-64 w-full overflow-hidden rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-300/30">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80" alt="Online nursing modules and career advancement" class="h-full w-full object-cover">
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
@endsection
