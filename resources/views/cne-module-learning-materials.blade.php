@extends('layouts.frontend.app')

@section('title', 'Learning Materials – ' . ($course->couse_name ?? 'Module'))

@push('styles')
<style>
    /* Prevent printing */
    @media print {
        html, body, * {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            overflow: hidden !important;
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

        <section class="bg-gradient-to-b from-slate-50/80 to-white py-12 sm:py-16" x-data="{ 
            activeIndex: 0, 
            total: {{ count($courseMaterials) }},
            next() { if (this.activeIndex < this.total - 1) this.activeIndex++ },
            prev() { if (this.activeIndex > 0) this.activeIndex-- }
        }">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                @if(count($courseMaterials) > 0)
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                        {{-- Sidebar Navigation --}}
                        <aside class="lg:col-span-1">
                            <nav class="sticky top-32 space-y-2">
                                <p class="mb-4 text-xs font-bold uppercase tracking-wider text-slate-400">Modules</p>
                                @foreach ($courseMaterials as $index => $material)
                                    <button 
                                        @click="activeIndex = {{ $index }}"
                                        :class="activeIndex === {{ $index }} ? 'bg-logo-blue text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-semibold transition-all"
                                    >
                                        <span 
                                            :class="activeIndex === {{ $index }} ? 'bg-white/20' : 'bg-slate-100'"
                                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-[10px]"
                                        >
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="truncate">{{ $material['subtitle'] }}</span>
                                    </button>
                                @endforeach
                            </nav>
                        </aside>

                        {{-- Main Slider Content --}}
                        <div class="lg:col-span-3">
                            <div class="relative min-h-[400px]">
                                @foreach ($courseMaterials as $index => $material)
                                    <article 
                                        x-show="activeIndex === {{ $index }}"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-4"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white shadow-xl shadow-slate-200/50 ring-1 ring-slate-100"
                                    >
                                        <header class="border-b border-slate-100 bg-slate-50/50 px-6 py-6 sm:px-8">
                                            <div class="flex items-center justify-between gap-4">
                                                <div>
                                                    <p class="text-[10px] font-bold uppercase tracking-widest text-logo-blue">Module {{ $index + 1 }} of {{ count($courseMaterials) }}</p>
                                                    <h2 class="mt-1 text-xl font-bold tracking-tight text-slate-900 sm:text-2xl font-serif">
                                                        {{ $material['subtitle'] }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </header>
                                        
                                        <div class="px-6 py-8 sm:px-8 sm:py-10">
                                            <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-inset ring-slate-200/60">
                                                <h3 class="mb-4 flex items-center gap-2 text-sm font-bold text-slate-800">
                                                    <svg class="h-4 w-4 text-logo-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                    </svg>
                                                    Available Files
                                                </h3>
                                                <ul class="grid gap-3 sm:grid-cols-2">
                                                    @foreach ($material['attachments'] as $path)
                                                        @php
                                                            $originalFileName = preg_replace('/^\d+_/', '', basename($path));
                                                        @endphp
                                                        <li>
                                                            <a
                                                                href="javascript:void(0)"
                                                                onclick="openFile('{{ asset('storage/' . $path) }}')"
                                                                class="group flex items-center gap-3 rounded-xl border border-white bg-white px-4 py-3 shadow-sm transition-all hover:border-logo-blue hover:shadow-md"
                                                            >
                                                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-logo-blue/10 text-logo-blue transition-colors group-hover:bg-logo-blue group-hover:text-white">
                                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                                    </svg>
                                                                </div>
                                                                <span class="truncate text-sm font-medium text-slate-700 transition-colors group-hover:text-logo-blue">
                                                                    {{ $originalFileName }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        {{-- Navigation Footer --}}
                                        <footer class="flex items-center justify-between border-t border-slate-100 bg-slate-50/30 px-6 py-6 sm:px-8">
                                            <button 
                                                @click="prev()"
                                                :disabled="activeIndex === 0"
                                                :class="activeIndex === 0 ? 'opacity-50 cursor-not-allowed text-slate-400' : 'text-slate-600 hover:text-logo-blue hover:bg-white'"
                                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold shadow-sm transition-all"
                                            >
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12l7.5-7.5" />
                                                </svg>
                                                Previous
                                            </button>

                                            <div class="hidden sm:flex items-center gap-1.5">
                                                @foreach ($courseMaterials as $dotIndex => $dotMaterial)
                                                    <div 
                                                        class="h-1.5 rounded-full transition-all duration-300"
                                                        :class="activeIndex === {{ $dotIndex }} ? 'w-6 bg-logo-blue' : 'w-1.5 bg-slate-300'"
                                                    ></div>
                                                @endforeach
                                            </div>

                                            <button 
                                                @click="next()"
                                                :disabled="activeIndex === total - 1"
                                                :class="activeIndex === total - 1 ? 'opacity-50 cursor-not-allowed text-slate-400' : 'bg-logo-blue text-white hover:bg-blue-700'"
                                                class="inline-flex items-center gap-2 rounded-xl border border-transparent px-5 py-2.5 text-sm font-bold shadow-sm transition-all"
                                            >
                                                Next
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5" />
                                                </svg>
                                            </button>
                                        </footer>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-20 text-center text-sm text-slate-500 shadow-sm">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        No learning materials available for this course yet.
                    </div>
                @endif
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
                    <div class="flex-1 w-full bg-slate-800 relative group overflow-hidden">
                        {{-- Shield overlay to block right-clicks and internal buttons, leaving a gap for the scrollbar --}}
                        <div id="viewerShield" class="absolute top-0 left-0 w-[calc(100%-24px)] h-full z-20 hidden" oncontextmenu="return false;"></div>
                        
                        {{-- Targeted mask to visually hide the "pop-out" button in the top right --}}
                        <div id="topRightMask" class="absolute top-0 right-0 w-14 h-14 bg-slate-800 z-30 hidden"></div>
                        
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

            // Handle different file types
            let finalUrl = url;
            const lowerUrl = url.toLowerCase();
            
            if (lowerUrl.endsWith('.pdf')) {
                // For PDFs: view=FitH fits to width, view=Fit fits to whole page
                finalUrl += '#toolbar=0&navpanes=0&view=FitH';
            } else if (
                lowerUrl.endsWith('.pptx') || lowerUrl.endsWith('.ppt') || 
                lowerUrl.endsWith('.docx') || lowerUrl.endsWith('.doc') || 
                lowerUrl.endsWith('.xlsx') || lowerUrl.endsWith('.xls')
            ) {
                // For Office documents: Use Google Docs Viewer to render in iframe
                finalUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent(url) + '&embedded=true';
            }

            viewer.src = finalUrl;
            modal.classList.remove('hidden');
            
            // Show shield and top-right mask, then enable scroll-through hack
            const shield = document.getElementById('viewerShield');
            const topRightMask = document.getElementById('topRightMask');
            shield.classList.remove('hidden');
            topRightMask.classList.remove('hidden');
            
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modal = document.getElementById('fileModal');
            const viewer = document.getElementById('fileViewer');
            const shield = document.getElementById('viewerShield');
            const topRightMask = document.getElementById('topRightMask');
            
            modal.classList.add('hidden');
            shield.classList.add('hidden');
            topRightMask.classList.add('hidden');
            viewer.src = '';
            document.body.style.overflow = 'auto';
        }

        // Close on Escape key
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
            
            // Disable Print (Ctrl+P / Cmd+P)
            if ((event.ctrlKey || event.metaKey) && (event.key === 'p' || event.key === 'P')) {
                event.preventDefault();
                event.stopImmediatePropagation();
                alert('Printing is disabled for this material.');
                return false;
            }

            // Disable Save (Ctrl+S / Cmd+S)
            if ((event.ctrlKey || event.metaKey) && (event.key === 's' || event.key === 'S')) {
                event.preventDefault();
                event.stopImmediatePropagation();
                return false;
            }
        }, true); // Use capture to catch events before they reach the iframe if possible

        // Block printing via browser menu/shortcuts more aggressively
        window.addEventListener('beforeprint', (event) => {
            closeModal();
            // Also hide the entire body just in case
            document.body.style.display = 'none';
            setTimeout(() => {
                document.body.style.display = 'block';
            }, 100);
            alert('Printing is disabled for this material.');
        });

        // Smart Shield Scroll-Through Hack
        // This allows scrolling while the shield is active by temporarily disabling the shield during wheel events
        const shield = document.getElementById('viewerShield');
        shield.addEventListener('wheel', (e) => {
            shield.style.pointerEvents = 'none';
            
            // Re-enable shield quickly after scrolling stops
            clearTimeout(shield._scrollTimer);
            shield._scrollTimer = setTimeout(() => {
                shield.style.pointerEvents = 'auto';
            }, 200); // Reduced to 200ms for better responsiveness
        }, { passive: true });

        // Ensure shield is active when mouse moves (unless scrolling)
        shield.addEventListener('mousemove', () => {
            if (shield.style.pointerEvents === 'none' && !shield._scrollTimer) {
                shield.style.pointerEvents = 'auto';
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
