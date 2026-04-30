@extends('layouts.frontend.app')

@section('title', 'Learning Materials – ' . ($course->couse_name ?? 'Module'))

@push('styles')
<style>
    /* Prevent printing */
    @media print {
        * {
            display: none !important;
            visibility: hidden !important;
        }
    }
    
    /* Disable selection */
    .select-none {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
@endpush

@section('content')
    @php
        $courseName = $course->couse_name ?? 'Module';
        // One card per material row. Card title matches admin "Sub Title": description (row label, e.g. FSWD1) then course title name.
        $courseMaterials = ($course->materials ?? collect())
            ->filter(fn ($material) => filled($material->course_title_id) && $material->courseTitle)
            ->sortBy('id')
            ->values()
            ->map(function ($material) {
                $desc = trim((string) ($material->description ?? ''));
                $titleName = trim((string) ($material->courseTitle?->title_name ?? ''));
                $subtitle = $desc !== '' ? $desc : $titleName;
                $attachments = collect(is_array($material->attachment) ? $material->attachment : [])
                    ->filter(fn ($path) => filled($path))
                    ->values()
                    ->all();

                return [
                    'subtitle' => $subtitle,
                    'attachments' => $attachments,
                ];
            })
            ->filter(fn ($section) => filled($section['subtitle']) && ! empty($section['attachments']))
            ->values();
    @endphp

    <main class="pb-16">
        <div class="h-[100px]" aria-hidden="true"></div>

        <section class="relative overflow-hidden border-b border-slate-200/80 bg-gradient-to-br from-white via-slate-50 to-logo-light-green/5 py-12 sm:py-16">
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full bg-logo-light-green/20 blur-3xl"></div>
            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0 flex-1">
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl font-serif">
                            <span class="text-logo-blue">Learning Materials</span>
                            <span class="font-normal text-slate-400" aria-hidden="true"> – </span>
                            <span class="text-slate-900">{{ $courseName }}</span>
                        </h1>
                    </div>
                    <a
                        href="{{ route('cne.modules.show', $course->couse_name) }}"
                        class="inline-flex shrink-0 items-center gap-2 self-start rounded-full border border-slate-300 bg-white/90 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-slate-600 shadow-sm transition hover:border-logo-blue hover:text-logo-blue focus:outline-none focus-visible:ring-2 focus-visible:ring-logo-blue focus-visible:ring-offset-2 sm:self-auto"
                    >
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </section>

        <section class="bg-gradient-to-b from-slate-50/80 to-white py-12 sm:py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="space-y-6">
                    @forelse ($courseMaterials as $material)
                        <article class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-lg shadow-slate-200/50 ring-1 ring-slate-100">
                            <header class="border-b border-slate-200/80 bg-gradient-to-r from-slate-50 via-white to-logo-light-green/5 px-5 py-4 sm:px-6 sm:py-4">
                                <h2 class="text-lg font-bold tracking-tight text-slate-900 sm:text-xl">
                                    {{ $loop->iteration }}. {{ $material['subtitle'] }}
                                </h2>
                            </header>
                            <div class="px-5 py-5 sm:px-6 sm:py-6">
                                <ul class="list-none space-y-2.5 text-slate-700">
                                    @foreach ($material['attachments'] as $path)
                                        @php
                                            $originalFileName = preg_replace('/^\d+_/', '', basename($path));
                                        @endphp
                                        <li class="flex gap-3">
                                            <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-logo-blue" aria-hidden="true"></span>
                                            <a
                                                href="javascript:void(0)"
                                                onclick="openFile('{{ asset('storage/' . $path) }}')"
                                                class="font-medium text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-600"
                                            >
                                                {{ $originalFileName }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-slate-200 bg-white px-6 py-10 text-center text-sm text-slate-500 shadow-sm">
                            No learning materials available for this course yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
    {{-- Modal for file viewing --}}
    <div id="fileModal" class="fixed inset-0 z-[100] hidden overflow-hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
                {{-- Modal Content --}}
                <div class="relative flex w-full max-w-6xl h-[90vh] transform flex-col overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 bg-slate-50 shrink-0">
                        <h3 class="text-lg font-bold text-slate-900 truncate pr-4" id="modal-title">File Viewer</h3>
                        <button type="button" class="rounded-lg p-1 text-slate-400 hover:bg-slate-100 hover:text-slate-500 transition-colors focus:outline-none shrink-0" onclick="closeModal()">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 w-full bg-slate-800 relative group">
                        <iframe id="fileViewer" src="" class="w-full h-full border-0 block" oncontextmenu="return false;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        function openFile(url) {
            const modal = document.getElementById('fileModal');
            const viewer = document.getElementById('fileViewer');
            const title = document.getElementById('modal-title');
            
            // Extract filename for the title
            const filename = url.split('/').pop().replace(/^\d+_/, '');
            title.textContent = filename;

            // If it's a PDF, add parameters to hide toolbar and fit width
            let finalUrl = url;
            if (url.toLowerCase().endsWith('.pdf')) {
                // view=FitH fits to width, view=Fit fits to whole page
                finalUrl += '#toolbar=0&navpanes=0&view=FitH';
            }

            viewer.src = finalUrl;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('fileModal');
            const viewer = document.getElementById('fileViewer');
            
            modal.classList.add('hidden');
            viewer.src = '';
            document.body.style.overflow = 'auto';
        }

        // Close on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
            
            // Disable Print (Ctrl+P / Cmd+P)
            if ((event.ctrlKey || event.metaKey) && event.key === 'p') {
                event.preventDefault();
                alert('Printing is disabled for this material.');
                return false;
            }

            // Disable Save (Ctrl+S / Cmd+S)
            if ((event.ctrlKey || event.metaKey) && event.key === 's') {
                event.preventDefault();
                return false;
            }
        });

        // Disable right click globally when modal is open
        document.addEventListener('contextmenu', function(e) {
            const modal = document.getElementById('fileModal');
            if (modal && !modal.classList.contains('hidden')) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endpush

@endsection
