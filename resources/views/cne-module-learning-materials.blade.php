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
            ->map(function ($material) {
                $desc = trim((string) ($material->description ?? ''));
                $titleNameRaw = (string) ($material->courseTitle?->title_name ?? '');
                $titleNames = array_map('trim', explode(' | ', $titleNameRaw));
                
                // Find index of this material's sub-topic in the course's sub-titles sequence
                $index = array_search($desc, $titleNames);
                // If not found, use a large number to put it at the end
                $material->admin_order = ($index !== false) ? $index : 9999;
                
                return $material;
            })
            // Sort by course_title_id first, then by the admin sequence within that record, then by material id
            ->sort(function ($a, $b) {
                if ($a->course_title_id !== $b->course_title_id) {
                    return $a->course_title_id <=> $b->course_title_id;
                }
                if ($a->admin_order !== $b->admin_order) {
                    return $a->admin_order <=> $b->admin_order;
                }
                return $a->id <=> $b->id;
            })
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

        <section class="relative bg-slate-50/50 py-12 sm:py-20" x-data="{ 
            activeIndex: 0, 
            total: {{ count($courseMaterials) }},
            next() { if (this.activeIndex < this.total - 1) this.activeIndex++ },
            prev() { if (this.activeIndex > 0) this.activeIndex-- }
        }">
            {{-- Abstract Background Elements --}}
            <div class="pointer-events-none absolute left-0 top-0 h-full w-full overflow-hidden" aria-hidden="true">
                <div class="absolute -left-24 top-1/4 h-96 w-96 rounded-full bg-logo-blue/5 blur-3xl"></div>
                <div class="absolute -right-24 bottom-1/4 h-96 w-96 rounded-full bg-logo-light-green/10 blur-3xl"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                @if(count($courseMaterials) > 0)
                    <div class="flex flex-col gap-12 lg:flex-row">
                        {{-- Sidebar Navigation: "The Step Path" --}}
                        <aside class="w-full shrink-0 lg:w-80">
                            <div class="sticky top-32">
                                <div class="mb-6 flex items-center justify-between">
                                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Topics</h3>
                                    <span class="rounded-full bg-slate-200/50 px-2.5 py-0.5 text-[10px] font-bold text-slate-500" x-text="(activeIndex + 1) + '/' + total"></span>
                                </div>
                                
                                <nav class="relative space-y-4">
                                    {{-- The Connecting Line --}}
                                    <div class="absolute left-6 top-6 h-[calc(100%-48px)] w-0.5 bg-slate-200" aria-hidden="true"></div>
                                    
                                    @foreach ($courseMaterials as $index => $material)
                                        <button 
                                            @click="activeIndex = {{ $index }}"
                                            class="group relative flex w-full items-start gap-4 text-left transition-all focus:outline-none"
                                        >
                                            {{-- The Indicator Circle --}}
                                            <div 
                                                class="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border-2 transition-all duration-300"
                                                :class="activeIndex === {{ $index }} ? 'bg-logo-blue border-logo-blue shadow-lg shadow-logo-blue/30 scale-110' : 'bg-white border-slate-200 group-hover:border-logo-blue/30'"
                                            >
                                                <span 
                                                    class="text-sm font-bold transition-colors duration-300"
                                                    :class="activeIndex === {{ $index }} ? 'text-white' : 'text-slate-400 group-hover:text-logo-blue'"
                                                >
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>
                                            
                                            <div class="pt-1.5">
                                                <p 
                                                    class="text-sm font-bold leading-tight transition-colors duration-300"
                                                    :class="activeIndex === {{ $index }} ? 'text-logo-blue' : 'text-slate-500 group-hover:text-slate-800'"
                                                >
                                                    {{ $material['subtitle'] }}
                                                </p>
                                                <p class="mt-1 text-[11px] text-slate-400" x-show="activeIndex === {{ $index }}">Currently viewing</p>
                                            </div>
                                        </button>
                                    @endforeach
                                </nav>
                            </div>
                        </aside>

                        {{-- Main Slider Content Card --}}
                        <div class="flex-1">
                            <div class="relative">
                                <article class="group relative overflow-hidden rounded-[2.5rem] border border-white bg-white/80 p-1 shadow-2xl shadow-slate-200/60 backdrop-blur-xl ring-1 ring-slate-200/50">
                                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-logo-blue/5 transition-transform duration-700 group-hover:scale-110"></div>
                                    
                                    <div class="relative flex h-full flex-col overflow-hidden rounded-[2.25rem] bg-white">
                                        {{-- Persistent Top Navigation Stripe --}}
                                        <nav class="flex items-center justify-between border-b border-slate-100 bg-slate-50/50 px-8 py-4 sm:px-12">
                                            <button 
                                                type="button"
                                                @click="prev()"
                                                :disabled="activeIndex === 0"
                                                class="group flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600 transition-all disabled:opacity-30 hover:border-logo-blue hover:text-logo-blue"
                                            >
                                                <svg class="h-3.5 w-3.5 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12l7.5-7.5" />
                                                </svg>
                                                Prev
                                            </button>

                                            <div class="hidden items-center gap-2 sm:flex">
                                                @foreach ($courseMaterials as $dotIndex => $dotMaterial)
                                                    <button 
                                                        type="button"
                                                        @click="activeIndex = {{ $dotIndex }}"
                                                        class="h-1.5 rounded-full transition-all duration-500"
                                                        :class="activeIndex === {{ $dotIndex }} ? 'w-6 bg-logo-blue' : 'w-1.5 bg-slate-200 hover:bg-slate-300'"
                                                    ></button>
                                                @endforeach
                                            </div>

                                            <button 
                                                type="button"
                                                @click="next()"
                                                :disabled="activeIndex === total - 1"
                                                class="group flex items-center gap-2 rounded-xl bg-logo-blue px-5 py-2 text-xs font-bold text-white shadow-lg shadow-logo-blue/20 transition-all disabled:opacity-30 hover:bg-blue-700 hover:shadow-logo-blue/30"
                                            >
                                                Next
                                                <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5" />
                                                </svg>
                                            </button>
                                        </nav>

                                        {{-- Content Area: This transitions, while the card and stripe stay stable --}}
                                        <div class="flex-1 p-8 sm:p-12">
                                            @foreach ($courseMaterials as $index => $material)
                                                <div 
                                                    x-show="activeIndex === {{ $index }}"
                                                    x-transition:enter="transition ease-out duration-500"
                                                    x-transition:enter-start="opacity-0 translate-x-8"
                                                    x-transition:enter-end="opacity-100 translate-x-0"
                                                >
                                                    {{-- Card Header --}}
                                                    <header class="mb-10">
                                                        <h2 class="font-serif text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                                                            {{ $material['subtitle'] }}
                                                        </h2>
                                                        <div class="mt-4 h-1.5 w-20 rounded-full bg-gradient-to-r from-logo-blue to-logo-light-green"></div>
                                                    </header>
                                                    
                                                    {{-- Resources Section --}}
                                                    <div>

                                                        
                                                        <div class="grid gap-4 sm:grid-cols-2">
                                                            @php
                                                                $attachments = array_map(function($path) {
                                                                    return [
                                                                        'url' => asset('storage/' . $path),
                                                                        'name' => preg_replace('/^\d+_/', '', basename($path)),
                                                                        'extension' => strtolower(pathinfo($path, PATHINFO_EXTENSION))
                                                                    ];
                                                                }, $material['attachments']);
                                                                $attachmentsJson = htmlspecialchars(json_encode($attachments), ENT_QUOTES, 'UTF-8');
                                                            @endphp
                                                            @foreach ($attachments as $attIndex => $att)
                                                                @php
                                                                    $typeColor = match($att['extension']) {
                                                                        'pdf' => 'text-red-500 bg-red-50 border-red-100',
                                                                        'doc', 'docx' => 'text-blue-500 bg-blue-50 border-blue-100',
                                                                        'ppt', 'pptx', 'pps', 'ppsx' => 'text-orange-500 bg-orange-50 border-orange-100',
                                                                        default => 'text-slate-500 bg-slate-50 border-slate-100'
                                                                    };
                                                                @endphp
                                                                <button
                                                                    type="button"
                                                                    onclick="openFile({!! $attachmentsJson !!}, {{ $attIndex }})"
                                                                    class="group relative flex items-center gap-4 rounded-2xl border border-slate-100 bg-slate-50/50 p-4 transition-all hover:border-logo-blue hover:bg-white hover:shadow-xl hover:shadow-logo-blue/10"
                                                                >
                                                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border {{ $typeColor }} transition-transform duration-300 group-hover:scale-110">
                                                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="min-w-0 flex-1 text-left">
                                                                        <p class="truncate text-sm font-bold text-slate-800 group-hover:text-logo-blue">{{ $att['name'] }}</p>
                                                                        <p class="mt-0.5 text-[10px] font-bold uppercase tracking-tight text-slate-400 group-hover:text-slate-500">{{ strtoupper($att['extension']) }} Document</p>
                                                                    </div>
                                                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white opacity-0 transition-all duration-300 group-hover:opacity-100 group-hover:shadow-sm">
                                                                        <svg class="h-4 w-4 text-logo-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                                        </svg>
                                                                    </div>
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-[2.5rem] border border-dashed border-slate-300 bg-white px-6 py-24 text-center shadow-sm">
                        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-50 text-slate-200">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">No Learning Materials</h3>
                        <p class="mt-2 text-sm text-slate-500">Resources for this module are currently being prepared.</p>
                    </div>
                @endif
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
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-2.5 bg-white/95 backdrop-blur-md shrink-0">
                        {{-- Left: File Title --}}
                        {{-- Left: Spacer to keep center nav centered --}}
                        <div class="flex-1"></div>
                        
                        {{-- Center: Combined Navigation --}}
                        <div class="flex items-center justify-center gap-4 shrink-0">



                            {{-- PDF Navigation --}}
                            <div id="pdfNav" class="hidden flex items-center gap-2 bg-slate-50 rounded-xl border border-slate-200 p-1 shadow-sm">
                                <div class="flex items-center gap-1.5 px-2 border-r border-slate-200 mr-1">
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Page</span>
                                    <span id="pdfPageDisplay" class="text-[11px] font-bold text-slate-700 ml-1">1/1</span>
                                </div>
                                <div class="flex items-center gap-1 pr-1">
                                    <button onclick="navigatePdf(-1)" class="group flex items-center justify-center rounded-lg h-7 w-7 bg-logo-blue text-white shadow-sm hover:bg-brand-600 transition-all">
                                        <svg class="h-3.5 w-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                    <button onclick="navigatePdf(1)" class="group flex items-center justify-center rounded-lg h-7 w-7 bg-logo-blue text-white shadow-sm hover:bg-brand-600 transition-all">
                                        <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Close Button --}}
                        <div class="flex-1 flex justify-end">
                            <button type="button" class="group flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:text-red-500 hover:bg-red-50 transition-all shadow-sm" onclick="closeModal()">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 w-full bg-slate-800 relative group overflow-hidden flex flex-col">
                        {{-- Targeted masks to visually hide download/pop-out buttons for Office Viewer --}}
                        <div id="topRightMask" class="absolute top-0 right-0 w-20 h-14 bg-slate-800 z-[70] hidden"></div>
                        <div id="bottomBarMaskLeft" class="absolute bottom-0 left-0 w-[40%] h-10 bg-slate-800 z-[70] hidden"></div>
                        <div id="bottomBarMaskRight" class="absolute bottom-0 right-0 w-[40%] h-10 bg-slate-800 z-[70] hidden"></div>
                        
                        {{-- Native/Office Viewer Iframe --}}
                        <iframe id="fileViewer" src="" class="w-full h-full border-0 block" oncontextmenu="return false;"></iframe>

                        {{-- Custom PDF.js Viewer --}}
                        <div id="pdfViewerContainer" class="hidden absolute inset-0 overflow-y-auto bg-slate-700/60 py-12 scroll-smooth text-center z-10">
                            {{-- Pages will be injected here --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        let currentAttachments = [];
        let currentAttachmentIndex = -1;
        let currentSlideIndex = 1;
        let currentPdfPage = 1;
        let totalPdfPages = 1;
        let pdfObserver = null;

        function openFile(attachments, index) {
            currentAttachments = attachments;
            currentAttachmentIndex = index;
            currentSlideIndex = 1;
            currentPdfPage = 1;
            totalPdfPages = 1;
            updateModalContent();
            
            const modal = document.getElementById('fileModal');
            modal.classList.remove('hidden');
            
            document.body.style.overflow = 'hidden';
        }

        function updateModalContent() {
            if (currentAttachmentIndex < 0 || currentAttachmentIndex >= currentAttachments.length) return;

            const att = currentAttachments[currentAttachmentIndex];
            const viewer = document.getElementById('fileViewer');
            const viewerContainer = viewer.parentElement;
            const pdfNav = document.getElementById('pdfNav');
            const topRightMask = document.getElementById('topRightMask');
            const bottomBarMaskLeft = document.getElementById('bottomBarMaskLeft');
            const bottomBarMaskRight = document.getElementById('bottomBarMaskRight');

            let finalUrl = att.url;
            const extension = att.extension;
            const isPPT = ['pptx', 'ppt', 'pps', 'ppsx'].includes(extension);
            const isPDF = extension === 'pdf';
            pdfNav.classList.toggle('hidden', !isPDF);

            const pdfContainer = document.getElementById('pdfViewerContainer');

            if (isPDF) {
                viewer.classList.add('hidden');
                pdfContainer.classList.remove('hidden');
                pdfContainer.innerHTML = '<div class="flex items-center gap-3 text-white/50 animate-pulse"><svg class="h-6 w-6 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Rendering PDF...</span></div>';
                
                try {
                    const loadingTask = pdfjsLib.getDocument(att.url);
                    loadingTask.promise.then(async (pdf) => {
                        totalPdfPages = pdf.numPages;
                        pdfContainer.innerHTML = ''; // Clear loader
                        document.getElementById('pdfPageDisplay').textContent = '1/' + totalPdfPages;
                        
                        // Setup Observer to track current page
                        if (pdfObserver) pdfObserver.disconnect();
                        const visiblePages = new Map();
                        pdfObserver = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    visiblePages.set(entry.target.dataset.page, entry.intersectionRatio);
                                } else {
                                    visiblePages.delete(entry.target.dataset.page);
                                }
                            });

                            let maxRatio = -1;
                            let bestPage = currentPdfPage;
                            visiblePages.forEach((ratio, page) => {
                                if (ratio > maxRatio) {
                                    maxRatio = ratio;
                                    bestPage = parseInt(page);
                                }
                            });

                            if (bestPage !== currentPdfPage) {
                                currentPdfPage = bestPage;
                                document.getElementById('pdfPageDisplay').textContent = currentPdfPage + '/' + totalPdfPages;
                            }
                        }, { 
                            threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0], 
                            root: pdfContainer 
                        });

                        for (let pageNum = 1; pageNum <= totalPdfPages; pageNum++) {
                            const page = await pdf.getPage(pageNum);
                            const canvas = document.createElement('canvas');
                            canvas.className = 'shadow-2xl bg-white mx-auto mb-8 block max-w-[95%]';
                            canvas.dataset.page = pageNum;
                            pdfContainer.appendChild(canvas);
                            
                            const context = canvas.getContext('2d');
                            const viewport = page.getViewport({ scale: 2 }); // High quality
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            await page.render(renderContext).promise;
                            pdfObserver.observe(canvas);
                        }
                    }).catch(err => {
                        console.error('PDF.js Error:', err);
                        pdfContainer.innerHTML = '<div class="text-red-400">Failed to load PDF. Please try again.</div>';
                    });
                } catch (e) {
                    console.error('Error starting PDF.js task:', e);
                }

                topRightMask.classList.add('hidden');
                bottomBarMaskLeft.classList.add('hidden');
                bottomBarMaskRight.classList.add('hidden');
                viewerContainer.classList.replace('bg-slate-800', 'bg-white');
            } else {
                viewer.classList.remove('hidden');
                pdfContainer.classList.add('hidden');
                
                if (isPPT || ['docx', 'doc', 'xlsx', 'xls'].includes(extension)) {
                    finalUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(att.url);
                    if (isPPT) {
                        finalUrl += '&wdAr=1.77&wdSlideIndex=' + currentSlideIndex;
                    }
                    topRightMask.classList.toggle('hidden', !isPPT && extension !== 'docx' && extension !== 'doc');
                    bottomBarMaskLeft.classList.toggle('hidden', !isPPT);
                    bottomBarMaskRight.classList.toggle('hidden', !isPPT);
                    viewerContainer.classList.replace('bg-white', 'bg-slate-800');
                } else {
                    topRightMask.classList.add('hidden');
                    bottomBarMaskLeft.classList.add('hidden');
                    bottomBarMaskRight.classList.add('hidden');
                    viewerContainer.classList.replace('bg-white', 'bg-slate-800');
                }
                viewer.src = finalUrl;
            }
        }




        function navigatePdf(direction) {
            const nextPage = Math.min(totalPdfPages, Math.max(1, currentPdfPage + direction));
            const targetCanvas = document.querySelector(`#pdfViewerContainer canvas[data-page="${nextPage}"]`);
            if (targetCanvas) {
                targetCanvas.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        function closeModal() {
            const modal = document.getElementById('fileModal');
            const viewer = document.getElementById('fileViewer');
            modal.classList.add('hidden');
            viewer.src = '';
            document.body.style.overflow = 'auto';
        }


        // Close on Escape key
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
            
            const modal = document.getElementById('fileModal');

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
                alert('Saving is disabled for this material.');
                return false;
            }
        }, true);

        // Block printing via browser menu/shortcuts more aggressively
        window.addEventListener('beforeprint', (event) => {
            const modal = document.getElementById('fileModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeModal();
                alert('Printing is disabled for this material.');
            }
        });

        // Disable right click globally when modal is open as a fallback
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
