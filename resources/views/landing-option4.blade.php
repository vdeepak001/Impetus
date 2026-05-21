<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Impetus eLearning Solutions - Next-generation corporate training ecosystems, accredited CPD courseware, and next-generation LMS platforms engineered for scale and regulatory compliance.">
    <title>Impetus eLearning Solutions | Cinematic Enterprise & CPD Systems</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@800&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                        cabinet: ['"Cabinet Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        steel: {
                            50: '#F8FAFC',
                            100: '#F1F5F9',
                            200: '#E2E8F0',
                            300: '#CBD5E1',
                            400: '#94A3B8',
                            500: '#64748B',
                            600: '#475569',
                            700: '#334155',
                            800: '#1E293B',
                            900: '#0F172A',
                            950: '#0B0F17', // Steel Obsidian
                        },
                        amber: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            200: '#FDE68A',
                            500: '#F97316',
                            600: '#EA580C', // Deep Orange
                            700: '#C2410C',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out infinite 3s',
                        'scroll-left': 'scrollLeft 30s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-8px) rotate(0.5deg)' },
                        },
                        scrollLeft: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .steel-grid-pattern {
            background-image: linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .gradient-text-orange {
            background: linear-gradient(135deg, #EA580C 0%, #F97316 50%, #94A3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .orange-glow-line {
            box-shadow: 0 0 20px rgba(234, 88, 12, 0.4);
        }
        .glass-steel-panel {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.08);
        }
        .glass-light-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }
    </style>
