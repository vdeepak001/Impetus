@extends('layouts.frontend.app')

@section('title', ($course->couse_name ?? 'Module') . ' Learning Materials')

@section('content')
    @php
        $title = $course->couse_name ?? 'Module';
        $courseMaterials = ($course->materials ?? collect())
            ->filter(fn ($material) => filled($material->course_title_id) && $material->courseTitle)
            ->map(function ($material) {
                return [
                    'subtitle' => $material->description ?: ($material->courseTitle?->title_name ?? 'Sub Title'),
                    'attachments' => collect(is_array($material->attachment) ? $material->attachment : [])
                        ->filter(fn ($path) => filled($path))
                        ->values()
                        ->all(),
                ];
            })
            ->values();
    @endphp

    <main class="pb-16">
        <div class="h-[100px]" aria-hidden="true"></div>

        <section class="py-14 sm:py-16">
            <div class="mx-auto max-w-6xl px-6 lg:px-8">
                <div class="rounded-3xl border border-slate-200/80 bg-white p-6 shadow-lg shadow-slate-200/60 sm:p-8">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-logo-blue/80">Learning Materials</p>
                            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">{{ $title }}</h1>
                        </div>
                        <a
                            href="{{ route('cne.modules.show', $course->couse_name) }}"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-slate-600 transition hover:border-logo-blue hover:text-logo-blue"
                        >
                            Back to Module
                        </a>
                    </div>

                    <div class="mt-8 space-y-4">
                        @forelse ($courseMaterials as $material)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
                                <h2 class="text-lg font-bold text-slate-900">{{ $material['subtitle'] }}</h2>
                                @if (! empty($material['attachments']))
                                    <ul class="mt-3 space-y-2">
                                        @foreach ($material['attachments'] as $path)
                                            @php
                                                $originalFileName = preg_replace('/^\d+_/', '', basename($path));
                                            @endphp
                                            <li>
                                                <a
                                                    href="{{ asset('storage/' . $path) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="inline-flex items-center gap-2 text-sm font-medium text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-600"
                                                >
                                                    {{ $originalFileName }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="mt-2 text-sm text-slate-500">No files uploaded for this subtitle.</p>
                                @endif
                            </div>
                        @empty
                            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 text-sm text-slate-500">
                                No learning materials available for this course yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
