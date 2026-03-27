@extends('layouts.frontend.app')

@section('title', 'CNE Modules')

@section('content')
    <main class="pb-12">
        <div style="height: 100px;"></div>

        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl font-serif">Type of Module</h1>
                    <p class="text-sm text-slate-500">
                        <a href="{{ route('home') }}" class="text-logo-blue hover:underline">CNE Home</a>
                        <span class="mx-1">→</span>
                        <span>Type of Module</span>
                    </p>
                </div>

                <div class="grid gap-8 lg:grid-cols-2">
                    <article class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="h-56 w-full overflow-hidden rounded-2xl border border-slate-200/60">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=1200&q=80" alt="Knowledge based nursing module" class="h-full w-full object-cover">
                        </div>
                        <h2 class="mt-5 text-center text-xl font-bold tracking-wide text-logo-blue">KNOWLEDGE BASED MODULE (KBM)</h2>
                        <p class="mt-6 text-lg leading-8 text-slate-700">
                            Knowledge based modules are designed for nurses to enhance theoretical and skill-based knowledge in basic and advanced nursing care. It is an independent platform for all levels of nurses to enhance professional knowledge and improve clinical nursing practice. This learning mode helps nurses keep up to date with new healthcare concepts and developments while increasing their level of cognition.
                        </p>
                    </article>

                    <article class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60 sm:p-8">
                        <div class="h-56 w-full overflow-hidden rounded-2xl border border-slate-200/60">
                            <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=1200&q=80" alt="Skill based nursing module" class="h-full w-full object-cover">
                        </div>
                        <h2 class="mt-5 text-center text-xl font-bold tracking-wide text-logo-blue">SKILL BASED MODULE (SBM)</h2>
                        <p class="mt-6 text-lg leading-8 text-slate-700">
                            Skill based learning modules are designed for healthcare professionals, especially nurses, to develop and enhance basic and advanced nursing competencies through skill-based training. This training type enables participants to practice in different clinical scenarios and is customized according to individual needs for skilling, reskilling, and upskilling.
                        </p>
                    </article>
                </div>
            </div>
        </section>
    </main>
@endsection