</head>
<body class="bg-steel-50 text-steel-800 antialiased font-sans steel-grid-pattern overflow-x-hidden">

    <!-- Floating Navigation Bar -->
    <header class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-6xl transition-all duration-300">
        <div class="glass-steel-panel px-6 py-4 rounded-2xl flex items-center justify-between shadow-2xl">
            <!-- Brand Logo -->
            <a href="#hero" class="flex items-center gap-3" id="nav-logo">
                <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=&quot;flex items-center gap-2.5&quot;><div class=&quot;w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-600 to-amber-500 flex items-center justify-center text-white font-extrabold text-lg shadow-lg shadow-amber-600/30 font-outfit&quot;>i</div><div class=&quot;flex flex-col&quot;><span class=&quot;font-extrabold text-sm text-white tracking-tight font-cabinet uppercase&quot;>Impetus</span><span class=&quot;text-[8px] font-semibold text-steel-400 tracking-widest uppercase -mt-0.5&quot;>eLearning Systems</span></div></div>'" alt="Impetus eLearning Solutions" class="h-10 w-auto object-contain">
            </a>

            <!-- Menu Navigation -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#hero" class="text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-amber-500 transition-colors">Platform</a>
                <a href="#sandbox" class="text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-amber-500 transition-colors">Sandbox Simulator</a>
                <a href="#capability" class="text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-amber-500 transition-colors">Competency Index</a>
                <a href="#roi" class="text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-amber-500 transition-colors">ROI Calculator</a>
                <a href="#syllabus" class="text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-amber-500 transition-colors">Curriculums</a>
            </nav>

            <!-- Lead Capture Portal -->
            <div class="flex items-center gap-4">
                <a href="#lead" class="hidden sm:inline-block text-[11px] font-bold uppercase tracking-widest text-steel-300 hover:text-white transition-colors">Login</a>
                <a href="#lead" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest shadow-lg shadow-amber-600/25 transition-all hover:scale-103 active:scale-97">
                    Request Spec
                </a>
            </div>
        </div>
    </header>

    <!-- Asymmetric Split Canvas Hero Section -->
    <section id="hero" class="min-h-screen grid grid-cols-1 lg:grid-cols-12 relative overflow-hidden">
        
        <!-- Left Panel: Dark Steel Canvas (45%) -->
        <div class="lg:col-span-5 bg-steel-950 text-white flex flex-col justify-center px-8 sm:px-12 lg:px-16 pt-32 pb-20 relative border-r border-steel-900">
            <!-- Orange Ambient Light Glow -->
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-amber-600/10 rounded-full blur-[100px] animate-pulse-slow"></div>
            
            <div class="relative z-10">
                <!-- Segment Badge -->
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-1.5 rounded-lg text-[10px] font-bold text-steel-300 uppercase tracking-widest mb-8 font-outfit">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    Ecosystem Option 4: Cinematic
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.05] font-cabinet uppercase mb-6">
                    Building <br>
                    <span class="gradient-text-orange">Intellectual</span> <br>
                    Capability.
                </h1>

                <p class="text-sm sm:text-base text-steel-400 leading-relaxed mb-10 max-w-md font-sans">
                    Impetus completely engineers the corporate learning architecture. We integrate accredited CPD नर्सिंग courseware with secure modular LMS engines to yield absolute auditing assurance and operational index gains.
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <a href="#lead" class="bg-amber-600 hover:bg-amber-700 text-white text-center px-8 py-4 rounded-lg text-xs font-bold uppercase tracking-widest shadow-xl shadow-amber-600/20 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        Initiate Deployment
                    </a>
                    <a href="#sandbox" class="border border-steel-800 hover:border-steel-700 text-steel-300 hover:text-white text-center px-8 py-4 rounded-lg text-xs font-bold uppercase tracking-widest transition-all bg-white/5 backdrop-blur-md">
                        Try Simulator
                    </a>
                </div>

                <!-- Trust Micro Banner -->
                <div class="mt-16 pt-8 border-t border-steel-900">
                    <span class="text-[10px] font-bold text-steel-500 uppercase tracking-widest block mb-4">ENGINEERING COMPLIANCE STANDARDS</span>
                    <div class="flex flex-wrap items-center gap-6 opacity-60">
                        <span class="text-xs font-bold text-steel-300 tracking-wider">CPD BOARD APPROVED</span>
                        <span class="text-xs font-bold text-steel-300 tracking-wider">SCORM/LTI CORE</span>
                        <span class="text-xs font-bold text-steel-300 tracking-wider">ISO 27001</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: Light Cool Steel Canvas (55%) -->
        <div class="lg:col-span-7 bg-steel-100 flex flex-col justify-center px-6 sm:px-12 lg:px-16 pt-32 pb-20 relative">
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-amber-500/5 rounded-full blur-[120px]"></div>

            <div class="max-w-2xl mx-auto w-full relative z-10 animate-float" id="hero-graphic">
                <!-- Overlay Card detailing -->
                <div class="glass-steel-panel text-white p-6 rounded-3xl shadow-2xl relative border border-white/10 overflow-hidden mb-6">
                    <!-- Title Bar -->
                    <div class="flex items-center justify-between border-b border-steel-800 pb-4 mb-6 text-xs text-steel-400">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-500"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        </div>
                        <span class="font-cabinet font-extrabold uppercase tracking-widest text-[9px] text-amber-500">IMPETUS DECISION TERMINAL</span>
                    </div>

                    <!-- Sandbox Preview details -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-steel-950 p-4 rounded-xl border border-steel-800">
                            <span class="text-[9px] font-bold text-steel-500 uppercase tracking-widest block">AUDIT COMPLIANCE RATE</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="text-2xl font-bold text-white font-outfit">100.0%</span>
                                <span class="text-[10px] font-bold text-amber-500 font-sans">&uarr; Absolute</span>
                            </div>
                            <div class="w-full bg-steel-900 h-1 rounded-full mt-3 overflow-hidden">
                                <div class="bg-amber-600 h-full rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="bg-steel-950 p-4 rounded-xl border border-steel-800">
                            <span class="text-[9px] font-bold text-steel-500 uppercase tracking-widest block">SKILLS IMPROVEMENT INDEX</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="text-2xl font-bold text-white font-outfit">+44.8%</span>
                                <span class="text-[10px] font-bold text-steel-400 font-sans">&uarr; Tested</span>
                            </div>
                            <div class="w-full bg-steel-900 h-1 rounded-full mt-3 overflow-hidden">
                                <div class="bg-amber-500 h-full rounded-full animate-pulse" style="width: 88%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-steel-950 p-5 rounded-2xl border border-steel-800 relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold text-steel-400 font-outfit uppercase tracking-widest">CAPABILITY OVERVIEW LIFT</span>
                            <span class="text-[9px] bg-amber-600/20 text-amber-500 px-2 py-0.5 rounded font-bold uppercase">Active Index</span>
                        </div>
                        <!-- Beautiful dynamic steel grid simulation -->
                        <div class="h-28 w-full flex items-end justify-between gap-1 pt-6 px-2">
                            <div class="bg-steel-800 hover:bg-amber-600 w-full transition-all duration-300" style="height: 35%"></div>
                            <div class="bg-steel-800 hover:bg-amber-600 w-full transition-all duration-300" style="height: 52%"></div>
                            <div class="bg-steel-800 hover:bg-amber-600 w-full transition-all duration-300" style="height: 48%"></div>
                            <div class="bg-steel-800 hover:bg-amber-600 w-full transition-all duration-300" style="height: 70%"></div>
                            <div class="bg-amber-600 w-full animate-pulse" style="height: 94%"></div>
                        </div>
                    </div>
                </div>

                <!-- HUD Notification overlap -->
                <div class="bg-white border border-steel-200 p-4 rounded-2xl shadow-xl flex items-center justify-between gap-4 max-w-md ml-auto translate-x-4 lg:translate-x-8 -translate-y-2 border-l-4 border-l-amber-600">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center font-bold font-cabinet">
                            !
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-steel-900 tracking-wide">Accreditation Audit Successful</h4>
                            <p class="text-[10px] text-steel-500">2,400+ clinical compliance points automatically logged.</p>
                        </div>
                    </div>
                    <span class="text-[9px] font-bold bg-steel-100 text-steel-700 px-2 py-1 rounded">CPD-102</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Stats Divider -->
    <section class="bg-steel-900 text-white py-12 border-y border-steel-850 relative z-20 shadow-xl">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-steel-800">
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl lg:text-5xl font-extrabold text-amber-500 font-cabinet block">99.1%</span>
                    <span class="text-[10px] font-bold text-steel-400 uppercase tracking-widest mt-2 block font-outfit">Syllabus Ingestion Rate</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl lg:text-5xl font-extrabold text-white font-cabinet block">4.92/5</span>
                    <span class="text-[10px] font-bold text-steel-400 uppercase tracking-widest mt-2 block font-outfit">Nursing Satisfaction Index</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl lg:text-5xl font-extrabold text-amber-500 font-cabinet block">3.1M+</span>
                    <span class="text-[10px] font-bold text-steel-400 uppercase tracking-widest mt-2 block font-outfit">Proctored Hours Executed</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl lg:text-5xl font-extrabold text-white font-cabinet block">100%</span>
                    <span class="text-[10px] font-bold text-steel-400 uppercase tracking-widest mt-2 block font-outfit">Accreditation Board Assurance</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Sandbox CNE/LMS Simulator Widget Section -->
    <section id="sandbox" class="py-24" x-data="{ sandboxTab: 'slides' }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Live Product Sandbox</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-steel-900 tracking-tight font-cabinet uppercase">Interact With The Impetus Engine</h2>
                <p class="mt-4 text-steel-600 text-sm">Experience the core platform interfaces directly. Click the tabs below to test active slideshows, structured practice exams, or rolling audit trails.</p>
            </div>

            <!-- Terminal/Browser Wrapper -->
            <div class="bg-steel-950 border border-steel-800 rounded-3xl overflow-hidden shadow-2xl max-w-4xl mx-auto">
                <!-- Browser Header tabs -->
                <div class="bg-steel-900 px-6 py-4 flex flex-wrap items-center justify-between border-b border-steel-850 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-steel-700"></span>
                        <span class="w-3 h-3 rounded-full bg-steel-700"></span>
                        <span class="w-3 h-3 rounded-full bg-steel-700"></span>
                        <span class="text-[11px] font-bold text-steel-400 tracking-wider uppercase ml-4 font-cabinet">Simulator URL: localhost:3000/sandbox-demo</span>
                    </div>

                    <!-- Alpine Tab Controls -->
                    <div class="flex items-center bg-steel-950 rounded-lg p-1 border border-steel-800">
                        <button @click="sandboxTab = 'slides'" :class="sandboxTab === 'slides' ? 'bg-amber-600 text-white' : 'text-steel-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all" id="btn-tab-slides">
                            1. Active Slide
                        </button>
                        <button @click="sandboxTab = 'quiz'" :class="sandboxTab === 'quiz' ? 'bg-amber-600 text-white' : 'text-steel-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all" id="btn-tab-quiz">
                            2. Interactive Quiz
                        </button>
                        <button @click="sandboxTab = 'terminal'" :class="sandboxTab === 'terminal' ? 'bg-amber-600 text-white' : 'text-steel-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all" id="btn-tab-terminal">
                            3. Audit Terminal
                        </button>
                    </div>
                </div>

                <!-- Simulation Body -->
                <div class="p-8 sm:p-12 text-white min-h-[380px] flex flex-col justify-between">
                    
                    <!-- Tab 1: Slides Simulator -->
                    <div x-show="sandboxTab === 'slides'" x-transition class="space-y-6" x-data="{ currentSlide: 1 }">
                        <div class="flex items-center justify-between border-b border-steel-850 pb-4">
                            <div>
                                <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block font-outfit">ACTIVE CNE LESSON</span>
                                <h3 class="text-lg font-bold font-cabinet uppercase">Critical ICU Oncology Infusion Protocols</h3>
                            </div>
                            <span class="text-xs bg-steel-900 border border-steel-800 px-3 py-1 rounded-full font-bold" x-text="'Slide ' + currentSlide + ' of 3'"></span>
                        </div>

                        <!-- Dynamic slide content panel -->
                        <div class="bg-steel-900 p-6 rounded-2xl border border-steel-850 min-h-[160px] flex flex-col justify-center">
                            <div x-show="currentSlide === 1" x-transition>
                                <h4 class="font-bold text-sm text-white mb-2 uppercase tracking-wide">1.0 Oncology Infusion Introduction</h4>
                                <p class="text-xs text-steel-400 leading-relaxed">Nurse administration pathways require double-signature confirmation before oncology compound infusion. Critical care guidelines state absolute checking boundaries inside the oncology pharmacy module.</p>
                            </div>
                            <div x-show="currentSlide === 2" x-transition style="display: none;">
                                <h4 class="font-bold text-sm text-white mb-2 uppercase tracking-wide">2.0 Multi-Tier Checkpoints</h4>
                                <p class="text-xs text-steel-400 leading-relaxed">Prior to injection, confirm lines using double vascular imaging check. Compare digital CNE charts with state council protocol specifications to secure point logging.</p>
                            </div>
                            <div x-show="currentSlide === 3" x-transition style="display: none;">
                                <h4 class="font-bold text-sm text-white mb-2 uppercase tracking-wide">3.0 Dynamic Audit Signature</h4>
                                <p class="text-xs text-steel-400 leading-relaxed">Once confirmed, the Impetus audit engine records xAPI logs instantly. Digital signatures are timestamped and queued to state licensing databases for seamless CPD updates.</p>
                            </div>
                        </div>

                        <!-- Slide Navigation -->
                        <div class="flex justify-between items-center pt-4">
                            <button @click="currentSlide > 1 ? currentSlide-- : null" :disabled="currentSlide === 1" :class="currentSlide === 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-steel-800 hover:text-white'" class="bg-steel-900 border border-steel-850 text-steel-300 px-5 py-2.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                                Prev Slide
                            </button>
                            <button @click="currentSlide < 3 ? currentSlide++ : null" :disabled="currentSlide === 3" :class="currentSlide === 3 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-amber-600 hover:text-white'" class="bg-amber-600 text-white px-5 py-2.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                                Next Slide
                            </button>
                        </div>
                    </div>

                    <!-- Tab 2: Quiz Simulator -->
                    <div x-show="sandboxTab === 'quiz'" x-transition class="space-y-6" x-data="{ selectedAnswer: null, answered: false }">
                        <div class="flex items-center justify-between border-b border-steel-850 pb-4">
                            <div>
                                <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block font-outfit">PRACTICE MODULE EVALUATION</span>
                                <h3 class="text-lg font-bold font-cabinet uppercase">State Council Nursing Protocol MCQ</h3>
                            </div>
                            <span class="text-xs text-steel-400 font-bold uppercase tracking-wider">Level II Audit Question</span>
                        </div>

                        <div class="bg-steel-900 p-6 rounded-2xl border border-steel-850">
                            <p class="text-xs sm:text-sm font-semibold text-white mb-6">What is the mandatory verification timeline requirement for Level II Oncology nurses under state council CPD protocols?</p>
                            
                            <div class="space-y-3">
                                <button @click="if(!answered) selectedAnswer = 'A'" :class="selectedAnswer === 'A' ? 'border-amber-600 bg-amber-600/10 text-white' : 'border-steel-800 bg-steel-950 text-steel-400 hover:border-steel-700'" class="w-full text-left p-4 border rounded-xl text-xs font-semibold transition-all flex items-center justify-between" id="quiz-opt-a">
                                    <span>A) Single verification by a junior nurse within 12 hours of medication delivery.</span>
                                    <span class="w-4 h-4 rounded-full border border-steel-700 flex items-center justify-center text-[10px]" :class="selectedAnswer === 'A' ? 'bg-amber-500 border-amber-500' : ''"></span>
                                </button>
                                <button @click="if(!answered) selectedAnswer = 'B'" :class="selectedAnswer === 'B' ? 'border-amber-600 bg-amber-600/10 text-white' : 'border-steel-800 bg-steel-950 text-steel-400 hover:border-steel-700'" class="w-full text-left p-4 border rounded-xl text-xs font-semibold transition-all flex items-center justify-between" id="quiz-opt-b">
                                    <span>B) Double-signature review by certified Oncology CNE nurses logged in real-time.</span>
                                    <span class="w-4 h-4 rounded-full border border-steel-700 flex items-center justify-center text-[10px]" :class="selectedAnswer === 'B' ? 'bg-amber-500 border-amber-500' : ''"></span>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <span class="text-xs text-steel-400">
                                <span x-show="answered && selectedAnswer === 'B'" class="text-green-500 font-bold uppercase tracking-wider">Correct! Dynamic CNE points added.</span>
                                <span x-show="answered && selectedAnswer === 'A'" class="text-red-500 font-bold uppercase tracking-wider">Incorrect. Review guidelines.</span>
                            </span>
                            <div class="flex gap-4">
                                <button @click="selectedAnswer = null; answered = false;" x-show="answered" class="bg-steel-900 border border-steel-850 text-steel-300 px-5 py-2.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                                    Reset Quiz
                                </button>
                                <button @click="if(selectedAnswer) answered = true" :disabled="!selectedAnswer" :class="!selectedAnswer ? 'opacity-40 cursor-not-allowed' : 'hover:bg-amber-600'" class="bg-amber-600 text-white px-5 py-2.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                                    Submit Answer
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Terminal Simulator -->
                    <div x-show="sandboxTab === 'terminal'" x-transition class="space-y-6">
                        <div class="flex items-center justify-between border-b border-steel-850 pb-4">
                            <div>
                                <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block font-outfit">xAPI ROLLING AUDIT PORTAL</span>
                                <h3 class="text-lg font-bold font-cabinet uppercase">Developer Logs & Interoperability Logs</h3>
                            </div>
                            <span class="text-xs bg-amber-600/20 text-amber-500 px-2 py-0.5 rounded font-bold uppercase font-outfit">Live Stream</span>
                        </div>

                        <!-- Rolling text simulation -->
                        <div class="bg-steel-950 p-5 rounded-2xl border border-steel-850 font-mono text-[10px] text-green-400 space-y-2 h-[180px] overflow-y-auto">
                            <div>[INFO] 2026-05-21 09:05:12 - CNE courseware connection initialized for Ventura Health Center...</div>
                            <div class="text-steel-400">[xAPI] USER: Evelyn Reed (ID: CNE-994109) expanded Slide 3 of Module 4.</div>
                            <div>[SECURE] Secure-Browser exam verification sequence initialized. Checking proctored limits...</div>
                            <div class="text-amber-500">[AUDIT] State council credentials verified. SSO auth: ISO27001-Compliant.</div>
                            <div class="text-white font-bold">[SUCCESS] MCQ Answer submitted. Verification audit log logged to State Database: COMPLETED (45 CNE credits).</div>
                            <div class="animate-pulse text-green-500">&gt; Streaming live metadata records...</div>
                        </div>

                        <div class="text-right">
                            <span class="text-[10px] font-bold text-steel-500 uppercase tracking-widest">SCORM 1.2 / 2004 / xAPI COMPLIANT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Competency Radar Dial -->
    <section id="capability" class="py-24 bg-steel-950 text-white relative border-y border-steel-900" x-data="{ selectedProfile: 'clinical' }">
        <div class="absolute inset-0 bg-radial-gradient(circle_at_center, rgba(234, 88, 12, 0.04) 0%, transparent 60%) pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Details panel -->
                <div class="lg:col-span-5">
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Capability Radar</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-cabinet uppercase mb-6">Competency Lift Index</h2>
                    <p class="text-sm text-steel-400 leading-relaxed mb-8">Click the professional profiles below to visualize the competency index lifts achieved using the Impetus CNE and training software.</p>
                    
                    <div class="flex flex-col gap-3">
                        <button @click="selectedProfile = 'clinical'" :class="selectedProfile === 'clinical' ? 'border-amber-600 bg-amber-600/10 text-white' : 'border-steel-800 bg-steel-900/40 text-steel-400 hover:border-steel-700'" class="w-full text-left px-6 py-4 border rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center justify-between" id="prof-btn-clinical">
                            <span>Frontline Clinical & Nurse CPD</span>
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <button @click="selectedProfile = 'corporate'" :class="selectedProfile === 'corporate' ? 'border-amber-600 bg-amber-600/10 text-white' : 'border-steel-800 bg-steel-900/40 text-steel-400 hover:border-steel-700'" class="w-full text-left px-6 py-4 border rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center justify-between" id="prof-btn-corporate">
                            <span>Strategic Corporate Onboarding</span>
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <button @click="selectedProfile = 'compliance'" :class="selectedProfile === 'compliance' ? 'border-amber-600 bg-amber-600/10 text-white' : 'border-steel-800 bg-steel-900/40 text-steel-400 hover:border-steel-700'" class="w-full text-left px-6 py-4 border rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center justify-between" id="prof-btn-compliance">
                            <span>Information Security & Audits</span>
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Interactive CSS Competency dials -->
                <div class="lg:col-span-7 bg-steel-900 border border-steel-850 p-8 rounded-3xl">
                    <div class="flex items-center justify-between border-b border-steel-850 pb-4 mb-6">
                        <span class="text-[10px] font-bold text-steel-400 uppercase tracking-widest">IMPETUS CAPABILITY METRIC</span>
                        <span class="text-[9px] bg-amber-600 text-white px-2 py-0.5 rounded font-extrabold uppercase" x-text="selectedProfile + ' index'"></span>
                    </div>

                    <div class="space-y-6">
                        <!-- Competency Dial 1 -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-steel-400 mb-2">
                                <span>REGULATORY COMPLIANCE STANDARDS</span>
                                <span class="text-white" x-text="selectedProfile === 'clinical' ? '98.8%' : (selectedProfile === 'corporate' ? '94.2%' : '100%')"></span>
                            </div>
                            <div class="w-full bg-steel-950 h-3 rounded-full border border-steel-800 overflow-hidden">
                                <div class="bg-amber-600 h-full rounded-full transition-all duration-700" :style="selectedProfile === 'clinical' ? 'width: 98.8%' : (selectedProfile === 'corporate' ? 'width: 94.2%' : 'width: 100%')"></div>
                            </div>
                        </div>

                        <!-- Competency Dial 2 -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-steel-400 mb-2">
                                <span>KNOWLEDGE RETENTION RETAINABILITY</span>
                                <span class="text-white" x-text="selectedProfile === 'clinical' ? '91.4%' : (selectedProfile === 'corporate' ? '89.0%' : '84.8%')"></span>
                            </div>
                            <div class="w-full bg-steel-950 h-3 rounded-full border border-steel-800 overflow-hidden">
                                <div class="bg-amber-500 h-full rounded-full transition-all duration-700" :style="selectedProfile === 'clinical' ? 'width: 91.4%' : (selectedProfile === 'corporate' ? 'width: 89.0%' : 'width: 84.8%')"></div>
                            </div>
                        </div>

                        <!-- Competency Dial 3 -->
                        <div>
                            <div class="flex justify-between text-xs font-bold text-steel-400 mb-2">
                                <span>AUDITING REDUNDANCY REDUCTION</span>
                                <span class="text-white" x-text="selectedProfile === 'clinical' ? '70%' : (selectedProfile === 'corporate' ? '82%' : '96%')"></span>
                            </div>
                            <div class="w-full bg-steel-950 h-3 rounded-full border border-steel-800 overflow-hidden">
                                <div class="bg-amber-600 h-full rounded-full transition-all duration-700" :style="selectedProfile === 'clinical' ? 'width: 70%' : (selectedProfile === 'corporate' ? 'width: 82%' : 'width: 96%')"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sandbox output review note -->
                    <div class="mt-8 p-4 bg-steel-950 rounded-xl border border-steel-850 flex items-center justify-between gap-4">
                        <span class="text-[10px] text-steel-500">ISO 27001 System audit credentials confirmed to state CPD registry modules automatically.</span>
                        <a href="#lead" class="text-xs text-amber-500 font-bold hover:underline shrink-0">View Blueprint &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fire & Steel ROI Configurator Section -->
    <section id="roi" class="py-24" x-data="{ studentsCount: 300, hoursValue: 12 }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="bg-steel-900 border border-steel-800 rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-2xl relative overflow-hidden text-white">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-600/10 rounded-full blur-[80px]"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <!-- Configurator Left -->
                    <div class="lg:col-span-6">
                        <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Deployment Optimization</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-cabinet uppercase mb-6">Traditional vs. Impetus ROI</h2>
                        <p class="text-sm text-steel-400 leading-relaxed mb-8">Standard offline compliance lecturing is expensive, slow, and hard to log. Configure your training scale below to instantly review the optimization points calculated by the Impetus architecture.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-xs font-bold text-steel-300">Eliminates physical classroom and lecturer fees</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-xs font-bold text-steel-300">Guarantees instant digital log trails for licensing checks</span>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Slider Board -->
                    <div class="lg:col-span-6 bg-steel-950 border border-steel-800 p-6 sm:p-8 rounded-3xl shadow-xl">
                        <h3 class="text-xs font-cabinet font-extrabold tracking-widest text-center text-steel-400 uppercase mb-8">Dynamic ROI Configurator</h3>

                        <!-- Slider 1 -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between text-[10px] font-bold text-steel-400 mb-2 font-cabinet uppercase">
                                <span>TOTAL ACTIVE COMPLIANCE LEARNERS</span>
                                <span class="text-amber-500 text-sm font-extrabold" x-text="studentsCount"></span>
                            </div>
                            <input type="range" min="10" max="2500" step="10" x-model="studentsCount" class="w-full h-2 bg-steel-800 rounded-lg appearance-none cursor-pointer accent-amber-600">
                        </div>

                        <!-- Slider 2 -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between text-[10px] font-bold text-steel-400 mb-2 font-cabinet uppercase">
                                <span>COMPLIANCE TRAINING MODULES</span>
                                <span class="text-white text-sm font-extrabold" x-text="hoursValue + ' Lessons'"></span>
                            </div>
                            <input type="range" min="4" max="40" step="1" x-model="hoursValue" class="w-full h-2 bg-steel-800 rounded-lg appearance-none cursor-pointer accent-amber-500">
                        </div>

                        <!-- Display grids -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-steel-900 border border-steel-800 p-4 rounded-xl text-center">
                                <span class="text-[9px] font-bold text-steel-500 block uppercase tracking-widest">ANNUAL TRAINING HOURS SAVED</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-white block mt-1 font-outfit" x-text="Math.round(studentsCount * hoursValue * 1.45)"></span>
                            </div>
                            <div class="bg-steel-900 border border-steel-800 p-4 rounded-xl text-center">
                                <span class="text-[9px] font-bold text-steel-500 block uppercase tracking-widest">ESTIMATED REVENUE GAIN LIFT</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-amber-500 block mt-1 font-outfit" x-text="'$' + Math.round(studentsCount * hoursValue * 12.8)"></span>
                            </div>
                        </div>

                        <a href="#lead" class="block w-full text-center mt-6 bg-white hover:bg-steel-100 text-steel-900 py-3.5 rounded-lg text-xs font-bold uppercase tracking-widest transition-all">
                            Get Custom ROI Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Interactive Syllabus Explorer -->
    <section id="syllabus" class="py-24 bg-white border-y border-steel-200/60" x-data="{ activeModule: 1 }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="text-amber-600 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Syllabus catalogs</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-steel-900 tracking-tight font-cabinet uppercase">Explore Accredited Core Syllabuses</h2>
                <p class="mt-4 text-steel-600 text-sm">We provide pre-approved, highly certified training content modules that can be custom loaded directly to your Impetus LMS catalog.</p>
            </div>

            <!-- Horizontal pipeline selector -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button @click="activeModule = 1" :class="activeModule === 1 ? 'bg-amber-600 text-white shadow-lg' : 'bg-steel-100 text-steel-600 hover:bg-steel-200'" class="px-6 py-3.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2" id="syl-btn-oncology">
                    Module 1: Oncology & Chemotherapy
                </button>
                <button @click="activeModule = 2" :class="activeModule === 2 ? 'bg-amber-600 text-white shadow-lg' : 'bg-steel-100 text-steel-600 hover:bg-steel-200'" class="px-6 py-3.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2" id="syl-btn-icu">
                    Module 2: ICU & Triage Checklists
                </button>
                <button @click="activeModule = 3" :class="activeModule === 3 ? 'bg-amber-600 text-white shadow-lg' : 'bg-steel-100 text-steel-600 hover:bg-steel-200'" class="px-6 py-3.5 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2" id="syl-btn-sec">
                    Module 3: Information Security Audit
                </button>
            </div>

            <!-- Display content -->
            <div class="bg-steel-50 border border-steel-200 p-8 sm:p-12 rounded-3xl shadow-xl max-w-4xl mx-auto">
                <!-- Module 1 details -->
                <div x-show="activeModule === 1" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-xl font-bold text-steel-900 font-cabinet uppercase mb-4">Critical Care Oncology &amp; Chemotherapy</h3>
                        <p class="text-xs sm:text-sm text-steel-600 leading-relaxed mb-6">Designed under direct CNE board oversight. We provide full nurse training covering double-signoff drug administration, secure vascular lines checks, and emergency oncology triage methods.</p>
                        
                        <ul class="space-y-3.5 mb-8 text-xs font-semibold text-steel-700">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>6,000+ interactive practice question rationales</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Pre-mapped directly to regional nursing boards</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>45 CNE points registered to final digital certificate</span>
                            </li>
                        </ul>

                        <a href="#lead" class="inline-flex items-center gap-2 bg-steel-900 hover:bg-steel-800 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                            Request Syllabus Copy
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-steel-200">
                            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80" alt="Oncology training demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-steel-950/90 text-white p-3 rounded-xl border border-white/10 text-[10px] font-bold font-cabinet">
                                45 CPD CREDITS ACCREDITED
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 2 details -->
                <div x-show="activeModule === 2" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center" style="display: none;">
                    <div>
                        <h3 class="text-xl font-bold text-steel-900 font-cabinet uppercase mb-4">Intensive Care &amp; Emergency Triage checklists</h3>
                        <p class="text-xs sm:text-sm text-steel-600 leading-relaxed mb-6">Equip frontline nurses with critical triage decision trees. Impetus clinical simulations structure modular pathways covering elderly ICU checks, trauma scales, and cardiovascular triage limits.</p>
                        
                        <ul class="space-y-3.5 mb-8 text-xs font-semibold text-steel-700">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Real-time practice checkpoints with prompt scoring</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Fully secure LTI SCORM-compatible infrastructure</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>35 CNE points registered to final digital certificate</span>
                            </li>
                        </ul>

                        <a href="#lead" class="inline-flex items-center gap-2 bg-steel-900 hover:bg-steel-800 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                            Request Syllabus Copy
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-steel-200">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" alt="ICU training demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-steel-950/90 text-white p-3 rounded-xl border border-white/10 text-[10px] font-bold font-cabinet">
                                35 CPD CREDITS ACCREDITED
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 3 details -->
                <div x-show="activeModule === 3" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center" style="display: none;">
                    <div>
                        <h3 class="text-xl font-bold text-steel-900 font-cabinet uppercase mb-4">Information Security &amp; ISO Auditing Compliance</h3>
                        <p class="text-xs sm:text-sm text-steel-600 leading-relaxed mb-6">Perfect for corporate onboarding. Train staff on clinical HIPAA constraints, data privacy logs, ISO 27001 regulatory audits, and corporate strategic onboarding practices.</p>
                        
                        <ul class="space-y-3.5 mb-8 text-xs font-semibold text-steel-700">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Interactive security phish drills built-in</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Auditing logs output ready to present directly</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                <span>Custom strategic department capability metrics</span>
                            </li>
                        </ul>

                        <a href="#lead" class="inline-flex items-center gap-2 bg-steel-900 hover:bg-steel-800 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all">
                            Request Syllabus Copy
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-steel-200">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="InfoSec training demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-steel-950/90 text-white p-3 rounded-xl border border-white/10 text-[10px] font-bold font-cabinet">
                                CORPORATE COMPLIANCE CERTIFICATION
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Testimonials Block -->
    <section class="py-24 bg-steel-900 text-white relative">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Enterprise Endorsements</span>
                <h2 class="text-3xl font-extrabold tracking-tight font-cabinet uppercase text-white">Client Success Blueprints</h2>
            </div>

            <!-- Overlapping grid quote -->
            <div class="max-w-4xl mx-auto bg-steel-950 border border-steel-850 p-8 sm:p-12 rounded-[2rem] shadow-2xl relative">
                <!-- Large Orange Quotes indicator background -->
                <div class="absolute top-6 left-6 text-amber-600/10 font-cabinet font-extrabold text-[8rem] leading-none pointer-events-none select-none">
                    “
                </div>
                
                <blockquote class="text-lg sm:text-xl md:text-2xl font-semibold leading-relaxed text-steel-200 relative z-10 mb-8 font-sans">
                    "Impetus eLearning Solutions completely optimized our corporate continuing nursing education setup. The custom proctoring portal and automated capability indexing gave our auditing board full regulatory confidence within three months."
                </blockquote>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-amber-600 flex items-center justify-center font-bold text-white font-cabinet uppercase">
                        rs
                    </div>
                    <div>
                        <cite class="text-xs font-bold text-white uppercase tracking-widest not-italic block">Director Robert Sterling</cite>
                        <p class="text-[10px] text-steel-500 font-semibold uppercase tracking-wider mt-0.5">Chief of Clinical Operations, Sterling Medical Center</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lead Capture Form Panel -->
    <section id="lead" class="py-24 bg-steel-950 text-white border-t border-steel-900 relative">
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">LMS CAPABILITY DESK</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-cabinet uppercase mb-6 text-white">Initiate a Strategic Evaluation</h2>
            <p class="text-sm text-steel-400 leading-relaxed max-w-xl mx-auto mb-12">Submit your organization's learning parameters below. An Impetus eLearning Architect will configure a custom capability blueprint for your team evaluation.</p>

            <form onsubmit="event.preventDefault(); alert('Your custom deployment blueprint specification request was submitted successfully.');" class="text-left bg-steel-900 p-8 sm:p-12 border border-steel-800 shadow-2xl max-w-2xl mx-auto rounded-3xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-steel-400 uppercase tracking-widest mb-2 font-cabinet">Representative Name</label>
                        <input type="text" required class="w-full bg-steel-950 border border-steel-800 rounded-lg focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white" placeholder="Dr. Evelyn Reed">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-steel-400 uppercase tracking-widest mb-2 font-cabinet">Official Email Address</label>
                        <input type="email" required class="w-full bg-steel-950 border border-steel-800 rounded-lg focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white" placeholder="evelyn@sterlingmedical.org">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-steel-400 uppercase tracking-widest mb-2 font-cabinet">Target Core Goal</label>
                    <select class="w-full bg-steel-950 border border-steel-800 rounded-lg focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-slate-300 appearance-none">
                        <option>Accredited Continuing Nursing Education (CNE)</option>
                        <option>Corporate Onboarding Compliance &amp; Auditing</option>
                        <option>Higher Education SCORM / LTI Custom LMS Platforms</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-bold text-steel-400 uppercase tracking-widest mb-2 font-cabinet">Brief Summary of Challenges</label>
                    <textarea class="w-full bg-steel-950 border border-steel-800 rounded-lg focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white h-28 resize-none" placeholder="Detail your auditing, licensing, or user scale parameters..."></textarea>
                </div>

                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-4 rounded-xl text-xs font-extrabold uppercase tracking-widest transition-all">
                    Request Integration Analysis
                </button>
            </form>
        </div>
    </section>

    <!-- Minimal High-Contrast Footer -->
    <footer class="bg-steel-950 border-t border-steel-900 py-16 text-steel-500 text-xs">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=&quot;flex items-center gap-2.5&quot;><div class=&quot;w-8 h-8 rounded-lg bg-amber-600 flex items-center justify-center text-white font-extrabold text-sm font-cabinet&quot;>i</div><span class=&quot;font-bold text-white text-sm uppercase tracking-widest font-cabinet&quot;>Impetus</span></div>'" alt="Impetus eLearning Solutions" class="h-10 w-auto object-contain">
                    </div>
                    <p class="text-[10px] text-steel-500 leading-relaxed">Accredited and compliant continuing professional education platforms engineered to maximize operational capacity.</p>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">Core Catalog</h4>
                    <ul class="space-y-2 text-[10px] font-semibold">
                        <li><a href="#syllabus" class="hover:text-amber-500 transition-colors">Module 1: Oncology CPD</a></li>
                        <li><a href="#syllabus" class="hover:text-amber-500 transition-colors">Module 2: Emergency Triage</a></li>
                        <li><a href="#syllabus" class="hover:text-amber-500 transition-colors">Module 3: InfoSec Auditing</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">Platform Engine</h4>
                    <ul class="space-y-2 text-[10px] font-semibold">
                        <li><a href="#sandbox" class="hover:text-amber-500 transition-colors">Slideshow Sandbox</a></li>
                        <li><a href="#sandbox" class="hover:text-amber-500 transition-colors">Proctored Exams Simulator</a></li>
                        <li><a href="#roi" class="hover:text-amber-500 transition-colors">ROI Calculator</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">System Inquiries</h4>
                    <ul class="space-y-2 text-[10px] text-steel-300 font-bold">
                        <li>General Desk: architect@impetus-elearning.com</li>
                        <li>Technical Desk: support@impetus-elearning.com</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-steel-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-[9px] text-steel-500 font-semibold">
                <span>&copy; 2026 Impetus eLearning Solutions. All rights reserved.</span>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Infrastructure</a>
                    <a href="#" class="hover:text-white transition-colors">SCORM Compliance Standards</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
