@extends('layouts.frontend.app')

@section('title', 'CPD Modules')

@section('content')
    <main class="pb-16">
        <div class="h-[100px]" aria-hidden="true"></div>

        <section class="py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                </div>

                <div class="mb-10 rounded-3xl border border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 p-6 shadow-md shadow-slate-200/50 sm:p-8">
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">Continuing Professional Development Modules</h2>
                    <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                        Continuing Professional Development (CPD) modules for nurses are structured, topic-focused learning units designed to enhance clinical knowledge, professional skills, and evidence-based practice. These modules support lifelong learning and help nurses stay current with evolving healthcare standards, technologies, and patient care practices.
                    </p>
                    <p class="mt-4 text-lg leading-8 text-slate-600 text-justify">
                        Each CPD module is carefully developed to address key areas of nursing practice such as clinical skills, patient assessment, infection control, medication administration, emergency care, ethical decision-making, and specialized fields like critical care, maternal health, and mental health nursing.
                    </p>
                </div>

                @php
                    $purchasedCourses = $courses->filter(fn($c) => isset($purchasedCourseIds) && $purchasedCourseIds->contains($c->id));
                    $otherCourses = $courses->reject(fn($c) => isset($purchasedCourseIds) && $purchasedCourseIds->contains($c->id));
                @endphp

                @if ($courses->isEmpty())
                    <div class="rounded-3xl border border-slate-200/80 bg-white px-8 py-14 text-center shadow-lg shadow-slate-200/50 ring-1 ring-slate-100">
                        <p class="text-lg leading-8 text-slate-600 text-justify">No modules are available yet. Please check back later.</p>
                    </div>
                @else
                    {{-- Purchased Modules Section --}}
                    @if($purchasedCourses->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="font-serif text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Purchased Modules</h3>
                            <div class="mt-2 h-1 w-20 rounded-full bg-emerald-500"></div>
                        </div>
                        <div class="mb-16 grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($purchasedCourses as $course)
                                @php
                                    $title = $course->couse_name;
                                    $detailUrl = route('cne.modules.show', $course->couse_name);
                                    $creditPoints = 'N/A';
                                    if(isset($course->stateCouncils) && $course->stateCouncils->count() > 0) {
                                        $rawPoints = $course->stateCouncils->first()->pivot->points;
                                        $creditPoints = is_array($rawPoints) ? array_sum($rawPoints) : $rawPoints;
                                        $creditPoints = !empty($creditPoints) ? $creditPoints : 'N/A';
                                    }
                                @endphp
                                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-md shadow-slate-200/50 ring-1 ring-slate-100 transition hover:-translate-y-0.5 hover:border-logo-light-green/30 hover:shadow-xl hover:shadow-slate-300/40 hover:ring-logo-light-green/20">
                                    <a href="{{ $detailUrl }}" class="relative flex flex-1 flex-col focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2">
                                        <div class="relative aspect-[4/3] w-full shrink-0 overflow-hidden bg-slate-100">
                                            <img
                                                src="{{ asset('images/course.jpeg') }}"
                                                alt=""
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                            <div class="absolute inset-0 flex items-center justify-center p-4">
                                                <span class="block max-w-full text-balance text-center text-base font-bold uppercase leading-snug tracking-tight text-logo-blue sm:text-3xl">
                                                    {{ $title ?? '—' }}
                                                </span>
                                            </div>
                                            @auth
                                                @if (auth()->user()?->role_type === 'user')
                                                    <div class="absolute bottom-4 right-4 z-10 flex items-center rounded-sm bg-green-500 px-2.5 py-1 text-xs font-bold tracking-wide text-white shadow-sm">
                                                        Credit Point: {{ $creditPoints }}
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    {{-- Other Modules Section --}}
                    @if($otherCourses->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="font-serif text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                                {{ $purchasedCourses->isNotEmpty() ? 'Other Modules' : 'Available Modules' }}
                            </h3>
                            <div class="mt-2 h-1 w-20 rounded-full bg-logo-blue"></div>
                        </div>
                        <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($otherCourses as $course)
                                @php
                                    $title = $course->couse_name;
                                    $detailUrl = route('cne.modules.show', $course->couse_name);
                                    $creditPoints = 'N/A';
                                    if(isset($course->stateCouncils) && $course->stateCouncils->count() > 0) {
                                        $rawPoints = $course->stateCouncils->first()->pivot->points;
                                        $creditPoints = is_array($rawPoints) ? array_sum($rawPoints) : $rawPoints;
                                        $creditPoints = !empty($creditPoints) ? $creditPoints : 'N/A';
                                    }
                                @endphp
                                <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-md shadow-slate-200/50 ring-1 ring-slate-100 transition hover:-translate-y-0.5 hover:border-logo-light-green/30 hover:shadow-xl hover:shadow-slate-300/40 hover:ring-logo-light-green/20">
                                    <a href="{{ $detailUrl }}" class="relative flex flex-1 flex-col focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2">
                                        <div class="relative aspect-[4/3] w-full shrink-0 overflow-hidden bg-slate-100">
                                            <img
                                                src="{{ asset('images/course.jpeg') }}"
                                                alt=""
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                            <div class="absolute inset-0 flex items-center justify-center p-4">
                                                <span class="block max-w-full text-balance text-center text-base font-bold uppercase leading-snug tracking-tight text-logo-blue sm:text-3xl">
                                                    {{ $title ?? '—' }}
                                                </span>
                                            </div>
                                            @auth
                                                @if (auth()->user()?->role_type === 'user')
                                                    <div class="absolute bottom-4 right-4 z-10 flex items-center rounded-sm bg-green-500 px-2.5 py-1 text-xs font-bold tracking-wide text-white shadow-sm">
                                                        Credit Point: {{ $creditPoints }}
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </section>
    </main>
@endsection
