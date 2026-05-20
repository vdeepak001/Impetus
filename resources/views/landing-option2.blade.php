<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Impetus eLearning Solutions | Enterprise Capability & CPD Systems</title>
    
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN for zero-compile styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            orange: '#F36E21',
                            green: '#0B8444',
                            navy: '#1D2A57',
                            slate: '#64748B',
                            lightBg: '#F8FAFC',
                            border: '#E2E8F0',
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS for high-end UI interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .dot-grid {
            background-image: radial-gradient(rgba(29, 42, 87, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .hero-border {
            border-bottom: 1px solid rgba(29, 42, 87, 0.08);
        }
        .fine-line {
            border-color: rgba(29, 42, 87, 0.08);
        }
        .glow-accent-orange:hover {
            box-shadow: 0 0 25px rgba(243, 110, 33, 0.15);
        }
        .glow-accent-green:hover {
            box-shadow: 0 0 25px rgba(11, 132, 68, 0.15);
        }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased font-sans dot-grid">

    <!-- Thin Top Banner -->
    <div class="bg-brand-navy text-white text-[11px] font-bold tracking-widest text-center py-2.5 px-4 uppercase fine-line border-b">
        Accredited Enterprise eLearning &bull; Institutional CPD Management Systems
    </div>

    <!-- Navigation -->
    <header class="w-full bg-white/95 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Identity -->
                <div class="flex items-center">
                    <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=flex\\ items-center\\ gap-2.5><div class=\\w-9\\ h-9\\ rounded-full\\ bg-brand-orange\\ flex\\ items-center\\ justify-center\\ text-white\\ font-extrabold\\ text-lg\\>i</div><div class=flex\\ flex-col><span class=\\font-bold\\ text-lg\\ text-brand-green\\ leading-none\\ font-serif\\>Impetus</span><span class=\\text-[9px]\\ font-bold\\ text-brand-navy\\ tracking-widest\\ uppercase\\ mt-0.5\\>eLearning Solutions</span></div></div>'" alt="Impetus eLearning Solutions" class="h-10 w-auto object-contain">
                </div>

                <!-- Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-10">
                    <a href="#about" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Overview</a>
                    <a href="#frameworks" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Frameworks</a>
                    <a href="#interactive-suite" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Deployment Planner</a>
                    <a href="#roadmap" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Methodology</a>
                    <a href="#consultation" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Request Catalog</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden sm:flex items-center space-x-6">
                    <a href="#consultation" class="text-xs font-bold uppercase tracking-wider text-brand-navy hover:text-brand-orange transition-colors">Client Login</a>
                    <a href="#consultation" class="border border-brand-green hover:bg-brand-green text-brand-green hover:text-white px-5 py-2.5 text-xs font-bold uppercase tracking-widest transition-all font-bold glow-accent-green">
                        Request Consult
                    </a>
                </div>

                <!-- Mobile Menu (AlpineJS) -->
                <div class="flex lg:hidden" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="text-brand-navy focus:outline-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute top-20 left-0 w-full bg-white border-b border-slate-200 shadow-xl p-6 flex flex-col space-y-4 lg:hidden">
                        <a @click="open = false" href="#about" class="text-xs font-bold uppercase tracking-wider text-brand-navy">Overview</a>
                        <a @click="open = false" href="#frameworks" class="text-xs font-bold uppercase tracking-wider text-brand-navy">Frameworks</a>
                        <a @click="open = false" href="#interactive-suite" class="text-xs font-bold uppercase tracking-wider text-brand-navy">Deployment Planner</a>
                        <a @click="open = false" href="#roadmap" class="text-xs font-bold uppercase tracking-wider text-brand-navy">Methodology</a>
                        <div class="pt-4 border-t border-slate-100 flex flex-col gap-3">
                            <a href="#consultation" class="text-center text-xs font-bold uppercase tracking-wider text-brand-navy py-2">Client Login</a>
                            <a href="#consultation" class="text-center border border-brand-green text-brand-green py-2.5 text-xs font-bold uppercase tracking-widest">Request Consult</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="about" class="py-16 md:py-24 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left Text block -->
                <div class="lg:col-span-6 text-center lg:text-left">
                    <span class="text-brand-green font-bold text-xs uppercase tracking-widest block mb-4">Intellectual Capability Framework</span>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-normal text-brand-navy leading-[1.1] font-serif mb-6">
                        Systematic Learning. <br>
                        <span class="italic text-brand-orange font-normal">Proven Competence.</span>
                    </h1>
                    
                    <p class="text-slate-500 leading-relaxed text-sm max-w-xl mx-auto lg:mx-0 mb-8">
                        Impetus designs, deploys, and certifies continuing professional education solutions. We deliver evidence-based clinical programs, corporate compliance architectures, and secure LMS platforms designed to build intellectual capability across teams.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#interactive-suite" class="w-full sm:w-auto text-center bg-brand-navy hover:bg-slate-900 text-white px-7 py-3.5 text-xs font-bold uppercase tracking-widest transition-all">
                            Interactive Planner
                        </a>
                        <a href="#consultation" class="w-full sm:w-auto text-center border border-brand-orange hover:bg-brand-orange text-brand-orange hover:text-white px-7 py-3.5 text-xs font-bold uppercase tracking-widest transition-all glow-accent-orange">
                            Request Demo
                        </a>
                    </div>
                </div>

                <!-- Right Graphic Mockup (Sleek technical manager dashboard representation) -->
                <div class="lg:col-span-6 relative">
                    <div class="bg-brand-lightBg rounded-2xl p-6 border border-slate-200/80 shadow-sm relative">
                        <!-- Upper border detailing -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200/60 text-xs font-bold text-brand-navy tracking-wider">
                            <span>PLATFORM SYSTEM AUDIT</span>
                            <span class="text-brand-green font-bold flex items-center gap-1.5 font-sans">
                                <span class="w-2 h-2 rounded-full bg-brand-green inline-block animate-pulse"></span>
                                COMPLIANT
                            </span>
                        </div>

                        <!-- Technical charts mockups using HTML borders -->
                        <div class="space-y-5 mb-6">
                            <!-- Index 1 -->
                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-500 mb-1.5">
                                    <span>CLINICAL KNOWLEDGE INDEX</span>
                                    <span class="text-brand-navy">91.4%</span>
                                </div>
                                <div class="w-full bg-white h-2 rounded-full border border-slate-200 overflow-hidden">
                                    <div class="bg-brand-green h-full rounded-full" style="width: 91.4%"></div>
                                </div>
                            </div>
                            
                            <!-- Index 2 -->
                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-500 mb-1.5">
                                    <span>REGULATORY AUDIT PASS RATE</span>
                                    <span class="text-brand-navy">100.0%</span>
                                </div>
                                <div class="w-full bg-white h-2 rounded-full border border-slate-200 overflow-hidden">
                                    <div class="bg-brand-navy h-full rounded-full" style="width: 100%"></div>
                                </div>
                            </div>

                            <!-- Index 3 -->
                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-500 mb-1.5">
                                    <span>AVERAGE ONBOARDING TIME</span>
                                    <span class="text-brand-navy">4.2 WEEKS</span>
                                </div>
                                <div class="w-full bg-white h-2 rounded-full border border-slate-200 overflow-hidden">
                                    <div class="bg-brand-orange h-full rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical stats grid -->
                        <div class="grid grid-cols-3 gap-3 bg-white p-4 rounded-xl border border-slate-200/60 text-center">
                            <div>
                                <span class="text-lg font-bold text-brand-navy block">6,000+</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Accredited MCQs</span>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-brand-navy block">24 / 7</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Auditing Access</span>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-brand-green block">&uarr; 30%</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Retention Lift</span>
                            </div>
                        </div>
                    </div>

                    <!-- Fine line outer border grid detailing -->
                    <div class="absolute -inset-4 border border-dashed border-slate-200/50 -z-10 rounded-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical Trust Bar -->
    <section class="py-10 bg-brand-lightBg border-b border-slate-100 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-4">Accreditations & Compliance Benchmarks</span>
            <div class="flex flex-wrap items-center justify-center gap-12 opacity-60">
                <span class="text-xs font-bold text-brand-navy tracking-widest font-sans">CPD ACCREDITATION NO. 44109</span>
                <span class="text-xs font-bold text-brand-navy tracking-widest font-sans">SCORM / xAPI INTEROPERABLE</span>
                <span class="text-xs font-bold text-brand-navy tracking-widest font-sans">ISO/IEC 27001 SECURE</span>
            </div>
        </div>
    </section>

    <!-- Structural Features Grid -->
    <section id="frameworks" class="py-24 border-b border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-orange font-bold text-xs uppercase tracking-widest block mb-3">Enterprise Suite</span>
                <h2 class="text-3xl font-normal text-brand-navy leading-snug font-serif">Engineered Learning Pillars</h2>
                <p class="mt-3 text-slate-500 text-sm">We combine robust software systems with academically sound pedagogical architectures to secure long-term capability gains.</p>
            </div>

            <!-- 4-Column Feature Grid with borders -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-slate-100 border border-slate-100 rounded-3xl overflow-hidden bg-[#FBFDFE]">
                <!-- Column 1 -->
                <div class="p-8 flex flex-col justify-between hover:bg-white transition-colors duration-300">
                    <div>
                        <div class="w-9 h-9 rounded-lg bg-brand-lightBg border border-slate-100 flex items-center justify-center text-brand-navy font-bold text-sm mb-6">01</div>
                        <h3 class="text-base font-bold text-brand-navy uppercase tracking-wider mb-3">Modular Curriculums</h3>
                        <p class="text-slate-500 leading-relaxed text-xs">Dynamic slides and procedural PDFs structured into micro-learning segments to increase student understanding.</p>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="p-8 flex flex-col justify-between hover:bg-white transition-colors duration-300">
                    <div>
                        <div class="w-9 h-9 rounded-lg bg-brand-lightBg border border-slate-100 flex items-center justify-center text-brand-navy font-bold text-sm mb-6">02</div>
                        <h3 class="text-base font-bold text-brand-navy uppercase tracking-wider mb-3">Robust Auditing</h3>
                        <p class="text-slate-500 leading-relaxed text-xs">Auto-logged timestamps and digital certificate ID credentials ready to be submitted for audits.</p>
                    </div>
                </div>

                <!-- Column 3 -->
                <div class="p-8 flex flex-col justify-between hover:bg-white transition-colors duration-300">
                    <div>
                        <div class="w-9 h-9 rounded-lg bg-brand-lightBg border border-slate-100 flex items-center justify-center text-brand-navy font-bold text-sm mb-6">03</div>
                        <h3 class="text-base font-bold text-brand-navy uppercase tracking-wider mb-3">Assessment Rigor</h3>
                        <p class="text-slate-500 leading-relaxed text-xs">Comprehensive MCQ sets across 3 difficulty levels with immediate, evidence-based academic rationales.</p>
                    </div>
                </div>

                <!-- Column 4 -->
                <div class="p-8 flex flex-col justify-between hover:bg-white transition-colors duration-300">
                    <div>
                        <div class="w-9 h-9 rounded-lg bg-brand-lightBg border border-slate-100 flex items-center justify-center text-brand-navy font-bold text-sm mb-6">04</div>
                        <h3 class="text-base font-bold text-brand-navy uppercase tracking-wider mb-3">Proctored Portals</h3>
                        <p class="text-slate-500 leading-relaxed text-xs">Verify student identities securely with our integrated secure-browser examination proctoring framework.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Onboarding Planner (AlpineJS) -->
    <section id="interactive-suite" class="py-24 border-b border-slate-100 bg-brand-lightBg" x-data="{ service: 'cpd', scale: 'medium' }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Inputs column -->
                <div class="lg:col-span-5">
                    <span class="text-brand-green font-bold text-xs uppercase tracking-widest block mb-3">Interactive Configurator</span>
                    <h2 class="text-3xl font-normal text-brand-navy font-serif mb-6">Plan Your Deployment</h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">Select your learning goal and organizational scale below to instantly render the recommended Impetus deployment model.</p>
                    
                    <!-- Goal selector buttons -->
                    <div class="mb-6">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">1. Select Target Learning Goal</label>
                        <div class="flex flex-col gap-2.5">
                            <button @click="service = 'cpd'" :class="service === 'cpd' ? 'border-brand-navy bg-brand-navy text-white' : 'border-slate-200 bg-white text-slate-700'" class="w-full text-left px-5 py-3 border text-xs font-bold uppercase tracking-widest transition-all">
                                Clinical CPD & Nurses Education
                            </button>
                            <button @click="service = 'compliance'" :class="service === 'compliance' ? 'border-brand-navy bg-brand-navy text-white' : 'border-slate-200 bg-white text-slate-700'" class="w-full text-left px-5 py-3 border text-xs font-bold uppercase tracking-widest transition-all">
                                Corporate Audits & Onboarding
                            </button>
                        </div>
                    </div>

                    <!-- Scale Selector -->
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">2. Choose Active User Scale</label>
                        <div class="flex gap-2.5">
                            <button @click="scale = 'small'" :class="scale === 'small' ? 'border-brand-orange bg-brand-orange text-white' : 'border-slate-200 bg-white text-slate-700'" class="flex-1 text-center py-2.5 border text-xs font-bold uppercase tracking-widest transition-all">
                                &lt; 250 Users
                            </button>
                            <button @click="scale = 'medium'" :class="scale === 'medium' ? 'border-brand-orange bg-brand-orange text-white' : 'border-slate-200 bg-white text-slate-700'" class="flex-1 text-center py-2.5 border text-xs font-bold uppercase tracking-widest transition-all">
                                250 - 1000
                            </button>
                            <button @click="scale = 'large'" :class="scale === 'large' ? 'border-brand-orange bg-brand-orange text-white' : 'border-slate-200 bg-white text-slate-700'" class="flex-1 text-center py-2.5 border text-xs font-bold uppercase tracking-widest transition-all">
                                1000+ Users
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Outputs column (Refined Technical Blueprint layout) -->
                <div class="lg:col-span-7">
                    <div class="bg-white border border-slate-200 p-8 rounded-2xl shadow-sm">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                            <h3 class="text-xs font-bold text-brand-navy uppercase tracking-widest">IMPETUS DEPLOYMENT SPECIFICATION</h3>
                            <span class="text-[9px] bg-brand-lightBg border border-slate-200 text-brand-navy px-2 py-0.5 rounded font-bold">SPEC: V2.14</span>
                        </div>

                        <!-- Timeline details -->
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div class="border-l-2 border-brand-green pl-4">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">DEPLOYMENT TIMELINE</span>
                                <span class="text-xl font-bold text-brand-navy block mt-1" x-text="service === 'cpd' ? (scale === 'small' ? '2 Weeks' : '4 Weeks') : (scale === 'small' ? '3 Weeks' : '5 Weeks')"></span>
                            </div>
                            <div class="border-l-2 border-brand-orange pl-4">
                                <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">ANNUAL CPD AUDIT ASSURANCE</span>
                                <span class="text-xl font-bold text-brand-navy block mt-1" x-text="service === 'cpd' ? '100% Certified' : 'Full Audit Trail'"></span>
                            </div>
                        </div>

                        <!-- Feature list dynamic values -->
                        <div class="space-y-4 mb-8 text-xs text-slate-600 border-t border-slate-100 pt-6">
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-navy"></span>
                                <span class="font-bold text-slate-800" x-text="service === 'cpd' ? 'Dynamic nursing catalogs ( oncology, emergency, critical care)' : 'Custom strategic employee onboarding blueprints'"></span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-navy"></span>
                                <span class="font-bold text-slate-800" x-text="scale === 'small' ? 'Standalone secure web platform & proctored examinations' : 'SSO & API-capable LMS infrastructure integration'"></span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-navy"></span>
                                <span class="font-bold text-slate-800" x-text="service === 'cpd' ? 'Continuous clinical assessment logs (Level I, II, III)' : 'Gamified leaderboard mechanics & automated audit log outputs'"></span>
                            </div>
                        </div>

                        <a href="#consultation" class="block w-full text-center bg-brand-navy hover:bg-slate-900 text-white py-3.5 text-xs font-bold uppercase tracking-widest transition-all">
                            Lock In This Blueprint
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Delivery Roadmap -->
    <section id="roadmap" class="py-24 border-b border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="text-brand-orange font-bold text-xs uppercase tracking-widest block mb-3">Onboarding Methodology</span>
                <h2 class="text-3xl font-normal text-brand-navy font-serif">Implementation Roadmap</h2>
                <p class="mt-3 text-slate-500 text-sm">We follow a strict, high-touch engineering protocol to integrate curriculum databases and LMS technology into your corporate structure.</p>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="border-b border-slate-200 pb-4 mb-4 text-xs font-bold text-slate-400">PHASE 01</div>
                    <h3 class="text-sm font-bold text-brand-navy uppercase tracking-wider mb-2 font-serif">Blueprint Analysis</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">We audit your existing offline guides, slide materials, and compliance goals to structure your custom syllabus database.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="relative">
                    <div class="border-b border-slate-200 pb-4 mb-4 text-xs font-bold text-slate-400">PHASE 02</div>
                    <h3 class="text-sm font-bold text-brand-navy uppercase tracking-wider mb-2 font-serif">Database Adaptation</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Our clinical and educational editors convert complex procedures into interactive web checkpoints and proctored examinations.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="border-b border-slate-200 pb-4 mb-4 text-xs font-bold text-slate-400">PHASE 03</div>
                    <h3 class="text-sm font-bold text-brand-navy uppercase tracking-wider mb-2 font-serif">Platform Deployment</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">We customize your LMS backend, integrate corporate sign-in pathways, and launch mobile-responsive interfaces.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative">
                    <div class="border-b border-slate-200 pb-4 mb-4 text-xs font-bold text-brand-green font-sans font-bold">PHASE 04</div>
                    <h3 class="text-sm font-bold text-brand-navy uppercase tracking-wider mb-2 font-serif">Audit & Compliance</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">Continuous delivery of auto-logged capability indices, credit logs, and certified audits to guarantee regulatory standing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Executive Case Studies / Quotes -->
    <section class="py-24 bg-brand-lightBg border-b border-slate-100">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <span class="text-brand-orange font-bold text-xs uppercase tracking-widest block mb-4">Enterprise Endorsements</span>
            <blockquote class="text-2xl sm:text-3xl font-normal text-brand-navy font-serif italic leading-relaxed mb-8">
                "Impetus eLearning Solutions has systematically restructured our corporate nursing continuing education framework. The secure proctoring portal and automated capability indexing have provided total confidence to our auditing boards."
            </blockquote>
            <cite class="text-xs font-bold text-brand-navy uppercase tracking-widest not-italic block">
                Director Robert Sterling &mdash; <span class="text-slate-400">Chief of Clinical Operations, Sterling Medical</span>
            </cite>
        </div>
    </section>

    <!-- Executive Lead Capture Form -->
    <section id="consultation" class="py-24 bg-brand-navy text-white relative">
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-orange font-bold text-xs uppercase tracking-widest block mb-4">LMS Capability Consultation</span>
            <h2 class="text-3xl sm:text-4xl font-normal font-serif mb-6 text-white">Initiate a Strategic Engagement</h2>
            <p class="text-slate-400 text-sm leading-relaxed max-w-xl mx-auto mb-12">Submit your institutional parameters below. An Impetus eLearning Architect will structure a customized capability blueprint for your organization.</p>

            <form onsubmit="event.preventDefault(); alert('Consultation Request Submitted successfully.');" class="text-left bg-white p-8 sm:p-10 border border-slate-200 shadow-xl max-w-2xl mx-auto text-slate-800">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Corporate Representative Name</label>
                        <input type="text" required class="w-full bg-slate-50 border border-slate-200 focus:border-brand-navy focus:outline-none px-4 py-3 text-xs font-bold uppercase text-brand-navy" placeholder="E.g., Jane Sterling">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Official Email Address</label>
                        <input type="email" required class="w-full bg-slate-50 border border-slate-200 focus:border-brand-navy focus:outline-none px-4 py-3 text-xs font-bold uppercase text-brand-navy" placeholder="jane@sterlingmedical.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Primary Target Goal</label>
                    <select class="w-full bg-slate-50 border border-slate-200 focus:border-brand-navy focus:outline-none px-4 py-3 text-xs font-bold uppercase text-brand-navy">
                        <option>Accredited Nursing CPD Licensing</option>
                        <option>Strategic Corporate Onboarding & Audit</option>
                        <option>SCORM/LTI Custom LMS Infrastructure</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Brief Summary of Learning Challenges</label>
                    <textarea class="w-full bg-slate-50 border border-slate-200 focus:border-brand-navy focus:outline-none px-4 py-3 text-xs font-bold uppercase text-brand-navy h-28" placeholder="Summarize your regulatory compliance needs..."></textarea>
                </div>

                <button type="submit" class="w-full bg-brand-navy hover:bg-slate-900 text-white py-4 text-xs font-bold uppercase tracking-widest transition-all">
                    Request Integration Architecture
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-16 text-slate-400 text-xs">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=\'w-8 h-8 rounded-full bg-brand-orange flex items-center justify-center text-white font-extrabold text-sm\'>i</div>'" alt="Impetus eLearning Solutions" class="h-8 w-8 object-contain">
                        <span class="font-bold text-brand-navy text-sm uppercase tracking-wider font-serif">Impetus</span>
                    </div>
                    <p class="text-[11px] text-slate-400 leading-relaxed">Continuous educational platforms engineered to build intellectual capability across leading organizations.</p>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-brand-navy uppercase tracking-widest mb-4">Frameworks</h4>
                    <ul class="space-y-2.5 text-[11px]">
                        <li><a href="#frameworks" class="hover:text-brand-orange transition-colors">CPD Nursing Hubs</a></li>
                        <li><a href="#frameworks" class="hover:text-brand-orange transition-colors">Corporate Audit Portals</a></li>
                        <li><a href="#frameworks" class="hover:text-brand-orange transition-colors">Secure Exam Proctoring</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-brand-navy uppercase tracking-widest mb-4">Company</h4>
                    <ul class="space-y-2.5 text-[11px]">
                        <li><a href="#" class="hover:text-brand-orange transition-colors">Architecture Blueprint</a></li>
                        <li><a href="#" class="hover:text-brand-orange transition-colors">Pedagogy Design</a></li>
                        <li><a href="#" class="hover:text-brand-orange transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-brand-navy uppercase tracking-widest mb-4">Architecture Desk</h4>
                    <ul class="space-y-2.5 text-[11px] text-slate-500 font-bold">
                        <li>Inquiry: architect@impetus-elearning.com</li>
                        <li>Support: desk@impetus-elearning.com</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-[10px] text-slate-400">
                <span>&copy; 2026 Impetus eLearning Solutions. All rights reserved.</span>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-brand-navy">Privacy Architecture</a>
                    <a href="#" class="hover:text-brand-navy">Interoperability Standards</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
