@extends('layouts.frontend.app')

@section('title', 'About Us')

@section('content')
    <main class="pb-12">
        <div style="height: 100px;"></div>
        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 py-14 sm:py-20">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                       
                        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            Empowering nurses through practical, skill-based learning.
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                           <strong>Ventura Learning Solutions</strong> is a forward-thinking educational company dedicated to enhancing nurses' professional capabilities through <strong>innovative short-term, skill-based programs</strong>. We deliver concise, practical, and knowledge-oriented courses that help nurses stay current, competent, and confident in their practice.
                        </p>
                        <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                            Our programs are carefully designed to address real-world clinical challenges and evolving patient care needs. By combining evidence-based content with flexible online learning, Ventura ensures that nurses can update their knowledge without disrupting their professional commitments.
                        </p>
                        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">01</p>
                                <p class="text-xs text-slate-500">Short-Term Programs</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">02</p>
                                <p class="text-xs text-slate-500">Skill-Based Training</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">03</p>
                                <p class="text-xs text-slate-500">Specialized Learning</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md shadow-slate-200/60">
                                <p class="text-2xl font-bold text-brand-900">04</p>
                                <p class="text-xs text-slate-500">Flexible Access</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="pointer-events-none absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-logo-light-green/20 via-transparent to-logo-blue/20 blur-2xl"></div>
                        <img src="{{ asset('images/nursing_team.png') }}" onerror="this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80'" alt="Nursing team" class="relative h-[500px] w-full rounded-3xl border border-slate-200/60 object-cover shadow-2xl shadow-slate-300/40">
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
                    <div class="mt-12 rounded-2xl border border-brand-900/10 bg-brand-900/[0.03] px-5 py-6 sm:px-8">
                    <p class="text-center text-lg leading-8 text-slate-700 text-justify sm:text-lg">
                        <strong class="font-semibold text-slate-900">Our Goal:</strong> To empower nurses with continuous learning opportunities that promote excellence in practice, improve healthcare outcomes, and support professional advancement.
                    </p>
                </div>
            </div>
        </section> --}}

        <section class="pt-28 pb-20 sm:pt-32 sm:pb-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">What We Offer</h2>
                    <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">Focused, practical learning solutions designed to support nurses in everyday clinical practice.</p>
                </div>

                <div class="mt-12 space-y-8">
                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Short-Term Certification Programs</h3>
                                <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                                    Our courses are designed for online delivery and focused learning in minimal time, making them ideal for busy healthcare professionals. Each program is structured to deliver relevant knowledge efficiently without interrupting professional commitments.
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
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Skill-Based Training</h3>
                                <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                                    Ventura provides practical and clinically relevant modules that strengthen the knowledge nurses need in day-to-day practice. Our training is built around real-world clinical challenges and evolving patient care needs.
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Specialized Learning Areas</h3>
                                <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                                    We cover essential domains such as nursing assessment, lifesaving skills, critical care, infection control, emergency nursing, patient safety, and more.
                                </p>
                            </div>
                            <div class="h-64 w-full overflow-hidden rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-300/30">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80" alt="Online nursing modules and career advancement" class="h-full w-full object-cover">
                            </div>
                        </div>
                    </article>

                    <article class="rounded-3xl border border-slate-200/70 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div class="h-64 w-full overflow-hidden rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-300/30 lg:order-1">
                                <img src="{{ asset('images/nursing_team.png') }}" onerror="this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80'" alt="Flexible online nursing learning" class="h-full w-full object-cover">
                            </div>
                            <div class="lg:order-2">
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900 font-serif">Flexible Learning Approach</h3>
                                <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                                    Our self-paced and accessible programs are designed to fit demanding work schedules, making learning practical for nurses balancing professional and personal responsibilities.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="pb-20 sm:pb-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="rounded-3xl border border-slate-200/70 bg-white p-8 shadow-md shadow-slate-200/60 sm:p-10">
                    <div class="mx-auto max-w-4xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">Our Commitment</h2>
                        <p class="mt-6 text-lg leading-8 text-slate-600 text-justify">
                            At Ventura Learning Solutions, we are committed to supporting nurses in their <strong>continuous learning</strong> and <strong>professional growth</strong>. Our aim is to equip healthcare professionals with the knowledge and skills required to improve patient outcomes and maintain the highest standards of care.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
