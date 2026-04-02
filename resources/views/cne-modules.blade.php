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

                @if ($courses->isEmpty())
                    <div class="rounded-3xl border border-slate-200/80 bg-white px-8 py-14 text-center shadow-lg shadow-slate-200/50 ring-1 ring-slate-100">
                        <p class="text-lg leading-8 text-slate-600 text-justify">No modules are available yet. Please check back later.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($courses as $course)
                            @php
                                $imgUrl = $course->attachmentPublicUrl();
                                $isImage = $course->attachmentIsImage();
                                $title = $course->couse_name;
                                $detailUrl = route('cne.modules.show', $course);
                            @endphp
                            <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-md shadow-slate-200/50 ring-1 ring-slate-100 transition hover:-translate-y-0.5 hover:border-logo-light-green/30 hover:shadow-xl hover:shadow-slate-300/40 hover:ring-logo-light-green/20">
                                <a href="{{ $detailUrl }}" class="flex flex-1 flex-col focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2">
                                    <div class="relative aspect-[4/3] w-full shrink-0 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-50">
                                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition group-hover:opacity-100"></div>
                                        @if ($imgUrl && $isImage)
                                            <img
                                                src="{{ $imgUrl }}"
                                                alt="{{ $title ?? 'Course module' }}"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                                loading="lazy"
                                            >
                                        @elseif ($imgUrl)
                                            <div class="flex h-full w-full flex-col items-center justify-center gap-2 p-4 text-center">
                                                <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-logo-blue shadow-sm ring-1 ring-slate-200/80">Document</span>
                                                <span class="text-xs text-slate-500">Open module for details</span>
                                            </div>
                                        @else
                                            <div class="flex h-full w-full flex-col items-center justify-center text-slate-400">
                                                <svg class="mb-2 h-10 w-10 text-logo-light-green/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3A1.5 1.5 0 001.5 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008H12V8.25z" />
                                                </svg>
                                                <span class="text-xs font-medium">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-1 flex-col bg-gradient-to-b from-white to-slate-50/90 p-4">
                                        <div class="rounded-xl border-2 border-logo-blue/70 bg-white px-3 py-3.5 text-center shadow-sm transition group-hover:border-logo-blue group-hover:shadow-md">
                                            <h2 class="text-xs font-bold uppercase tracking-wide text-logo-blue sm:text-sm">
                                                {{ $title ?? '—' }}
                                            </h2>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
