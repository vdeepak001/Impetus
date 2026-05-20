<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impetus eLearning Solutions | Premium Enterprise & CPD Learning Systems</title>
    
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN for bulletproof styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        impetus: {
                            orange: '#FF6B00',
                            orangeHover: '#E05E00',
                            orangeLight: '#FFF5F0',
                            dark: '#0B0C10',
                            darkCard: '#13141B',
                            darkBorder: '#22232B',
                            slateGray: '#475569',
                            lightGray: '#F1F5F9',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out infinite 3s',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .gradient-text-orange-gray {
            background: linear-gradient(135deg, #FF6B00 0%, #A1A1AA 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg-hero {
            background: radial-gradient(circle at 15% 20%, rgba(255, 107, 0, 0.08) 0%, transparent 45%),
                        radial-gradient(circle at 85% 75%, rgba(71, 85, 105, 0.08) 0%, transparent 45%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .glass-card-dark {
            background: rgba(19, 20, 27, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .custom-shadow {
            box-shadow: 0 20px 40px -15px rgba(11, 12, 16, 0.1);
        }
        .custom-shadow-orange {
            box-shadow: 0 20px 45px -15px rgba(255, 107, 0, 0.2);
        }
        .glow-orange:hover {
            box-shadow: 0 10px 30px -5px rgba(255, 107, 0, 0.45);
        }
        .glow-gray:hover {
            box-shadow: 0 10px 30px -5px rgba(71, 85, 105, 0.2);
        }
        /* Custom range slider styling */
        input[type="range"]::-webkit-slider-thumb {
            background: #FF6B00;
            border: 2px solid #FFFFFF;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
        }
        input[type="range"]::-moz-range-thumb {
            background: #FF6B00;
            border: 2px solid #FFFFFF;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
        }
    </style>
</head>
<body class="bg-[#F9FAFB] text-slate-800 antialiased font-sans gradient-bg-hero">

    <!-- Top Announcement Bar -->
    <!-- <div class="bg-impetus-dark border-b border-impetus-darkBorder text-slate-300 py-2.5 px-4 text-xs font-semibold text-center tracking-wider">
        <span class="inline-flex items-center gap-1.5 text-slate-400">
            <span class="w-1.5 h-1.5 rounded-full bg-impetus-orange animate-ping"></span>
            NEW DESIGN OPTION
        </span>
        &bull; Executive Grade eLearning &amp; Accredited CPD Learning Management Systems
    </div> -->

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 w-full transition-all duration-300 glass-card border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=flex\\ items-center\\ gap-2.5><div class=\\w-10\\ h-10\\ rounded-full\\ bg-impetus-orange\\ flex\\ items-center\\ justify-center\\ text-white\\ font-extrabold\\ text-xl\\ shadow-md\\ shadow-impetus-orange/20\\ font-outfit\\>i</div><div class=flex\\ flex-col><span class=\\font-extrabold\\ text-xl\\ text-impetus-dark\\ leading-tight\\ font-outfit\\>Impetus</span><span class=\\text-[10px]\\ font-semibold\\ text-impetus-slateGray\\ tracking-wider\\ uppercase\\ -mt-0.5\\>eLearning Solutions</span></div></div>'" alt="Impetus eLearning Solutions" class="h-12 w-auto object-contain">
                    </div>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Home</a>
                    <a href="#solutions" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Solutions</a>
                    <a href="#features" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Platform Features</a>
                    <a href="#calculator" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">ROI Calculator</a>
                    <a href="#testimonials" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Client Success</a>
                </nav>

                <!-- Actions -->
                <div class="hidden sm:flex items-center space-x-4">
                    <a href="#contact" class="text-sm font-bold text-slate-700 hover:text-impetus-orange transition-colors">Sign In</a>
                    <a href="#contact" class="bg-impetus-orange hover:bg-impetus-orangeHover text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-impetus-orange/20 transition-all hover:scale-102 hover:shadow-xl hover:shadow-impetus-orange/30 font-outfit glow-orange">
                        Request Demo
                    </a>
                </div>

                <!-- Mobile Menu Button (AlpineJS toggle) -->
                <div class="flex md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="text-slate-700 hover:text-impetus-orange focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                        </svg>
                    </button>
                    <!-- Mobile Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition class="absolute top-20 left-0 w-full bg-white border-b border-slate-200 shadow-xl p-6 flex flex-col space-y-4 md:hidden">
                        <a @click="open = false" href="#home" class="text-base font-medium text-slate-800 hover:text-impetus-orange">Home</a>
                        <a @click="open = false" href="#solutions" class="text-base font-medium text-slate-800 hover:text-impetus-orange">Solutions</a>
                        <a @click="open = false" href="#features" class="text-base font-medium text-slate-800 hover:text-impetus-orange">Platform Features</a>
                        <a @click="open = false" href="#calculator" class="text-base font-medium text-slate-800 hover:text-impetus-orange">ROI Calculator</a>
                        <a @click="open = false" href="#testimonials" class="text-base font-medium text-slate-800 hover:text-impetus-orange">Client Success</a>
                        <div class="pt-4 border-t border-slate-100 flex flex-col gap-3">
                            <a href="#contact" class="text-center py-2.5 font-bold text-slate-700 hover:text-impetus-orange">Sign In</a>
                            <a href="#contact" class="text-center bg-impetus-orange text-white py-2.5 rounded-full font-bold shadow-lg">Request Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="pt-8 pb-20 md:py-28 bg-impetus-dark text-white relative overflow-hidden">
        <!-- Orange Glow Effects -->
        <div class="absolute top-[-10%] left-[-10%] w-[45%] h-[45%] rounded-full bg-impetus-orange/15 blur-[120px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[45%] h-[45%] rounded-full bg-slate-500/10 blur-[120px] animate-pulse-slow" style="animation-delay: 3s;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left text content -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <!-- Brand Badge -->
                    <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-1.5 rounded-full text-xs font-bold text-slate-300 uppercase tracking-wider mb-6 font-outfit">
                        <span class="w-2 h-2 rounded-full bg-impetus-orange animate-pulse"></span>
                        Capability Intelligence Systems
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1] font-outfit">
                        Enterprise Learning <br>
                        <span class="gradient-text-orange-gray">Engineered for Impact.</span>
                    </h1>
                    
                    <p class="mt-6 text-lg text-slate-400 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Impetus provides custom corporate learning ecosystems, accredited professional courseware, and next-generation LMS tools designed to optimize retention, track audit compliance, and build institutional strength.
                    </p>

                    <!-- CTAs -->
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6">
                        <a href="#contact" class="w-full sm:w-auto text-center bg-impetus-orange hover:bg-impetus-orangeHover text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-impetus-orange/20 transition-all hover:-translate-y-0.5 hover:shadow-2xl hover:shadow-impetus-orange/30 font-outfit glow-orange">
                            Schedule A Call
                        </a>
                        <a href="#solutions" class="w-full sm:w-auto text-center bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-slate-300 hover:text-white px-8 py-4 rounded-full font-bold transition-all hover:-translate-y-0.5 shadow-sm hover:shadow-md font-outfit backdrop-blur-sm">
                            Explore Solutions
                        </a>
                    </div>

                    <!-- Trust Accreditations Microbar -->
                    <div class="mt-12 pt-8 border-t border-white/5 text-left max-w-lg mx-auto lg:mx-0">
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-4 text-center lg:text-left">Accredited & Compliant Enterprise Grade</span>
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-x-8 gap-y-4 opacity-80">
                            <span class="font-outfit font-extrabold text-xs text-slate-400 tracking-widest">CPD REGISTERED</span>
                            <span class="font-outfit font-extrabold text-xs text-slate-400 tracking-widest">SCORM / XAPI</span>
                            <span class="font-outfit font-extrabold text-xs text-slate-400 tracking-widest">ISO 27001 SECURE</span>
                        </div>
                    </div>
                </div>

                <!-- Right Dashboard Showcase Graphic -->
                <div class="lg:col-span-5 relative mt-8 lg:mt-0">
                    <div class="absolute inset-0 bg-gradient-to-tr from-impetus-orange/10 to-slate-500/10 rounded-3xl blur-[60px] -z-10"></div>
                    
                    <!-- Main visual panel -->
                    <div class="relative glass-card-dark border border-white/10 rounded-3xl p-6 sm:p-8 custom-shadow-orange animate-float">
                        <!-- Upper frame detail -->
                        <div class="flex items-center justify-between mb-6 border-b border-white/5 pb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-700 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-600 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-impetus-orange inline-block"></span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-500 font-outfit uppercase tracking-widest">impetus-lms-v4.0</span>
                        </div>

                        <!-- Micro Learning Analytics Widget -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Course Completion</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-bold text-white font-outfit">96.4%</span>
                                    <span class="text-xs font-bold text-impetus-orange flex items-center">&uarr; 4.1%</span>
                                </div>
                                <div class="w-full bg-slate-800 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-impetus-orange h-full rounded-full animate-pulse" style="width: 96%"></div>
                                </div>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Skill Index Score</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-bold text-white font-outfit">92 / 100</span>
                                    <span class="text-xs font-bold text-slate-400 flex items-center">&uarr; 8%</span>
                                </div>
                                <div class="w-full bg-slate-800 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-slate-500 h-full rounded-full" style="width: 92%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Live Graph Widget -->
                        <div class="bg-white/5 p-5 rounded-2xl border border-white/5 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold text-slate-400 font-outfit uppercase tracking-wider">Intellectual Capability Curve</span>
                                <span class="text-[9px] bg-impetus-orange/15 text-impetus-orange px-2 py-0.5 rounded font-bold">SYSTEM ACTIVE</span>
                            </div>
                            <!-- Mock Graph SVGs -->
                            <div class="relative h-28 w-full flex items-end">
                                <svg class="w-full h-full text-impetus-orange" viewBox="0 0 100 30" preserveAspectRatio="none">
                                    <path d="M0,25 Q15,8 30,20 T60,6 T90,2 T100,4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"></path>
                                    <path d="M0,25 Q15,8 30,20 T60,6 T90,2 T100,4 L100,30 L0,30 Z" fill="url(#grad)" opacity="0.1"></path>
                                    <defs>
                                        <linearGradient id="grad" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#FF6B00" />
                                            <stop offset="100%" stop-color="transparent" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>

                        <!-- Adaptive HUD floating card -->
                        <div class="flex items-center gap-3 bg-[#1D1E26] text-white p-4 rounded-2xl border border-white/5 shadow-2xl">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-extrabold text-impetus-orange font-outfit shadow-md">i</div>
                            <div>
                                <h4 class="text-xs font-bold tracking-wide">Impetus Intelligent Tutor</h4>
                                <p class="text-[10px] text-slate-400">Ready to optimize professional capabilities.</p>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full bg-impetus-orange ml-auto animate-ping"></span>
                        </div>
                    </div>

                    <!-- Ambient glowing backgrounds -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-impetus-orange/20 rounded-full blur-2xl animate-pulse-slow"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-slate-500/10 rounded-full blur-2xl animate-pulse-slow" style="animation-delay: 2s"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="py-12 bg-white border-y border-slate-200/60 shadow-sm relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-dark font-outfit block">98.2%</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1.5 block">Course Completion Rate</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-orange font-outfit block">4.95/5</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1.5 block">User Satisfaction Rating</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-dark font-outfit block">2.6M+</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1.5 block">Learning Hours Cataloged</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-orange font-outfit block">100%</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1.5 block">Accredited Core Syllabus</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Section with Tabs -->
    <section id="solutions" class="py-24" x-data="{ tab: 'healthcare' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3">Enterprise Verticals</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-dark tracking-tight font-outfit">Syllabus Frameworks Made to Scale</p>
                <p class="mt-4 text-slate-600">Select your vertical below to explore how Impetus aligns with your operational metrics, training workflows, and compliance standards.</p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button @click="tab = 'healthcare'" :class="tab === 'healthcare' ? 'bg-impetus-orange text-white shadow-lg shadow-impetus-orange/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Clinical &amp; Nursing CPD
                </button>
                <button @click="tab = 'corporate'" :class="tab === 'corporate' ? 'bg-impetus-orange text-white shadow-lg shadow-impetus-orange/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Corporate &amp; Compliance
                </button>
                <button @click="tab = 'edu'" :class="tab === 'edu' ? 'bg-impetus-orange text-white shadow-lg shadow-impetus-orange/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    Higher Academics
                </button>
            </div>

            <!-- Tab Content: Healthcare -->
            <div x-show="tab === 'healthcare'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-dark font-outfit mb-4">Accredited Continuing Nursing Education (CNE)</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Secure clinical excellence and maintain regulatory standing across your nursing departments. Impetus courseware delivers rigorous education modules in emergency triage, oncology protocols, ICU checklists, and intensive care nursing, mapped directly to regional licensing boards.</p>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">6,000+ Peer-Reviewed Medical MCQs with rationales</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Structured certifications for Level I, II, &amp; III clinicians</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Fully secure, browser-proctored modular testing hubs</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit glow-gray">
                        Explore Nursing Catalog
                        <svg class="w-4 h-4 text-impetus-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200/50">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80" alt="Clinical Education" class="w-full h-80 sm:h-96 object-cover hover:scale-102 transition-transform duration-500">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold">Featured CPD Program</span>
                                <h4 class="font-bold text-slate-900 text-sm">Critical Oncology Protocols</h4>
                            </div>
                            <span class="bg-impetus-dark text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">45 CPD Points</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Corporate -->
            <div x-show="tab === 'corporate'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="display: none;">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-dark font-outfit mb-4">Enterprise Capability &amp; Audit Frameworks</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Turn standard corporate onboarding and compliance training into an elite engine for team capability. Standardize your organizational information security audits, regulatory updates, executive leadership, and customer success models.</p>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Custom dynamic pathways tailored by corporate role</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Real-time audit log generation &amp; SSO security integration</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Interactive gamified departments capability scoreboard</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit glow-gray">
                        Explore Corporate Solutions
                        <svg class="w-4 h-4 text-impetus-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200/50">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" alt="Corporate Training" class="w-full h-80 sm:h-96 object-cover hover:scale-102 transition-transform duration-500">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold">Regulatory Audit</span>
                                <h4 class="font-bold text-slate-900 text-sm">Strategic Compliance &amp; Ethics</h4>
                            </div>
                            <span class="bg-impetus-orange text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">10 Modules</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Academics -->
            <div x-show="tab === 'edu'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="display: none;">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-dark font-outfit mb-4">Scalable Higher Education Digital Classrooms</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Provide secondary and tertiary campuses with modern, interactive digital pedagogy environments. Link online live learning pathways, custom grading schemes, LTI-compatible textbooks, and proctored examinations smoothly.</p>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">LTI &amp; SCORM 1.2/2004/xAPI technical alignment</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Custom automated report generator for education boards</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-impetus-orangeLight text-impetus-orange flex items-center justify-center font-bold text-xs mt-0.5">&bull;</span>
                            <span class="font-semibold text-slate-700">Zoom, Microsoft Teams, and secure digital file libraries</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit glow-gray">
                        Explore Academic Systems
                        <svg class="w-4 h-4 text-impetus-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200/50">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Academic Environment" class="w-full h-80 sm:h-96 object-cover hover:scale-102 transition-transform duration-500">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold">LTI Ecosystem</span>
                                <h4 class="font-bold text-slate-900 text-sm">Blended Learning Architecture</h4>
                            </div>
                            <span class="bg-impetus-dark text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">SCORM 2004</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Features Grid -->
    <section id="features" class="py-24 bg-white/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest font-outfit mb-3">Enterprise LMS Engine</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-dark tracking-tight font-outfit">High-End Architecture. Engineered Simply.</p>
                <p class="mt-4 text-slate-600">Discover the specialized modules built to transition standard corporate guides into highly engaging, certified learning paths.</p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-12">
                <!-- Feature 1 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:bg-white hover:border-slate-300 group">
                    <div class="w-12 h-12 bg-impetus-orangeLight text-impetus-orange rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-105 duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-dark font-outfit mb-3">Rich Multimedia Courseware</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Convert dry, passive files into engaging slideshows with modular custom check-ins, interactive scenario scripts, and smart inline logic.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:bg-white hover:border-slate-300 group">
                    <div class="w-12 h-12 bg-slate-100 text-slate-700 rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-105 duration-300">
                        <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-dark font-outfit mb-3">Adaptive Examination Suites</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Structure exams mapped to 3 academic tiers. Benefit from secure proctoring capabilities, IP restriction modules, and instant grading analytics.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:bg-white hover:border-slate-300 group">
                    <div class="w-12 h-12 bg-impetus-orangeLight text-impetus-orange rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-105 duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-dark font-outfit mb-3">Organizational Capability Mapping</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Measure individual competencies and institutional strength. Render real-time progress index charts to evaluate training ROI instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive ROI Calculator Widget Section -->
    <section id="calculator" class="py-24 relative overflow-hidden" x-data="{ learners: 400, rate: 85 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-impetus-dark text-white rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-2xl relative overflow-hidden border border-white/5">
                <!-- Glowing Gradients inside calculator panel -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-impetus-orange/20 rounded-full blur-[80px]"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-slate-500/10 rounded-full blur-[80px]"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <div class="lg:col-span-6">
                        <span class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3 block">Deployment Metrics</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-outfit mb-6">Quantify the Impact on Your Staff</h2>
                        <p class="text-slate-400 leading-relaxed mb-6">Estimate training optimization, hours saved, and institutional intellectual capability boosts instantly by adjusting the parameters below.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-impetus-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-slate-300">Eliminates high-cost, offline classroom setups</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-impetus-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-slate-300">Creates clean, automated records for external audits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Calculator Mockup Card -->
                    <div class="lg:col-span-6 bg-[#16171E] rounded-3xl p-6 sm:p-8 border border-white/5 relative shadow-2xl">
                        <h3 class="text-sm font-bold font-outfit uppercase tracking-wider mb-6 text-center text-slate-300">Interactive Configurator</h3>
                        
                        <!-- Slider 1 -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-400 mb-2 font-outfit">
                                <span>TOTAL ACTIVE LEARNERS</span>
                                <span class="text-impetus-orange text-sm font-extrabold" x-text="learners"></span>
                            </div>
                            <input type="range" min="10" max="2500" step="10" x-model="learners" class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-impetus-orange">
                        </div>

                        <!-- Slider 2 -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-400 mb-2 font-outfit">
                                <span>TARGET COMPLETION RATE</span>
                                <span class="text-white text-sm font-extrabold" x-text="rate + '%'"></span>
                            </div>
                            <input type="range" min="40" max="100" step="5" x-model="rate" class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-impetus-orange">
                        </div>

                        <!-- Outputs Display Grid -->
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[9px] font-bold text-slate-400 block uppercase tracking-widest leading-relaxed">ANNUAL HOURS SAVED</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-white block mt-1 font-outfit" x-text="Math.round(learners * 12.5 * (rate / 100))"></span>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[9px] font-bold text-slate-400 block uppercase tracking-widest leading-relaxed">CAPABILITY BOOST</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-impetus-orange block mt-1 font-outfit" x-text="Math.round((rate * 0.48) + (learners > 500 ? 42 : 28)) + '%'"></span>
                            </div>
                        </div>

                        <a href="#contact" class="block text-center mt-6 bg-white hover:bg-slate-100 text-impetus-dark py-3.5 rounded-full text-sm font-bold transition-all font-outfit shadow-lg">
                            Request Custom Analysis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3">Client Success</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-dark tracking-tight font-outfit">Endorsed by Top Training Directors</p>
                <p class="mt-4 text-slate-600">Hear from clinical administrators and team leaders who successfully automated learning, increased audit pass rates, and elevated team capacity.</p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all group">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"Integrating the Impetus CNE courseware across our clinical systems was highly efficient. Our overall credit compliance rose to 98% in just 12 weeks."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 font-outfit group-hover:bg-impetus-orangeLight group-hover:text-impetus-orange duration-300">DR</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Dr. Evelyn Reed</h4>
                            <p class="text-xs text-slate-400">CPD Director, Ventura Health Alliance</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all group">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"The secure proctoring capabilities and immediate scoring logic solved all our external auditing bottlenecks. Absolute confidence in our regulatory audits."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 font-outfit group-hover:bg-impetus-orangeLight group-hover:text-impetus-orange duration-300">TM</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Thomas Miller</h4>
                            <p class="text-xs text-slate-400">Head of Operations, Apex Clinical Care</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all group">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span><span class="text-lg font-bold">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"Our employee onboarding curve improved by 40% after launching the Impetus custom pathways. Standardized compliance is now an asset."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 font-outfit group-hover:bg-impetus-orangeLight group-hover:text-impetus-orange duration-300">SK</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Sarah Jenkins</h4>
                            <p class="text-xs text-slate-400">VP People, NextGen Systems Ltd</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Consultation / Lead Capture Form -->
    <section id="contact" class="py-24 bg-impetus-dark text-white relative">
        <div class="absolute inset-0 bg-radial-gradient(circle_at_center, rgba(255, 107, 0, 0.05) 0%, transparent 60%) pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3 block">Engagement Desk</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-outfit mb-6 text-white">Initiate a Structured Integration</h2>
            <p class="text-slate-400 text-sm leading-relaxed max-w-xl mx-auto mb-12">Submit your organization's learning parameters below. An Impetus eLearning Architect will configure a structured capability outline for your evaluation.</p>

            <form onsubmit="event.preventDefault(); alert('Your consultation request has been submitted successfully.');" class="text-left bg-[#13141B] p-8 sm:p-12 border border-white/5 shadow-2xl max-w-2xl mx-auto text-slate-200 rounded-3xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-outfit">Representative Name</label>
                        <input type="text" required class="w-full bg-[#1C1E26] border border-white/10 rounded-lg focus:border-impetus-orange focus:ring-1 focus:ring-impetus-orange focus:outline-none px-4 py-3 text-sm text-white font-medium" placeholder="E.g., Dr. Evelyn Reed">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-outfit">Official Email Address</label>
                        <input type="email" required class="w-full bg-[#1C1E26] border border-white/10 rounded-lg focus:border-impetus-orange focus:ring-1 focus:ring-impetus-orange focus:outline-none px-4 py-3 text-sm text-white font-medium" placeholder="evelyn@venturahealth.org">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-outfit">Primary Alignment Goal</label>
                    <select class="w-full bg-[#1C1E26] border border-white/10 rounded-lg focus:border-impetus-orange focus:ring-1 focus:ring-impetus-orange focus:outline-none px-4 py-3 text-sm text-slate-300 font-medium appearance-none">
                        <option>Accredited Continuing Nursing Education (CNE)</option>
                        <option>Corporate Compliance &amp; Regulatory Onboarding</option>
                        <option>Higher Education SCORM / LTI Custom Infrastructure</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-outfit">Brief Outline of Learning Challenges</label>
                    <textarea class="w-full bg-[#1C1E26] border border-white/10 rounded-lg focus:border-impetus-orange focus:ring-1 focus:ring-impetus-orange focus:outline-none px-4 py-3 text-sm text-white font-medium h-28 resize-none" placeholder="Provide a brief summary of your regulatory, auditing, or technical requirements..."></textarea>
                </div>

                <button type="submit" class="w-full bg-impetus-orange hover:bg-impetus-orangeHover text-white py-4 rounded-xl text-sm font-extrabold tracking-wider transition-all font-outfit glow-orange">
                    Request Capability Analysis
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-impetus-dark border-t border-white/5 py-16 text-slate-400 text-xs">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-impetus-orange flex items-center justify-center text-white font-extrabold text-sm">i</div>
                        <span class="font-bold text-white text-sm uppercase tracking-wider font-outfit">Impetus</span>
                    </div>
                    <p class="text-[11px] text-slate-400 leading-relaxed">Continuous learning architectures engineered to optimize professional and regulatory compliance across leading organizations.</p>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-white uppercase tracking-widest mb-4 font-outfit">Syllabus catalogs</h4>
                    <ul class="space-y-2.5 text-[11px]">
                        <li><a href="#solutions" class="hover:text-impetus-orange transition-colors">CPD Nursing Modules</a></li>
                        <li><a href="#solutions" class="hover:text-impetus-orange transition-colors">Information Security Audits</a></li>
                        <li><a href="#solutions" class="hover:text-impetus-orange transition-colors">Proctored Examinations</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-white uppercase tracking-widest mb-4 font-outfit">Ecosystem</h4>
                    <ul class="space-y-2.5 text-[11px]">
                        <li><a href="#features" class="hover:text-impetus-orange transition-colors">Multimedia Engine</a></li>
                        <li><a href="#features" class="hover:text-impetus-orange transition-colors">Adaptive Quizzing</a></li>
                        <li><a href="#calculator" class="hover:text-impetus-orange transition-colors">ROI Configurator</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-white uppercase tracking-widest mb-4 font-outfit">Inquiries Desk</h4>
                    <ul class="space-y-2.5 text-[11px] text-slate-300 font-bold">
                        <li>General: architect@impetus-elearning.com</li>
                        <li>Support: desk@impetus-elearning.com</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4 text-[10px] text-slate-400">
                <span>&copy; 2026 Impetus eLearning Solutions. All rights reserved.</span>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Compliance Standards</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
