<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impetus eLearning Solutions | Building Intellectual Capability</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN for bulletproof zero-compile styling -->
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
                            orange: '#F36E21',
                            green: '#0B8444',
                            navy: '#1D2A57',
                            gray: '#718096',
                            lightGreen: '#EBF7F0',
                            lightOrange: '#FFF3EC',
                            dark: '#0B0F19',
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
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .gradient-text-orange-green {
            background: linear-gradient(135deg, #F36E21 0%, #0B8444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg-hero {
            background: radial-gradient(circle at 10% 20%, rgba(243, 110, 33, 0.05) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(11, 132, 68, 0.05) 0%, transparent 40%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .glass-card-dark {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .custom-shadow {
            box-shadow: 0 20px 40px -15px rgba(29, 42, 87, 0.08);
        }
        .glow-orange:hover {
            box-shadow: 0 10px 30px -5px rgba(243, 110, 33, 0.3);
        }
        .glow-green:hover {
            box-shadow: 0 10px 30px -5px rgba(11, 132, 68, 0.3);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased font-sans gradient-bg-hero">


    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 w-full transition-all duration-300 glass-card border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=flex\\ items-center\\ gap-2.5><div class=\\w-10\\ h-10\\ rounded-full\\ bg-impetus-orange\\ flex\\ items-center\\ justify-center\\ text-white\\ font-extrabold\\ text-xl\\ shadow-md\\ shadow-impetus-orange/20\\ font-outfit\\>i</div><div class=flex\\ flex-col><span class=\\font-extrabold\\ text-xl\\ text-impetus-green\\ leading-tight\\ font-outfit\\>Impetus</span><span class=\\text-[10px]\\ font-semibold\\ text-impetus-navy\\ tracking-wider\\ uppercase\\ -mt-0.5\\>eLearning Solutions</span></div></div>'" alt="Impetus eLearning Solutions" class="h-12 w-auto object-contain">
                    </div>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Home</a>
                    <a href="#solutions" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium font-medium">Solutions</a>
                    <a href="#features" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Platform Features</a>
                    <a href="#calculator" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">ROI Calculator</a>
                    <a href="#testimonials" class="text-sm font-semibold text-slate-700 hover:text-impetus-orange transition-colors font-medium">Client Success</a>
                </nav>

                <!-- Actions -->
                <div class="hidden sm:flex items-center space-x-4">
                    <a href="#contact" class="text-sm font-bold text-slate-700 hover:text-impetus-orange transition-colors">Sign In</a>
                    <a href="#contact" class="bg-impetus-orange hover:bg-[#e05d14] text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-impetus-orange/20 transition-all hover:scale-102 hover:shadow-xl hover:shadow-impetus-orange/30 font-outfit glow-orange">
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
    <section id="home" class="pt-8 pb-20 md:py-28 bg-impetus-navy text-white relative overflow-hidden">
        <!-- Premium Radial Gradient Background for Blue Theme Hero -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(243,110,33,0.1),transparent_50%),radial-gradient(circle_at_80%_70%,rgba(11,132,68,0.1),transparent_50%)] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left text content -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <!-- Brand Badge -->
                    <div class="inline-flex items-center gap-2 bg-impetus-green/10 border border-impetus-green/30 px-4 py-1.5 rounded-full text-xs font-bold text-impetus-green uppercase tracking-wider mb-6 font-outfit">
                        <svg class="w-4 h-4 text-impetus-green animate-spin" style="animation-duration: 3s" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Building Intellectual Capability
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1] font-outfit">
                        Enterprise eLearning <br>
                        <span class="gradient-text-orange-green">Engineered for Impact.</span>
                    </h1>
                    
                    <p class="mt-6 text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Impetus provides custom corporate learning ecosystems, accredited educational courseware, and next-generation LMS tools designed to advance capability, knowledge retention, and institutional growth.
                    </p>

                    <!-- CTAs -->
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6">
                        <a href="#contact" class="w-full sm:w-auto text-center bg-impetus-orange hover:bg-[#e05d14] text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-impetus-orange/20 transition-all hover:-translate-y-0.5 hover:shadow-2xl hover:shadow-impetus-orange/30 font-outfit glow-orange">
                            Schedule A Call
                        </a>
                        <a href="#solutions" class="w-full sm:w-auto text-center bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white text-white px-8 py-4 rounded-full font-bold transition-all hover:-translate-y-0.5 shadow-sm hover:shadow-md font-outfit backdrop-blur-sm">
                            Explore Solutions
                        </a>
                    </div>

                    <!-- Client Logos Microbar -->
                    <div class="mt-12 pt-8 border-t border-white/10 text-left max-w-lg mx-auto lg:mx-0">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-4 text-center lg:text-left font-semibold">Accredited and Trusted by Industry Leaders</span>
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-x-8 gap-y-4 opacity-75">
                            <span class="font-outfit font-extrabold text-sm text-slate-300 tracking-wider">CPD ACCREDITED</span>
                            <span class="font-outfit font-extrabold text-sm text-slate-300 tracking-wider">ISO 27001</span>
                            <span class="font-outfit font-extrabold text-sm text-slate-300 tracking-wider">LEARNING ALLIANCE</span>
                        </div>
                    </div>
                </div>

                <!-- Right Dashboard Showcase Graphic -->
                <div class="lg:col-span-5 relative mt-8 lg:mt-0">
                    <div class="absolute inset-0 bg-gradient-to-tr from-impetus-orange/10 to-impetus-green/10 rounded-3xl blur-[50px] -z-10"></div>
                    
                    <!-- Main visual panel -->
                    <div class="relative glass-card border border-white/60 rounded-3xl p-6 sm:p-8 custom-shadow animate-float">
                        <!-- Upper frame detail -->
                        <div class="flex items-center justify-between mb-6 border-b border-slate-200/50 pb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-400 inline-block"></span>
                                <span class="w-3 h-3 rounded-full bg-yellow-400 inline-block"></span>
                                <span class="w-3 h-3 rounded-full bg-green-400 inline-block"></span>
                            </div>
                            <span class="text-xs font-bold text-slate-400 font-outfit">impetus-lms-v3.0</span>
                        </div>

                        <!-- Micro Learning Analytics Widget -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-white/80 p-4 rounded-2xl border border-slate-100 shadow-sm">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Course Completion</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-bold text-impetus-navy font-outfit">94.8%</span>
                                    <span class="text-xs font-bold text-impetus-green flex items-center">&uarr; 3.2%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-impetus-green h-full rounded-full" style="width: 94%"></div>
                                </div>
                            </div>
                            <div class="bg-white/80 p-4 rounded-2xl border border-slate-100 shadow-sm">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Skill Score</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-bold text-impetus-navy font-outfit">89 / 100</span>
                                    <span class="text-xs font-bold text-impetus-orange flex items-center">&uarr; 6%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-impetus-orange h-full rounded-full" style="width: 89%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Live Graph Widget -->
                        <div class="bg-white/90 p-5 rounded-2xl border border-slate-100 shadow-sm mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-bold text-slate-500 font-outfit uppercase">Intellectual Growth Curve</span>
                                <span class="text-[10px] bg-impetus-lightGreen text-impetus-green px-2 py-0.5 rounded-full font-bold">LIVE METRIC</span>
                            </div>
                            <!-- Mock Graph SVGs -->
                            <div class="relative h-28 w-full flex items-end">
                                <svg class="w-full h-full text-impetus-green" viewBox="0 0 100 30" preserveAspectRatio="none">
                                    <path d="M0,25 Q15,10 30,18 T60,8 T90,3 T100,5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"></path>
                                    <path d="M0,25 Q15,10 30,18 T60,8 T90,3 T100,5 L100,30 L0,30 Z" fill="url(#grad)" opacity="0.1"></path>
                                    <defs>
                                        <linearGradient id="grad" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#0B8444" />
                                            <stop offset="100%" stop-color="#fff" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>

                        <!-- User HUD floating card -->
                        <div class="flex items-center gap-3 bg-impetus-navy text-white p-4 rounded-2xl shadow-xl shadow-impetus-navy/15">
                            <div class="w-10 h-10 rounded-full bg-impetus-orange flex items-center justify-center font-extrabold text-white font-outfit shadow-md">i</div>
                            <div>
                                <h4 class="text-xs font-bold tracking-wide">Impetus Intelligent Tutor</h4>
                                <p class="text-[10px] text-slate-300">Ready to boost your clinical and tech capabilities.</p>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400 ml-auto animate-ping"></span>
                        </div>
                    </div>

                    <!-- Ambient glowing backgrounds -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-impetus-orange/30 rounded-full blur-2xl animate-pulse-slow"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-impetus-green/20 rounded-full blur-2xl animate-pulse-slow" style="animation-delay: 2s"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="py-12 bg-white border-y border-slate-200/60 shadow-sm relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-navy font-outfit block">98%</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1 block font-semibold">Course Completion Rate</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-green font-outfit block">4.9/5</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1 block font-semibold">User Satisfaction Rating</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-orange font-outfit block">2.4M+</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1 block font-semibold">Hours of Learning Cataloged</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="text-4xl sm:text-5xl font-extrabold text-impetus-navy font-outfit block">100%</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1 block font-semibold">Accredited Course Content</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Section with Tabs -->
    <section id="solutions" class="py-24" x-data="{ tab: 'healthcare' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-base font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3">Enterprise Ecosystems</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-navy tracking-tight font-outfit">Tailored Training for Leading Industries</p>
                <p class="mt-4 text-slate-600">Select your industry vertical below to see how Impetus matches your specific professional training and regulatory requirements.</p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button @click="tab = 'healthcare'" :class="tab === 'healthcare' ? 'bg-impetus-green text-white shadow-lg shadow-impetus-green/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Clinical & CPD Nursing
                </button>
                <button @click="tab = 'corporate'" :class="tab === 'corporate' ? 'bg-impetus-green text-white shadow-lg shadow-impetus-green/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Corporate & Enterprise
                </button>
                <button @click="tab = 'edu'" :class="tab === 'edu' ? 'bg-impetus-green text-white shadow-lg shadow-impetus-green/20' : 'bg-white hover:bg-slate-50 border border-slate-200 text-slate-700'" class="px-6 py-3 rounded-full text-sm font-bold font-outfit transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    Higher Academics
                </button>
            </div>

            <!-- Tab Content: Healthcare -->
            <div x-show="tab === 'healthcare'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-navy font-outfit mb-4">Accredited Continuing Nursing Education (CNE)</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Ensure total regulatory compliance and build frontline clinical excellence. Our healthcare courseware delivers targeted education in oncology, emergency triage, ICU protocols, and elderly care, mapped directly to regional CNE credit boards.</p>
                    
                    <ul class="space-y-3.5 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-orange mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">6,000+ Verified Practice MCQs & Live Rationales</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-orange mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Custom Level I, II, & III Certification Timelines</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-orange mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Secure, Secure-Browser Proctored Final Exam Portal</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-impetus-green hover:bg-[#076a35] text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit">
                        Explore Nursing Catalog
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80" alt="Clinical Training" class="w-full h-80 sm:h-96 object-cover hover:scale-103 transition-transform duration-700">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold">Featured Package</span>
                                <h4 class="font-bold text-slate-900 text-sm">Critical Care Advanced Nursing</h4>
                            </div>
                            <span class="bg-impetus-navy text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">40 CPD Points</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Corporate -->
            <div x-show="tab === 'corporate'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="display: none;">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-navy font-outfit mb-4">Enterprise Capability & Compliance Frameworks</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Turn corporate compliance into a competitive advantage. Build, measure, and deploy internal training programs for employee onboarding, executive leadership training, information security compliance, and soft skills.</p>
                    
                    <ul class="space-y-3.5 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-green mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Interactive Scenario-Based Micro-learning Snippets</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-green mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Automated Training Dashboard & Auditing Logs</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-green mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Gamified Rewards, Certificates & Department Leaderboards</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-impetus-green hover:bg-[#076a35] text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit">
                        Explore Enterprise LMS
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" alt="Corporate Training" class="w-full h-80 sm:h-96 object-cover hover:scale-103 transition-transform duration-700">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold font-semibold">Enterprise Hub</span>
                                <h4 class="font-bold text-slate-900 text-sm">Strategic Corporate Onboarding</h4>
                            </div>
                            <span class="bg-impetus-orange text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">8 Modules</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Academics -->
            <div x-show="tab === 'edu'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" style="display: none;">
                <div>
                    <h3 class="text-2xl font-bold text-impetus-navy font-outfit mb-4">Scalable Higher Education Digital Classrooms</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">Equip universities, colleges, and schools with modern classroom capabilities. Integrate virtual classrooms, online proctored examinations, secure student files, and dynamic custom learning paths seamlessly.</p>
                    
                    <ul class="space-y-3.5 mb-8">
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-navy mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Full LTI & SCORM/xAPI Interoperability Standard</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-navy mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Student Progress Audits & Automated Report Generation</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-impetus-navy mt-1">&bull;</span>
                            <span class="font-semibold text-slate-700">Virtual Classroom & Live Lecture Zoom/Teams Integration</span>
                        </li>
                    </ul>

                    <a href="#contact" class="inline-flex items-center gap-2 bg-impetus-green hover:bg-[#076a35] text-white px-6 py-3 rounded-full font-bold shadow-md transition-all font-outfit">
                        Explore Academic Suite
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                <div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Academic Training" class="w-full h-80 sm:h-96 object-cover hover:scale-103 transition-transform duration-700">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-5 rounded-2xl border border-white/40 shadow-xl flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold text-impetus-orange uppercase tracking-wider block font-semibold font-semibold">Academics</span>
                                <h4 class="font-bold text-slate-900 text-sm">Blended Learning Pedagogy</h4>
                            </div>
                            <span class="bg-impetus-navy text-white text-xs font-bold px-3 py-1.5 rounded-full font-outfit">SCORM 1.2</span>
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
                <h2 class="text-base font-bold text-impetus-green uppercase tracking-widest font-outfit mb-3">State-of-the-Art LMS</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-navy tracking-tight font-outfit">Core Technology to Scale Your Learning</p>
                <p class="mt-4 text-slate-600">Discover the tools that turn standard slides into active learning experiences and comprehensive capability indexes.</p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-12">
                <!-- Feature 1 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-white group">
                    <div class="w-12 h-12 bg-impetus-lightGreen text-impetus-green rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-110 duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-navy font-outfit mb-3">Rich Multimedia Courseware</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Convert plain PowerPoints and PDFs into engaging slideshows with case-based interactive learning checkpoints and inline quizzes.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-white group">
                    <div class="w-12 h-12 bg-impetus-lightOrange text-impetus-orange rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-110 duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-navy font-outfit mb-3">Continuous Assessment</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Deploy high-quality exams with secure proctoring options, browser protection, and fully automated multi-tiered grading dashboards.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-[#F8FAFC] border border-slate-200/60 p-8 rounded-3xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-white group">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-bold mb-6 group-hover:scale-110 duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-impetus-navy font-outfit mb-3">Enterprise Capability Index</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Analyze employee and team strengths with our proprietary intellectual radar chart. Understand real training ROI immediately.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive ROI Calculator Widget Section -->
    <section id="calculator" class="py-24 relative overflow-hidden" x-data="{ learners: 250, rate: 85 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-impetus-navy text-white rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-2xl relative overflow-hidden">
                <!-- Abstract glowing details inside card -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-impetus-orange/20 rounded-full blur-[80px]"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-impetus-green/20 rounded-full blur-[80px]"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <div class="lg:col-span-6">
                        <span class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3 block">Platform ROI Calculator</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-outfit mb-6">Quantify the Impact on Your Organization</h2>
                        <p class="text-slate-300 leading-relaxed mb-6">Configure your team scale to simulate training efficiency, hours saved, and intellectual capability index increases using the Impetus LMS engine.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-impetus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-slate-200">Replaces expensive offline training seminars</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-impetus-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-slate-200">Ensures immediate audit compliance</span>
                            </div>
                        </div>
                    </div>

                    <!-- Calculator Mockup Card -->
                    <div class="lg:col-span-6 bg-white/10 backdrop-blur-lg rounded-3xl p-6 sm:p-8 border border-white/10 relative">
                        <h3 class="text-lg font-bold font-outfit mb-6 text-center">Interactive Calculator</h3>
                        
                        <!-- Slider 1 -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-300 mb-2 font-outfit">
                                <span>TOTAL ACTIVE LEARNERS</span>
                                <span class="text-impetus-orange" x-text="learners"></span>
                            </div>
                            <input type="range" min="10" max="2500" step="10" x-model="learners" class="w-full h-2 bg-white/20 rounded-lg appearance-none cursor-pointer accent-impetus-orange">
                        </div>

                        <!-- Slider 2 -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-300 mb-2 font-outfit">
                                <span>TARGET COMPLETION RATE</span>
                                <span class="text-impetus-green" x-text="rate + '%'"></span>
                            </div>
                            <input type="range" min="40" max="100" step="5" x-model="rate" class="w-full h-2 bg-white/20 rounded-lg appearance-none cursor-pointer accent-impetus-green">
                        </div>

                        <!-- Outputs Display Grid -->
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-widest">ANNUAL HOURS SAVED</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-white block mt-1 font-outfit" x-text="Math.round(learners * 12 * (rate / 100))"></span>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-widest">CAPABILITY BOOST</span>
                                <span class="text-2xl sm:text-3xl font-extrabold text-impetus-green block mt-1 font-outfit" x-text="Math.round((rate * 0.45) + (learners > 500 ? 45 : 30)) + '%'"></span>
                            </div>
                        </div>

                        <a href="#contact" class="block text-center mt-6 bg-white hover:bg-slate-100 text-impetus-navy py-3.5 rounded-full text-sm font-bold transition-all font-outfit shadow-lg">
                            Get Custom ROI Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Slider Section -->
    <section id="testimonials" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-base font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3">Client Success</h2>
                <p class="text-3xl sm:text-4xl font-extrabold text-impetus-navy tracking-tight font-outfit">Endorsed by Top Training Directors</p>
                <p class="mt-4 text-slate-600">Hear from our clients who have successfully scaled training, automated certification, and enhanced overall intellectual capability.</p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"Deploying the Impetus CNE courseware across our regional nursing staff has been incredible. Our overall credit compliance rose to 98% within three months."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-impetus-lightGreen flex items-center justify-center font-bold text-impetus-green font-outfit">DR</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Dr. Evelyn Reed</h4>
                            <p class="text-xs text-slate-400">CPD Director, Ventura Health Alliance</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"The ease with which we could import our offline guidelines and build dynamic multimedia training has saved our HR department over 400 hours annually."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-impetus-lightOrange flex items-center justify-center font-bold text-impetus-orange font-outfit">MC</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Marcus Chen</h4>
                            <p class="text-xs text-slate-400">Head of Talent Management, Horizon Tech</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white border border-slate-200/60 p-8 rounded-3xl custom-shadow flex flex-col justify-between hover:scale-102 transition-all">
                    <div>
                        <!-- Rating -->
                        <div class="flex items-center gap-1 mb-6 text-impetus-orange">
                            <span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span><span class="text-lg">&#9733;</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed italic text-sm">"Impetus's secure proctored exams solved our compliance audit concerns perfectly. Highly secure, incredibly fast, and very professional LMS backend."</p>
                    </div>
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center font-bold text-indigo-600 font-outfit font-bold">SL</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Sarah Jenkins</h4>
                            <p class="text-xs text-slate-400">Dean of E-Learning, Crestview Academy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sleek Contact Form & Lead Capture -->
    <section id="contact" class="py-24 bg-impetus-navy text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-impetus-orange/10 via-transparent to-impetus-green/10 -z-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <span class="text-xs font-bold text-impetus-orange uppercase tracking-widest font-outfit mb-3 block font-semibold">Get In Touch</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-outfit">Accelerate Your Organization's Intellect</h2>
                <p class="mt-4 text-slate-300">Complete the form below to receive a custom capability report and start your free trial of the Impetus learning engine.</p>
            </div>

            <!-- Form -->
            <form onsubmit="event.preventDefault(); alert('Thank you! Our eLearning Consultant will contact you shortly.');" class="bg-white/5 backdrop-blur-md rounded-3xl p-8 sm:p-10 border border-white/10 shadow-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2 font-outfit font-semibold">Full Name</label>
                        <input type="text" required class="w-full bg-white/5 border border-white/10 focus:border-impetus-orange focus:outline-none rounded-xl px-4 py-3 text-white transition-all text-sm" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2 font-outfit font-semibold">Corporate Email</label>
                        <input type="email" required class="w-full bg-white/5 border border-white/10 focus:border-impetus-orange focus:outline-none rounded-xl px-4 py-3 text-white transition-all text-sm" placeholder="john@company.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2 font-outfit font-semibold">Company / Hospital</label>
                        <input type="text" required class="w-full bg-white/5 border border-white/10 focus:border-impetus-orange focus:outline-none rounded-xl px-4 py-3 text-white transition-all text-sm" placeholder="General Hospital Center">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2 font-outfit font-semibold">LMS Target Scale</label>
                        <select class="w-full bg-[#1D2A57] border border-white/10 focus:border-impetus-orange focus:outline-none rounded-xl px-4 py-3 text-white transition-all text-sm">
                            <option>10 - 250 learners</option>
                            <option>250 - 1000 learners</option>
                            <option>1000+ learners</option>
                        </select>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2 font-outfit font-semibold font-semibold">Brief Learning Goals</label>
                    <textarea class="w-full bg-white/5 border border-white/10 focus:border-impetus-orange focus:outline-none rounded-xl px-4 py-3 text-white transition-all text-sm h-28" placeholder="We need to train 350 nurses on clinical compliance guidelines..."></textarea>
                </div>

                <button type="submit" class="w-full bg-impetus-orange hover:bg-[#e05d14] text-white py-4 rounded-full font-bold font-outfit transition-all shadow-lg shadow-impetus-orange/20 hover:scale-101 hover:shadow-xl">
                    Submit Request
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-impetus-dark text-slate-400 py-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=\'w-8 h-8 rounded-full bg-impetus-orange flex items-center justify-center text-white font-extrabold text-sm font-outfit shadow-md\'>i</div>'" alt="Impetus eLearning Solutions" class="h-8 w-8 object-contain">
                        <span class="font-bold text-white text-lg font-outfit font-bold">Impetus</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">Building Intellectual Capability through next-generation online learning systems.</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 font-outfit font-bold">Solutions</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#solutions" class="hover:text-white transition-colors">Clinical & CPD Hub</a></li>
                        <li><a href="#solutions" class="hover:text-white transition-colors">Corporate Compliance</a></li>
                        <li><a href="#solutions" class="hover:text-white transition-colors">Higher Academic Suite</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 font-outfit font-bold">Platform</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#features" class="hover:text-white transition-colors">Multimedia Engine</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors">Proctored Exams</a></li>
                        <li><a href="#calculator" class="hover:text-white transition-colors">ROI Calculator</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4 font-outfit font-bold">Corporate</h4>
                    <ul class="space-y-2 text-xs font-outfit">
                        <li><span class="text-slate-500">Call:</span> +1 (800) 555-IMPETUS</li>
                        <li><span class="text-slate-500">Mail:</span> solutions@impetus-elearning.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-slate-800 text-center text-[10px] text-slate-600 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span>&copy; 2026 Impetus eLearning Solutions. All rights reserved.</span>
                <div class="flex gap-4 font-semibold">
                    <a href="#" class="hover:text-slate-400">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-400">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
