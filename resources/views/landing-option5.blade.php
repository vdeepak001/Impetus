<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Impetus eLearning Solutions - Experience the Aether Edition. Premium LMS engines, SCORM/xAPI compliant courseware, and dynamic cognitive metrics designed for enterprise regulatory compliance.">
    <title>Impetus eLearning Solutions | Aether Enterprise & CPD Ecosystem</title>
    
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@800;900&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

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
                        syne: ['Syne', 'sans-serif'],
                    },
                    colors: {
                        aether: {
                            50: '#F5F7FA',
                            100: '#E4E9F0',
                            200: '#CBD5E1',
                            800: '#1E293B',
                            900: '#0F172A',
                            950: '#080A10', // Aether Midnight Obsidian
                        },
                        amber: {
                            50: '#FFF7ED',
                            100: '#FFEDD5',
                            500: '#F97316',
                            600: '#EA580C', // Golden Orange
                            700: '#C2410C',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 7s ease-in-out infinite',
                        'float-delayed': 'float 7s ease-in-out infinite 3.5s',
                        'spin-slow': 'spin 20s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-10px) rotate(0.5deg)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .aether-grid-pattern {
            background-image: linear-gradient(to right, rgba(234, 88, 12, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(234, 88, 12, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .gradient-text-aether {
            background: linear-gradient(135deg, #FFFFFF 10%, #EA580C 60%, #B45309 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glow-border {
            box-shadow: inset 0 0 12px rgba(234, 88, 12, 0.1), 0 4px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(234, 88, 12, 0.15);
        }
        .glass-aether-panel {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .glass-card-hover:hover {
            border-color: rgba(234, 88, 12, 0.4);
            box-shadow: 0 0 25px rgba(234, 88, 12, 0.15);
            transform: translateY(-2px);
        }
        /* Custom floating gold particle CSS */
        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 1; }
            100% { transform: translateY(-130px) scale(0.3); opacity: 0; }
        }
        .gold-particle {
            animation: floatUp 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }
    </style>
</head>
<body class="bg-aether-950 text-slate-200 antialiased font-sans aether-grid-pattern overflow-x-hidden relative">

    <!-- Glowing Background Auroras -->
    <div class="absolute top-[5%] left-[10%] w-[40rem] h-[40rem] bg-amber-600/5 rounded-full blur-[140px] pointer-events-none animate-pulse-slow"></div>
    <div class="absolute top-[30%] right-[5%] w-[35rem] h-[35rem] bg-yellow-600/5 rounded-full blur-[160px] pointer-events-none animate-pulse-slow" style="animation-delay: 3s"></div>
    <div class="absolute bottom-[20%] left-[15%] w-[45rem] h-[45rem] bg-amber-500/5 rounded-full blur-[180px] pointer-events-none animate-pulse-slow"></div>

    <!-- Floating Navigation Bar -->
    <header class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-6xl transition-all duration-300">
        <div class="glass-aether-panel px-6 py-4 rounded-2xl flex items-center justify-between shadow-2xl">
            <!-- Brand Logo -->
            <a href="#hero" class="flex items-center gap-3" id="nav-logo">
                <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=&quot;flex items-center gap-2.5&quot;><div class=&quot;w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-600 to-amber-500 flex items-center justify-center text-white font-extrabold text-lg shadow-lg shadow-amber-600/30 font-outfit&quot;>i</div><div class=&quot;flex flex-col&quot;><span class=&quot;font-extrabold text-sm text-white tracking-tight font-cabinet uppercase&quot;>Impetus</span><span class=&quot;text-[8px] font-semibold text-slate-400 tracking-widest uppercase -mt-0.5&quot;>eLearning Systems</span></div></div>'" alt="Impetus eLearning Solutions" class="h-10 w-auto object-contain">
            </a>

            <!-- Menu Navigation -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#hero" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-amber-500 transition-colors">Platform</a>
                <a href="#bento" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-amber-500 transition-colors">Bento Space</a>
                <a href="#proctor" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-amber-500 transition-colors">Control Deck</a>
                <a href="#roi-radial" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-amber-500 transition-colors">Radial ROI</a>
                <a href="#accreditation" class="text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-amber-500 transition-colors">CPD Boards</a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <a href="#contact" class="hidden sm:inline-block text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-white transition-colors">SSO Login</a>
                <a href="#contact" class="bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white px-5 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest shadow-lg shadow-amber-600/25 transition-all hover:scale-103 active:scale-97">
                    Request Demo
                </a>
            </div>
        </div>
    </header>

    <!-- Editorial Aether Hero Section -->
    <section id="hero" class="min-h-screen pt-36 pb-24 flex flex-col justify-center items-center relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <!-- Premium Badge -->
            <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-1.5 rounded-xl text-[10px] font-bold text-amber-500 uppercase tracking-widest mb-8 font-outfit shadow-md">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                Ecosystem Option 5: Aether Edition
            </div>

            <!-- Majestic Headline -->
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-[1.05] font-syne uppercase mb-6">
                Sculpting <span class="gradient-text-aether">Intellectual</span> <br>
                Capabilities.
            </h1>

            <p class="text-sm sm:text-base text-slate-400 leading-relaxed mb-12 max-w-2xl mx-auto font-sans">
                Experience the futuristic LMS benchmark. Impetus completely engineers continuing nursing education proctoring and audit databases to guarantee compliance, zero friction, and high-impact training indexes.
            </p>

            <!-- Action Triggers -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-24">
                <a href="#contact" class="w-full sm:w-auto bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white text-center px-8 py-4 rounded-xl text-xs font-bold uppercase tracking-widest shadow-xl shadow-amber-600/20 transition-all hover:-translate-y-0.5 active:translate-y-0 font-outfit">
                    Initiate Deployment
                </a>
                <a href="#bento" class="w-full sm:w-auto border border-slate-800 hover:border-amber-500 text-slate-300 hover:text-white text-center px-8 py-4 rounded-xl text-xs font-bold uppercase tracking-widest transition-all bg-white/5 backdrop-blur-md font-outfit">
                    Explore Bento Space &darr;
                </a>
            </div>
        </div>

        <!-- Dynamic Floating Bento Dashboard -->
        <div id="bento" class="w-[92%] max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-6 relative z-10">
            
            <!-- Box 1: Live CPD Credential Streamer (4 Cols) -->
            <div class="md:col-span-4 glass-aether-panel p-6 rounded-3xl glow-border flex flex-col justify-between h-[300px]" x-data="{
                institutions: ['Sterling Medical Center', 'Pacific Clinical Care', 'Ventura Health', 'Methodist Oncology', 'St. Jude Intensive Care'],
                currentIndex: 0,
                init() {
                    setInterval(() => {
                        this.currentIndex = (this.currentIndex + 1) % this.institutions.length;
                    }, 4000);
                }
            }">
                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                    <span class="text-[9px] font-bold text-amber-500 tracking-widest uppercase font-cabinet">LIVE CPD LOG STREAM</span>
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                </div>
                
                <div class="my-6 relative min-h-[100px] flex flex-col justify-center">
                    <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">Active Integration Facility</span>
                    <h3 class="text-xl font-bold font-outfit text-white tracking-wide transition-all duration-500" x-text="institutions[currentIndex]"></h3>
                    <p class="text-xs text-slate-400 mt-2 font-mono">[SUCCESS] SCORM 1.2 xAPI credential package injected successfully.</p>
                </div>

                <div class="bg-aether-950/80 p-3 rounded-xl border border-white/5 flex items-center justify-between">
                    <span class="text-[9px] font-bold text-slate-400">STATE CREDENTIAL INDEX:</span>
                    <span class="text-xs font-bold text-green-400">100.0% Verified</span>
                </div>
            </div>

            <!-- Box 2: The Credit Vault Simulator (4 Cols) -->
            <div class="md:col-span-4 glass-aether-panel p-6 rounded-3xl glow-border flex flex-col justify-between h-[300px] relative overflow-hidden" x-data="{
                creditCounter: 420,
                claimed: false,
                particles: [],
                claimCredits() {
                    if (this.claimed) return;
                    this.claimed = true;
                    
                    // Increment counter
                    let target = 465;
                    let current = 420;
                    let interval = setInterval(() => {
                        if (current < target) {
                            current++;
                            this.creditCounter = current;
                        } else {
                            clearInterval(interval);
                        }
                    }, 15);

                    // Spawn particles
                    for (let i = 0; i < 16; i++) {
                        this.particles.push({
                            id: i,
                            x: Math.random() * 100 - 50,
                            delay: i * 40
                        });
                    }
                }
            }">
                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                    <span class="text-[9px] font-bold text-amber-500 tracking-widest uppercase font-cabinet">CPD CREDIT VAULT</span>
                    <span class="text-[8px] bg-amber-600/20 text-amber-500 px-2 py-0.5 rounded font-bold">Interactive</span>
                </div>

                <!-- Particle simulation screen -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none rounded-3xl">
                    <template x-for="p in particles" :key="p.id">
                        <div class="gold-particle absolute w-2.5 h-2.5 rounded-full bg-amber-500 shadow-[0_0_10px_#EA580C]"
                             :style="`bottom: 40px; left: calc(50% + ${p.x}px); animation-delay: ${p.delay}ms;`"></div>
                    </template>
                </div>

                <div class="text-center my-4 relative z-10">
                    <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest block mb-1">TOTAL CPD CREDITS CLAIMED</span>
                    <span class="text-5xl font-extrabold text-white font-cabinet tracking-tight" x-text="creditCounter"></span>
                    <span class="text-xs text-slate-400 block mt-1 font-outfit">Audited Nursing Hours</span>
                </div>

                <button @click="claimCredits()" :disabled="claimed" :class="claimed ? 'bg-amber-600/20 border-amber-600/30 text-amber-500 cursor-not-allowed' : 'bg-gradient-to-r from-amber-600 to-amber-500 hover:scale-102 active:scale-98 text-white'" class="w-full text-center py-3.5 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all relative z-10 border border-transparent shadow-lg font-outfit">
                    <span x-text="claimed ? 'CPD CREDITS VERIFIED ✓' : 'CLAIM AUDITED CPD CREDIT'"></span>
                </button>
            </div>

            <!-- Box 3: Cognitive Memory Retention Dial (4 Cols) -->
            <div class="md:col-span-4 glass-aether-panel p-6 rounded-3xl glow-border flex flex-col justify-between h-[300px]" x-data="{
                activeRetention: 96,
                activeTab: 'impetus',
                setTab(tab, val) {
                    this.activeTab = tab;
                    this.activeRetention = val;
                }
            }">
                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                    <span class="text-[9px] font-bold text-amber-500 tracking-widest uppercase font-cabinet">MEMORY RETENTION RATING</span>
                    <div class="flex gap-1.5">
                        <button @click="setTab('traditional', 52)" :class="activeTab === 'traditional' ? 'bg-amber-600 text-white' : 'bg-white/5 text-slate-400 hover:text-white'" class="px-2 py-0.5 rounded text-[8px] font-extrabold uppercase transition-all">Trad</button>
                        <button @click="setTab('impetus', 96)" :class="activeTab === 'impetus' ? 'bg-amber-600 text-white' : 'bg-white/5 text-slate-400 hover:text-white'" class="px-2 py-0.5 rounded text-[8px] font-extrabold uppercase transition-all">Impetus</button>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-6 my-4">
                    <!-- Circular SVG Dial -->
                    <div class="relative w-24 h-24 flex items-center justify-center">
                        <svg class="w-24 h-24 transform -rotate-90">
                            <!-- Background track circle -->
                            <circle cx="48" cy="48" r="38" class="stroke-slate-800" stroke-width="6" fill="transparent"></circle>
                            <!-- Active progress circle -->
                            <circle cx="48" cy="48" r="38" class="stroke-amber-600 transition-all duration-[1000ms] ease-out" stroke-width="6" fill="transparent"
                                    stroke-dasharray="238.76"
                                    :stroke-dashoffset="238.76 * (1 - activeRetention / 100)"></circle>
                        </svg>
                        <div class="absolute text-center">
                            <span class="text-2xl font-bold font-cabinet text-white" x-text="activeRetention + '%'"></span>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h4 class="text-xs font-bold text-white uppercase tracking-wide" x-text="activeTab === 'impetus' ? 'Impetus Adaptive Engine' : 'Standard Manual Learning'"></h4>
                        <p class="text-[10px] text-slate-400 leading-relaxed mt-1" x-text="activeTab === 'impetus' ? 'Utilizes proctored modular scenarios with instant review rationales.' : 'Relies on static reading lists and paper sheets without active auditing.'"></p>
                    </div>
                </div>

                <div class="text-[9px] font-semibold text-slate-500 uppercase tracking-wider text-center">
                    COMPARE LEARNING METHODS RETENTIVITY
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Operational Statistics Banner -->
    <section class="border-y border-white/5 bg-aether-950 py-12 relative z-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-white/5">
            <div class="pt-4 md:pt-0">
                <span class="text-4xl lg:text-5xl font-extrabold text-white font-cabinet block tracking-tight">99.1%</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2 block font-outfit">Syllabus Ingestion Index</span>
            </div>
            <div class="pt-4 md:pt-0">
                <span class="text-4xl lg:text-5xl font-extrabold text-amber-500 font-cabinet block tracking-tight">4.92/5</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2 block font-outfit">Clinical User Rating</span>
            </div>
            <div class="pt-4 md:pt-0">
                <span class="text-4xl lg:text-5xl font-extrabold text-white font-cabinet block tracking-tight">3.1M+</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2 block font-outfit">Proctored Hours Injected</span>
            </div>
            <div class="pt-4 md:pt-0">
                <span class="text-4xl lg:text-5xl font-extrabold text-amber-500 font-cabinet block tracking-tight">100%</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2 block font-outfit">Auditing Trust Assurance</span>
            </div>
        </div>
    </section>

    <!-- Asymmetric Interactive LMS Control Deck Proctor Panel -->
    <section id="proctor" class="py-24" x-data="{ proctorMode: 'clinical' }">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">System Terminal</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-cabinet uppercase">LMS Control Deck Interface</h2>
                <p class="mt-4 text-slate-400 text-sm">Review proctored verification engines. Toggle tabs below to visualize CNE clinical proctoring, secure onboarding, or regulatory auditing scenarios.</p>
            </div>

            <!-- Terminal Mockup Panel -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                <!-- Browser Title Bar -->
                <div class="bg-slate-950 px-6 py-4 flex flex-wrap items-center justify-between border-b border-slate-850 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-slate-800"></span>
                        <span class="w-3 h-3 rounded-full bg-slate-800"></span>
                        <span class="w-3 h-3 rounded-full bg-slate-800"></span>
                        <span class="text-[10px] font-bold text-slate-400 tracking-wider ml-4 font-mono uppercase">CONSOLE_SSO_AUDITING: Active</span>
                    </div>

                    <!-- Alpine Tab controls -->
                    <div class="flex items-center bg-slate-900 rounded-lg p-1 border border-slate-800">
                        <button @click="proctorMode = 'clinical'" :class="proctorMode === 'clinical' ? 'bg-amber-600 text-white' : 'text-slate-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all">
                            1. Clinical Proctor
                        </button>
                        <button @click="proctorMode = 'onboard'" :class="proctorMode === 'onboard' ? 'bg-amber-600 text-white' : 'text-slate-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all">
                            2. Secure Onboarding
                        </button>
                        <button @click="proctorMode = 'audit'" :class="proctorMode === 'audit' ? 'bg-amber-600 text-white' : 'text-slate-400 hover:text-white'" class="px-4 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest transition-all">
                            3. Regulatory Audits
                        </button>
                    </div>
                </div>

                <!-- Simulation terminal body -->
                <div class="p-8 sm:p-12 text-slate-200 min-h-[380px] grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Code view left -->
                    <div class="lg:col-span-6 space-y-4">
                        <div x-show="proctorMode === 'clinical'" x-transition>
                            <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block mb-2 font-outfit">Active Proctor Verification</span>
                            <h3 class="text-2xl font-bold font-cabinet text-white uppercase mb-4">Frontline ICU Nursing Proctor</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mb-6">Impetus manages nurse licensing verification. When oncology infusions are logged, coordinates and user validation signatures are hashed instantly inside the SCORM engine.</p>
                            
                            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 font-mono text-[10px] text-green-400">
                                <div>&gt; HASHING verification token...</div>
                                <div class="text-white">md5::verify_cne_signature [PASSED]</div>
                                <div class="text-slate-500">Facility ID: sterl_med_01 | User: Evelyn Reed</div>
                            </div>
                        </div>

                        <div x-show="proctorMode === 'onboard'" x-transition style="display: none;">
                            <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block mb-2 font-outfit">Secure Staff Onboarding</span>
                            <h3 class="text-2xl font-bold font-cabinet text-white uppercase mb-4">Secure Corporate Integration</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mb-6">Perfect for strategic onboardings. Track HIPAA training speeds, check policy signatures, and register capability indexes before staff enter active patient lines.</p>
                            
                            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 font-mono text-[10px] text-green-400">
                                <div>&gt; CHECKING strategic HIPAA scores...</div>
                                <div class="text-amber-500">InfoSec Modules verified. Score: 100/100</div>
                                <div class="text-slate-500">Security Clearance Level II: APPROVED</div>
                            </div>
                        </div>

                        <div x-show="proctorMode === 'audit'" x-transition style="display: none;">
                            <span class="text-[10px] font-bold text-amber-500 uppercase tracking-widest block mb-2 font-outfit">Auditor Assurance</span>
                            <h3 class="text-2xl font-bold font-cabinet text-white uppercase mb-4">CPD State Audit Registry</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mb-6">Absolute peace of mind during licensing board audits. Impetus exports fully integrated CSV reports detailing verified test attempts, timestamps, and accredited certifications instantly.</p>
                            
                            <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 font-mono text-[10px] text-green-400">
                                <div>&gt; BUILDING comprehensive compliance spreadsheet...</div>
                                <div class="text-white">[ISO 27001 System Logs Verified]</div>
                                <div class="text-slate-500">4,120 proctored nursing records exported successfully.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview graphic right -->
                    <div class="lg:col-span-6 bg-slate-950 p-6 rounded-2xl border border-slate-800 relative overflow-hidden">
                        <div class="flex items-center justify-between border-b border-white/5 pb-3 mb-6">
                            <span class="text-[9px] font-mono text-slate-400 font-bold uppercase">SECURE PROCTOR PREVIEW</span>
                            <span class="text-[9px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded font-bold uppercase">active screen</span>
                        </div>

                        <!-- Graph elements simulating dashboard -->
                        <div class="space-y-4">
                            <div class="bg-slate-900 p-4 rounded-xl border border-slate-800">
                                <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">PROCTOR VERIFIED ENGINES</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-xl font-bold text-white font-outfit">3,120 logged</span>
                                    <span class="text-[10px] font-bold text-green-400 font-sans">&uarr; Absolute Integrity</span>
                                </div>
                                <div class="w-full bg-slate-950 h-1.5 rounded-full mt-2.5 overflow-hidden">
                                    <div class="bg-amber-600 h-full rounded-full transition-all duration-[1000ms]" :style="proctorMode === 'clinical' ? 'width: 100%' : (proctorMode === 'onboard' ? 'width: 78%' : 'width: 92%')"></div>
                                </div>
                            </div>

                            <div class="bg-slate-900 p-4 rounded-xl border border-slate-800">
                                <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">ACCURACY INDEX GAIN</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-xl font-bold text-white font-outfit">+44.8% tested</span>
                                    <span class="text-[10px] font-bold text-slate-400 font-sans">&uarr; Over manual</span>
                                </div>
                                <div class="w-full bg-slate-950 h-1.5 rounded-full mt-2.5 overflow-hidden">
                                    <div class="bg-amber-500 h-full rounded-full transition-all duration-[1000ms]" :style="proctorMode === 'clinical' ? 'width: 90%' : (proctorMode === 'onboard' ? 'width: 95%' : 'width: 82%')"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curved Circular ROI Optimization Wheel Section -->
    <section id="roi-radial" class="py-24 border-t border-white/5" x-data="{ scaleLearners: 500, scaleModules: 12 }">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-600/5 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Content info -->
                    <div class="lg:col-span-6">
                        <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">OPTIMIZATION MATHEMATICS</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-cabinet text-white uppercase mb-6">Radial ROI Matrix</h2>
                        <p class="text-sm text-slate-400 leading-relaxed mb-8">Manual learning compliance proctoring is labor-intensive and error-prone. Use our interactive optimizer dials to review exact capacity gains calculated instantly by the Impetus architecture.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-xs font-bold text-slate-300">Eliminates high-cost clinical auditor travel hours</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-xs font-bold text-slate-300">Generates instant state council credential packages</span>
                            </div>
                        </div>
                    </div>

                    <!-- Configurator Right -->
                    <div class="lg:col-span-6 bg-slate-950 p-6 sm:p-8 rounded-3xl border border-slate-800">
                        <h3 class="text-xs font-cabinet font-extrabold tracking-widest text-center text-slate-400 uppercase mb-8">Visual Optimizer</h3>

                        <!-- Sliders -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between text-[10px] font-bold text-slate-400 mb-2 font-cabinet uppercase">
                                <span>TOTAL COMPLIANCE LEARNERS</span>
                                <span class="text-amber-500 text-sm font-extrabold" x-text="scaleLearners"></span>
                            </div>
                            <input type="range" min="20" max="2500" step="20" x-model="scaleLearners" class="w-full h-2 bg-slate-850 rounded-lg appearance-none cursor-pointer accent-amber-600">
                        </div>

                        <div class="mb-8">
                            <div class="flex items-center justify-between text-[10px] font-bold text-slate-400 mb-2 font-cabinet uppercase">
                                <span>COMPLIANCE LESSONS CATALOG</span>
                                <span class="text-white text-sm font-extrabold" x-text="scaleModules + ' Lessons'"></span>
                            </div>
                            <input type="range" min="4" max="40" step="1" x-model="scaleModules" class="w-full h-2 bg-slate-850 rounded-lg appearance-none cursor-pointer accent-amber-500">
                        </div>

                        <!-- Radial SVG Displays -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- SVG Gauge 1 -->
                            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl flex flex-col items-center">
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest text-center block mb-3">ANNUAL TRAINING HOURS SAVED</span>
                                <div class="relative w-24 h-24 flex items-center justify-center">
                                    <svg class="w-24 h-24 transform -rotate-90">
                                        <circle cx="48" cy="48" r="38" class="stroke-slate-950" stroke-width="5" fill="transparent"></circle>
                                        <circle cx="48" cy="48" r="38" class="stroke-amber-600 transition-all duration-300" stroke-width="5" fill="transparent"
                                                stroke-dasharray="238.76"
                                                :stroke-dashoffset="238.76 * (1 - Math.min((scaleLearners * scaleModules * 1.45) / 50000, 1))"></circle>
                                    </svg>
                                    <div class="absolute">
                                        <span class="text-sm font-bold text-white font-outfit" x-text="Math.round(scaleLearners * scaleModules * 1.45)"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- SVG Gauge 2 -->
                            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl flex flex-col items-center">
                                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest text-center block mb-3">ESTIMATED REVENUE GAIN</span>
                                <div class="relative w-24 h-24 flex items-center justify-center">
                                    <svg class="w-24 h-24 transform -rotate-90">
                                        <circle cx="48" cy="48" r="38" class="stroke-slate-950" stroke-width="5" fill="transparent"></circle>
                                        <circle cx="48" cy="48" r="38" class="stroke-amber-500 transition-all duration-300" stroke-width="5" fill="transparent"
                                                stroke-dasharray="238.76"
                                                :stroke-dashoffset="238.76 * (1 - Math.min((scaleLearners * scaleModules * 12.8) / 500000, 1))"></circle>
                                    </svg>
                                    <div class="absolute">
                                        <span class="text-sm font-bold text-amber-500 font-outfit" x-text="'$' + Math.round(scaleLearners * scaleModules * 12.8)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#contact" class="block w-full text-center mt-6 bg-gradient-to-r from-amber-600 to-amber-500 text-white py-4 rounded-xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-amber-600/10 hover:scale-102 active:scale-98 transition-all font-outfit">
                            Get Custom ROI Report &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Regional Accreditation Pulse Map -->
    <section id="accreditation" class="py-24 bg-slate-950 border-t border-white/5" x-data="{ activeBoard: 'CA' }">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Regulatory Compliance</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-cabinet uppercase">National Accreditation Map</h2>
                <p class="mt-4 text-slate-400 text-sm">Select regulatory boards to review certified credential codes pre-injected into our state-approved SCORM modules.</p>
            </div>

            <!-- Bento selection grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto mb-12">
                <button @click="activeBoard = 'CA'" :class="activeBoard === 'CA' ? 'border-amber-600 bg-amber-600/10 text-white shadow-lg' : 'border-slate-800 bg-slate-900/40 text-slate-400 hover:border-slate-700'" class="p-6 border rounded-2xl flex flex-col justify-between items-center text-center transition-all h-[130px] font-outfit relative overflow-hidden" id="board-btn-ca">
                    <span class="text-[10px] font-bold text-slate-500 tracking-widest uppercase">California BRN</span>
                    <span class="text-xl font-bold font-cabinet">CA-770</span>
                    <div x-show="activeBoard === 'CA'" class="absolute bottom-2 w-2 h-2 rounded-full bg-amber-500 animate-ping"></div>
                </button>

                <button @click="activeBoard = 'TX'" :class="activeBoard === 'TX' ? 'border-amber-600 bg-amber-600/10 text-white shadow-lg' : 'border-slate-800 bg-slate-900/40 text-slate-400 hover:border-slate-700'" class="p-6 border rounded-2xl flex flex-col justify-between items-center text-center transition-all h-[130px] font-outfit relative overflow-hidden" id="board-btn-tx">
                    <span class="text-[10px] font-bold text-slate-500 tracking-widest uppercase">Texas BON</span>
                    <span class="text-xl font-bold font-cabinet">TX-190</span>
                    <div x-show="activeBoard === 'TX'" class="absolute bottom-2 w-2 h-2 rounded-full bg-amber-500 animate-ping"></div>
                </button>

                <button @click="activeBoard = 'FL'" :class="activeBoard === 'FL' ? 'border-amber-600 bg-amber-600/10 text-white shadow-lg' : 'border-slate-800 bg-slate-900/40 text-slate-400 hover:border-slate-700'" class="p-6 border rounded-2xl flex flex-col justify-between items-center text-center transition-all h-[130px] font-outfit relative overflow-hidden" id="board-btn-fl">
                    <span class="text-[10px] font-bold text-slate-500 tracking-widest uppercase">Florida BON</span>
                    <span class="text-xl font-bold font-cabinet">FL-990</span>
                    <div x-show="activeBoard === 'FL'" class="absolute bottom-2 w-2 h-2 rounded-full bg-amber-500 animate-ping"></div>
                </button>

                <button @click="activeBoard = 'CPD'" :class="activeBoard === 'CPD' ? 'border-amber-600 bg-amber-600/10 text-white shadow-lg' : 'border-slate-800 bg-slate-900/40 text-slate-400 hover:border-slate-700'" class="p-6 border rounded-2xl flex flex-col justify-between items-center text-center transition-all h-[130px] font-outfit relative overflow-hidden" id="board-btn-cpd">
                    <span class="text-[10px] font-bold text-slate-500 tracking-widest uppercase">CPD United Kingdom</span>
                    <span class="text-xl font-bold font-cabinet">UK-240</span>
                    <div x-show="activeBoard === 'CPD'" class="absolute bottom-2 w-2 h-2 rounded-full bg-amber-500 animate-ping"></div>
                </button>
            </div>

            <!-- Visual explanation block -->
            <div class="bg-slate-900 border border-slate-800 p-8 rounded-3xl max-w-4xl mx-auto">
                <div x-show="activeBoard === 'CA'" x-transition class="flex flex-col md:flex-row items-center gap-8 justify-between">
                    <div>
                        <h4 class="text-lg font-bold font-cabinet text-white uppercase mb-2">California Board of Registered Nursing Pre-Approved</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Impetus continuing education is accredited directly under license CA-770. Nurses completing oncological triage log 45 accredited proctored hours instantly into the state registry database.</p>
                    </div>
                    <span class="bg-amber-600/20 text-amber-500 px-4 py-2 rounded-xl border border-amber-600/20 text-xs font-bold font-mono tracking-widest shrink-0">CODE: CA-CPD-770</span>
                </div>

                <div x-show="activeBoard === 'TX'" x-transition style="display: none;" class="flex flex-col md:flex-row items-center gap-8 justify-between">
                    <div>
                        <h4 class="text-lg font-bold font-cabinet text-white uppercase mb-2">Texas Board of Nursing Pre-Approved</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Auditing coordinates map to Texas BON guidelines under registration TX-190. Complete proctored Final Exams in secure-browser modes for automated CPD points.</p>
                    </div>
                    <span class="bg-amber-600/20 text-amber-500 px-4 py-2 rounded-xl border border-amber-600/20 text-xs font-bold font-mono tracking-widest shrink-0">CODE: TX-BON-190</span>
                </div>

                <div x-show="activeBoard === 'FL'" x-transition style="display: none;" class="flex flex-col md:flex-row items-center gap-8 justify-between">
                    <div>
                        <h4 class="text-lg font-bold font-cabinet text-white uppercase mb-2">Florida Board of Nursing Pre-Approved</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Accredited under code FL-990. Complete modular clinical scenarios. Results sync seamlessly to CE Broker databases every 24 hours.</p>
                    </div>
                    <span class="bg-amber-600/20 text-amber-500 px-4 py-2 rounded-xl border border-amber-600/20 text-xs font-bold font-mono tracking-widest shrink-0">CODE: FL-BON-990</span>
                </div>

                <div x-show="activeBoard === 'CPD'" x-transition style="display: none;" class="flex flex-col md:flex-row items-center gap-8 justify-between">
                    <div>
                        <h4 class="text-lg font-bold font-cabinet text-white uppercase mb-2">CPD Certification Standards UK Pre-Approved</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">International SCORM courseware certification matching standard LTI specifications. Pre-approved across 45 CPD hours matching corporate security mandates.</p>
                    </div>
                    <span class="bg-amber-600/20 text-amber-500 px-4 py-2 rounded-xl border border-amber-600/20 text-xs font-bold font-mono tracking-widest shrink-0">CODE: UK-CPD-240</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Syllabus Explorer -->
    <section class="py-24 border-t border-white/5" x-data="{ showSyllabus: 1 }">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Pre-Accredited catalogs</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight font-cabinet uppercase">Explore Pre-approved Courseware</h2>
                <p class="mt-4 text-slate-400 text-sm">We provide pre-approved, highly certified training content modules that can be custom loaded directly to your Impetus LMS catalog.</p>
            </div>

            <!-- Horizontal Tab Controls -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button @click="showSyllabus = 1" :class="showSyllabus === 1 ? 'bg-gradient-to-r from-amber-600 to-amber-500 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:bg-slate-850 hover:text-white'" class="px-6 py-3.5 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                    Module 1: Oncology & Chemotherapy
                </button>
                <button @click="showSyllabus = 2" :class="showSyllabus === 2 ? 'bg-gradient-to-r from-amber-600 to-amber-500 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:bg-slate-850 hover:text-white'" class="px-6 py-3.5 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                    Module 2: ICU & Triage checklists
                </button>
                <button @click="showSyllabus = 3" :class="showSyllabus === 3 ? 'bg-gradient-to-r from-amber-600 to-amber-500 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:bg-slate-850 hover:text-white'" class="px-6 py-3.5 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                    Module 3: InfoSec & ISO Compliance
                </button>
            </div>

            <!-- Tab Contents -->
            <div class="bg-slate-900 border border-slate-800 p-8 sm:p-12 rounded-[2rem] max-w-4xl mx-auto shadow-2xl">
                <!-- Module 1 -->
                <div x-show="showSyllabus === 1" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white font-cabinet uppercase mb-4">Critical ICU Oncology &amp; Chemotherapy</h3>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-6">Designed under direct state board oversight. We provide oncology chemotherapy infusion training covering double-signoff verification, secure vascular access checking, and emergency oncology triage protocols.</p>
                        
                        <ul class="space-y-3 mb-8 text-xs font-semibold text-slate-300">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>6,000+ interactive practice MCQ rationales</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Fully secure SCORM / LTI-compatible framework</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>45 CNE points registered to final digital certificate</span>
                            </li>
                        </ul>

                        <a href="#contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-amber-600/10 hover:scale-102 active:scale-98 transition-all font-outfit">
                            Request Syllabus PDF &rarr;
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-800">
                            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80" alt="Oncology CNE Demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-slate-950/90 text-white p-3 rounded-xl border border-white/5 text-[10px] font-bold font-cabinet">
                                45 CNE POINTS APPROVED
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 2 -->
                <div x-show="showSyllabus === 2" x-transition style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white font-cabinet uppercase mb-4">Intensive Care &amp; Cardiovascular Triage</h3>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-6">Equip frontline nurses with critical triage protocols. Modular pathways cover trauma care, elderly ICU checks, sepsis proctoring controls, and vascular checks.</p>
                        
                        <ul class="space-y-3 mb-8 text-xs font-semibold text-slate-300">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Accredited ICU triage decision trees</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Real-time proctor verification tools</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>35 CNE points registered to final digital certificate</span>
                            </li>
                        </ul>

                        <a href="#contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-amber-600/10 hover:scale-102 active:scale-98 transition-all font-outfit">
                            Request Syllabus PDF &rarr;
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-800">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" alt="ICU CNE Demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-slate-950/90 text-white p-3 rounded-xl border border-white/5 text-[10px] font-bold font-cabinet">
                                35 CNE POINTS APPROVED
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Module 3 -->
                <div x-show="showSyllabus === 3" x-transition style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white font-cabinet uppercase mb-4">HIPAA &amp; ISO Auditing Information Security</h3>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-6">Designed for corporate staff onboarding. Complete strategic HIPAA training, check ISO 27001 data compliance indices, and manage proctor logs cleanly.</p>
                        
                        <ul class="space-y-3 mb-8 text-xs font-semibold text-slate-300">
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Interactive corporate phishing drills</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Automated ISO 27001 system compliance logs</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Certified strategic corporate onboarding index</span>
                            </li>
                        </ul>

                        <a href="#contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 text-white px-6 py-3 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-amber-600/10 hover:scale-102 active:scale-98 transition-all font-outfit">
                            Request Syllabus PDF &rarr;
                        </a>
                    </div>
                    <div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-800">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="InfoSec Demonstration" class="w-full h-64 object-cover">
                            <div class="absolute bottom-4 left-4 bg-slate-950/90 text-white p-3 rounded-xl border border-white/5 text-[10px] font-bold font-cabinet">
                                ISO COMPLIANCE CERTIFICATION
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sleek Enterprise Testimonial Section -->
    <section class="py-24 bg-slate-900 border-t border-white/5 text-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Enterprise Endorsements</span>
                <h2 class="text-3xl font-extrabold tracking-tight font-cabinet uppercase text-white">Client Success Stories</h2>
            </div>

            <!-- Glass Card Quote Box -->
            <div class="max-w-4xl mx-auto bg-slate-950 border border-slate-800 p-8 sm:p-12 rounded-[2rem] shadow-2xl relative">
                <!-- Golden Quote Mark indicator -->
                <div class="absolute top-6 left-6 text-amber-600/10 font-cabinet font-extrabold text-[8rem] leading-none pointer-events-none select-none">
                    “
                </div>

                <blockquote class="text-lg sm:text-xl md:text-2xl font-semibold leading-relaxed text-slate-200 relative z-10 mb-8 font-sans">
                    "Option 5's CNE and training databases represent an outstanding technology advancement. Impetus streamlined our state council audits and proctor log verifications into a completely transparent, friction-free portal."
                </blockquote>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-600 to-amber-500 flex items-center justify-center font-bold text-white font-cabinet uppercase">
                        rs
                    </div>
                    <div>
                        <cite class="text-xs font-bold text-white uppercase tracking-widest not-italic block">Director Robert Sterling</cite>
                        <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider mt-0.5">Chief of Clinical Operations, Sterling Medical Center</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Lead Capture Integration Request Panel -->
    <section id="contact" class="py-24 bg-aether-950 border-t border-white/5 relative">
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <span class="text-amber-500 font-bold text-xs uppercase tracking-widest block mb-3 font-outfit">Integration Desk</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-cabinet uppercase mb-6 text-white">Initiate a Strategic Analysis</h2>
            <p class="text-sm text-slate-400 leading-relaxed max-w-xl mx-auto mb-12 font-sans">Submit your team size and licensing requirements. An Impetus eLearning Architect will prepare a customized system integration analysis for your team review.</p>

            <form onsubmit="event.preventDefault(); alert('Your custom Aether integration request was submitted successfully.');" class="text-left bg-slate-900 border border-slate-800 p-8 sm:p-12 shadow-2xl max-w-2xl mx-auto rounded-[2rem]">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-cabinet">Representative Name</label>
                        <input type="text" required class="w-full bg-slate-950 border border-slate-800 rounded-xl focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white" placeholder="Dr. Evelyn Reed">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-cabinet">Official Email Address</label>
                        <input type="email" required class="w-full bg-slate-950 border border-slate-800 rounded-xl focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white" placeholder="evelyn@sterlingmedical.org">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-cabinet">Primary Integration Scope</label>
                    <select class="w-full bg-slate-950 border border-slate-800 rounded-xl focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-slate-300 appearance-none">
                        <option>Accredited Continuing Nursing Education (CNE)</option>
                        <option>Strategic Corporate Onboarding &amp; Compliance</option>
                        <option>Custom SCORM / LTI Auditing Integration</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 font-cabinet">Brief Overview of Operational Challenges</label>
                    <textarea class="w-full bg-slate-950 border border-slate-800 rounded-xl focus:border-amber-600 focus:ring-1 focus:ring-amber-600 focus:outline-none px-4 py-3 text-xs font-bold uppercase tracking-wider text-white h-28 resize-none" placeholder="Detail your licensing, proctor, or user scale parameters..."></textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white py-4 rounded-xl text-xs font-extrabold uppercase tracking-widest transition-all font-outfit shadow-lg shadow-amber-600/10">
                    Request Integration Analysis
                </button>
            </form>
        </div>
    </section>

    <!-- Minimal High-Contrast Footer -->
    <footer class="bg-slate-950 border-t border-slate-900 py-16 text-slate-500 text-xs">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('IEB_original_logo.png') }}" onerror="this.onerror=null; this.outerHTML='<div class=&quot;flex items-center gap-2.5&quot;><div class=&quot;w-8 h-8 rounded-lg bg-amber-600 flex items-center justify-center text-white font-extrabold text-sm font-cabinet&quot;>i</div><span class=&quot;font-bold text-white text-sm uppercase tracking-widest font-cabinet&quot;>Impetus</span></div>'" alt="Impetus eLearning Solutions" class="h-10 w-auto object-contain">
                    </div>
                    <p class="text-[10px] text-slate-500 leading-relaxed">Accredited continuing professional learning databases engineered for maximum clinical audit accuracy.</p>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">Core Catalog</h4>
                    <ul class="space-y-2 text-[10px] font-semibold">
                        <li><a href="#accreditation" class="hover:text-amber-500 transition-colors">Oncology CNE</a></li>
                        <li><a href="#accreditation" class="hover:text-amber-500 transition-colors">ICU Triage Checklist</a></li>
                        <li><a href="#accreditation" class="hover:text-amber-500 transition-colors">InfoSec Security Compliance</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">Control Center</h4>
                    <ul class="space-y-2 text-[10px] font-semibold">
                        <li><a href="#bento" class="hover:text-amber-500 transition-colors">Bento Space</a></li>
                        <li><a href="#proctor" class="hover:text-amber-500 transition-colors">Proctor Simulator</a></li>
                        <li><a href="#roi-radial" class="hover:text-amber-500 transition-colors">Radial ROI Calculator</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[9px] font-bold text-white uppercase tracking-widest mb-4 font-cabinet">Systems Desk</h4>
                    <ul class="space-y-2 text-[10px] text-slate-300 font-bold">
                        <li>General Desk: architect@impetus-elearning.com</li>
                        <li>Technical Desk: support@impetus-elearning.com</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-[9px] text-slate-500 font-semibold">
                <span>&copy; 2026 Impetus eLearning Solutions. All rights reserved.</span>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Specifications</a>
                    <a href="#" class="hover:text-white transition-colors">SCORM Compliance Certification</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
