<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/venture.svg') }}">
    <title>Compassionate Care Nursing | {{ config('app.name', 'Impetus') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback if Vite is not running -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style>
            @theme {
                --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                --font-serif: 'Playfair Display', ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
                --color-logo-light-green: #83ba2d;
                --color-logo-blue: #0082c9;
                --color-brand-900: #163a5a;
            }
            body { 
                font-family: var(--font-sans);
                background-image: radial-gradient(#83ba2d10 1px, transparent 1px);
                background-size: 40px 40px;
            }
            h1, h2, h3, .font-serif { font-family: var(--font-serif); }
            
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 { animation-delay: 2s; }
            .animation-delay-4000 { animation-delay: 4s; }
        </style>
    @endif
    
    <!-- AlpineJS for mobile menu and animations -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- Navigation -->
    <header x-data="{ mobileMenuOpen: false, scrolled: true }" 
            @scroll.window="scrolled = (window.pageYOffset > 50)"
            class="fixed top-4 inset-x-4 z-50 max-w-5xl mx-auto rounded-full bg-white/70 backdrop-blur-xl border border-slate-200/50 shadow-2xl py-2 px-6 transition-all duration-500">
        <nav class="flex items-center justify-between mx-auto" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5 flex items-center gap-2 group transition-transform hover:scale-105">
                    <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-9 w-auto">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-slate-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="#home" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green transition-colors">Home</a>
                <a href="#about" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green transition-colors">About Us</a>
                <a href="#services" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green transition-colors">Services</a>
                <a href="#testimonials" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green transition-colors">Testimonials</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-4 items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium leading-6 text-slate-900 hover:text-logo-light-green">Log in</a>
                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-full bg-logo-light-green px-4 py-2 text-sm font-medium text-white shadow-sm hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-logo-light-green transition-all transform hover:-translate-y-0.5">Register</a>
                        @endif --}}
                    @endauth
                @endif
            </div>
        </nav>
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" class="lg:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-50 bg-black/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-slate-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5 flex items-center gap-2">
                        <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-10 w-auto">
                    </a>
                    <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-slate-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-slate-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#home" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Home</a>
                            <a href="#about" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">About Us</a>
                            <a href="#services" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Services</a>
                            <a href="#testimonials" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Testimonials</a>
                        </div>
                        <div class="py-6">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero section -->
        <div id="home" class="relative isolate pt-24 overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-logo-light-green/10 rounded-full blur-[100px] animate-blob"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-logo-blue/10 rounded-full blur-[100px] animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-20 left-1/2 w-80 h-80 bg-logo-light-green/10 rounded-full blur-[100px] animate-blob animation-delay-4000"></div>

            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-logo-blue/20 to-logo-light-green/30 opacity-40 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-6 py-24 sm:py-32 lg:px-8 lg:py-40">
                <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                    <div class="lg:col-span-6 text-center lg:text-left">
                        <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-3 py-1 text-sm font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20 mb-6">
                            #1 Rated Nursing Care Provider
                        </span>
                        <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl font-serif">
                            Compassionate care <br class="hidden lg:block"> you can trust.
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-600">
                            Our team of highly-trained, dedicated nurses provides personalized medical care right in the comfort of your home. We treat every patient like family.
                        </p>
                        <div class="mt-10 flex items-center justify-center lg:justify-start gap-x-8">
                            <a href="#services" class="rounded-full bg-logo-light-green px-8 py-4 text-base font-bold text-white shadow-[0_10px_30px_rgba(131,186,45,0.4)] hover:shadow-[0_15px_40px_rgba(131,186,45,0.6)] hover:-translate-y-1 transition-all transform duration-300">Explore Services</a>
                            <a href="#about" class="text-base font-bold leading-6 text-brand-900 group flex items-center gap-3 hover:text-logo-light-green transition-colors">
                                <div class="bg-logo-light-green/10 p-2 rounded-full group-hover:bg-logo-light-green/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </div>
                                Learn more
                            </a>
                        </div>
                        
                        <div class="mt-12 grid grid-cols-3 gap-4 border-t border-slate-200 pt-8 sm:mt-16 text-left">
                            <div>
                                <h3 class="text-3xl font-bold tracking-tight text-slate-900">24/7</h3>
                                <p class="text-sm text-slate-500 mt-1">Available Care</p>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold tracking-tight text-slate-900">98%</h3>
                                <p class="text-sm text-slate-500 mt-1">Patient Satisfaction</p>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold tracking-tight text-slate-900">500+</h3>
                                <p class="text-sm text-slate-500 mt-1">Certified Nurses</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-16 lg:mt-0 lg:col-span-6 relative group">
                        <div class="relative rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.2)] transform transition-all duration-700 group-hover:scale-[1.02] group-hover:-rotate-1">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-900/60 via-transparent to-transparent z-10"></div>
                            <img src="{{ asset('images/nursing_hero.png') }}" onerror="this.src='https://images.unsplash.com/photo-1584515933487-779824d29309?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'" alt="Professional Nurse" class="w-full h-[650px] object-cover">
                            <div class="absolute bottom-8 left-8 right-8 z-20 bg-white/80 backdrop-blur-xl p-6 rounded-2xl shadow-2xl border border-white/40 flex items-center gap-5 transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                                <div class="bg-logo-light-green/20 p-4 rounded-full text-logo-light-green shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-brand-900 text-lg">Emergency Response</h4>
                                    <p class="text-sm text-slate-600 font-medium tracking-wide">Fast, reliable medical attention.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative element -->
                        <div class="absolute -top-12 -right-12 -z-10 bg-logo-light-green/30 w-48 h-48 rounded-full blur-[80px] opacity-60 animate-pulse"></div>
                        <div class="absolute -bottom-12 -left-12 -z-10 bg-logo-blue/30 w-56 h-56 rounded-full blur-[80px] opacity-60 animate-pulse animation-delay-2000"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About section -->
        <div id="about" class="overflow-hidden bg-white/50 py-24 sm:py-32 relative" x-data="{ revealed: false }" x-intersect.once="revealed = true">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 transition-all duration-1000 transform" :class="revealed ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-16 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 items-center">
                    <div class="lg:pr-8 lg:pt-4">
                        <div class="lg:max-w-lg">
                            <h2 class="text-base font-semibold leading-7 text-logo-light-green">About Venture</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl font-serif">Dedicated to your health and well-being</p>
                            <p class="mt-6 text-lg leading-8 text-slate-600">
                                Founded on the principles of empathy, integrity, and excellence, Venture has been serving the community for over a decade. We believe that healing happens best in a comfortable, familiar environment.
                            </p>
                            <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-slate-600 lg:max-w-none">
                                <div class="relative pl-9">
                                    <dt class="inline font-semibold text-slate-900">
                                        <svg class="absolute left-1 top-1 h-5 w-5 text-logo-light-green" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                        </svg>
                                        Licensed Professionals.
                                    </dt>
                                    <dd class="inline">Every nurse in our team is fully licensed, background-checked, and continuously trained on modern medical practices.</dd>
                                </div>
                                <div class="relative pl-9">
                                    <dt class="inline font-semibold text-slate-900">
                                        <svg class="absolute left-1 top-1 h-5 w-5 text-logo-light-green" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M10 1a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 1zM5.05 3.05a.75.75 0 011.06 0l1.06 1.06a.75.75 0 11-1.06 1.06L5.05 4.11a.75.75 0 010-1.06zM16.95 3.05a.75.75 0 010 1.06l-1.06 1.06a.75.75 0 11-1.06-1.06l1.06-1.06a.75.75 0 011.06 0zM19 10a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5A.75.75 0 0119 10zM1 10a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5A.75.75 0 011 10zm15.95 6.95a.75.75 0 011.06 0l1.06 1.06a.75.75 0 11-1.06 1.06l-1.06-1.06a.75.75 0 010-1.06zM3.99 16.95a.75.75 0 010 1.06l-1.06 1.06a.75.75 0 11-1.06-1.06l1.06-1.06a.75.75 0 011.06 0zM10 19a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 19zM10 5a5 5 0 100 10 5 5 0 000-10z" />
                                        </svg>
                                        Holistic Approach.
                                    </dt>
                                    <dd class="inline">We focus on physical, emotional, and social well-being to ensure comprehensive recovery and comfort.</dd>
                                </div>
                                <div class="relative pl-9">
                                    <dt class="inline font-semibold text-slate-900">
                                        <svg class="absolute left-1 top-1 h-5 w-5 text-logo-light-green" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm.75 5a.75.75 0 011.5 0v4.279l3.02 1.745a.75.75 0 11-.75 1.3L11 12.28V7z" clip-rule="evenodd" />
                                        </svg>
                                        Flexible Schedules.
                                    </dt>
                                    <dd class="inline">Whether you need hourly, daily, or live-in care, we customize our plans to fit your family's unique lifestyle.</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('images/nursing_team.png') }}" onerror="this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'" alt="Nursing Team" class="w-full max-w-none rounded-2xl shadow-xl ring-1 ring-slate-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0 object-cover h-[500px]" />
                        <div class="absolute -inset-4 rounded-2xl ring-1 ring-inset ring-slate-900/10 -z-10 bg-logo-light-green/10"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services section -->
        <div id="services" class="bg-slate-50/50 py-24 sm:py-32 relative overflow-hidden" x-data="{ revealed: false }" x-intersect.once="revealed = true">
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-logo-blue/5 rounded-full blur-[100px]"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8 transition-all duration-1000 transform" :class="revealed ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-logo-light-green tracking-widest uppercase">Our Services</h2>
                    <p class="mt-2 text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl font-serif">Comprehensive Nursing Care</p>
                    <p class="mt-6 text-lg leading-8 text-slate-600">We offer a wide range of medical and non-medical services tailored to meet the specific needs of our patients.</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                    <div class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                        
                        <!-- Service Card -->
                        <div class="flex flex-col bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] shadow-sm border border-white/40 hover:shadow-[0_20px_50px_rgba(131,186,45,0.15)] hover:border-logo-light-green/30 transition-all hover:-translate-y-2 transform duration-500 group">
                            <div class="mb-8 h-56 w-full overflow-hidden rounded-3xl shadow-lg ring-1 ring-black/5">
                                <img src="{{ asset('images/elderly_care.png') }}" onerror="this.src='https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" alt="Elderly Care" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <dt class="flex items-center gap-x-3 text-xl font-semibold leading-7 text-slate-900">
                                Elderly Care
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                                <p class="flex-auto">Compassionate assistance with daily living activities, medication management, and mobility support for seniors to live safely at home.</p>
                                <p class="mt-6">
                                    <a href="#" class="text-sm font-semibold leading-6 text-logo-light-green hover:opacity-90">Learn more <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>

                        <!-- Service 2 -->
                        <div class="flex flex-col bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] shadow-sm border border-white/40 hover:shadow-[0_20px_50px_rgba(131,186,45,0.15)] hover:border-logo-light-green/30 transition-all hover:-translate-y-2 transform duration-500 group">
                            <div class="mb-8 h-56 w-full overflow-hidden rounded-3xl shadow-lg ring-1 ring-black/5">
                                <img src="{{ asset('images/post_surgery.png') }}" onerror="this.src='https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" alt="Post-Surgery Recovery" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <dt class="flex flex-col text-xl font-semibold leading-7 text-slate-900">
                                Post-Surgery Recovery
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                                <p class="flex-auto">Expert wound care, pain management, and rehabilitation assistance to speed up recovery after hospital discharge.</p>
                                <p class="mt-6">
                                    <a href="#" class="text-sm font-semibold leading-6 text-logo-light-green hover:opacity-90">Learn more <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>

                        <!-- Service 3 -->
                        <div class="flex flex-col bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] shadow-sm border border-white/40 hover:shadow-[0_20px_50px_rgba(131,186,45,0.15)] hover:border-logo-light-green/30 transition-all hover:-translate-y-2 transform duration-500 group">
                            <div class="mb-8 h-56 w-full overflow-hidden rounded-3xl shadow-lg ring-1 ring-black/5">
                                <img src="{{ asset('images/therapy.png') }}" onerror="this.src='https://images.unsplash.com/photo-1576091160550-217359f42f8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" alt="Specialized Therapy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <dt class="flex flex-col text-xl font-semibold leading-7 text-slate-900">
                                Specialized Therapy
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                                <p class="flex-auto">Physical, occupational, and speech therapy provided by certified professionals to improve functionality and independence.</p>
                                <p class="mt-6">
                                    <a href="#" class="text-sm font-semibold leading-6 text-logo-light-green hover:opacity-90">Learn more <span aria-hidden="true">→</span></a>
                                </p>
                            </dd>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div id="testimonials" class="bg-white/50 py-24 sm:py-32 relative overflow-hidden" x-data="{ revealed: false }" x-intersect.once="revealed = true">
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-80 h-80 bg-logo-light-green/5 rounded-full blur-[100px]"></div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8 transition-all duration-1000 transform" :class="revealed ? 'opacity-100' : 'opacity-0 translate-y-10'">
                <div class="mx-auto max-w-xl text-center">
                    <h2 class="text-lg font-semibold leading-8 tracking-tight text-logo-light-green tracking-widest uppercase">Testimonials</h2>
                    <p class="mt-2 text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl font-serif">Hear from our patients</p>
                </div>
                <div class="mx-auto mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-2xl lg:mx-0 lg:max-w-none">
                    
                    <figure class="rounded-[2rem] bg-white/60 backdrop-blur-md p-10 text-sm leading-6 border border-white/40 shadow-xl h-full flex flex-col justify-between hover:border-logo-blue/30 transition-all duration-500">
                        <blockquote class="text-slate-900">
                            <p>"The level of care and attention my mother received from Venture was outstanding. The nurses were not only highly skilled but incredibly compassionate."</p>
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-x-4">
                            <div class="h-10 w-10 rounded-full bg-logo-light-green/10 flex items-center justify-center font-bold text-logo-light-green">SJ</div>
                            <div>
                                <div class="font-semibold text-slate-900">Sarah Jenkins</div>
                                <div class="text-slate-600">Family Member</div>
                            </div>
                        </figcaption>
                    </figure>

                    <figure class="rounded-[2rem] bg-white/60 backdrop-blur-md p-10 text-sm leading-6 border border-white/40 shadow-xl h-full flex flex-col justify-between hover:border-logo-blue/30 transition-all duration-500">
                        <blockquote class="text-slate-900 italic">
                            <p>"After my surgery, I was worried about my recovery at home. The daily visits from the nursing team gave me peace of mind and helped me heal faster than expected."</p>
                        </blockquote>
                        <figcaption class="mt-8 flex items-center gap-x-4 border-t border-slate-200/50 pt-6">
                            <div class="h-12 w-12 rounded-full bg-logo-light-green/20 flex items-center justify-center font-bold text-logo-light-green shadow-inner">MR</div>
                            <div>
                                <div class="font-bold text-brand-900">Michael Roberts</div>
                                <div class="text-xs font-semibold text-logo-light-green uppercase tracking-wider">Patient</div>
                            </div>
                        </figcaption>
                    </figure>

                    <figure class="rounded-[2rem] bg-white/60 backdrop-blur-md p-10 text-sm leading-6 border border-white/40 shadow-xl h-full flex flex-col justify-between hover:border-logo-blue/30 transition-all duration-500">
                        <blockquote class="text-slate-900 italic">
                            <p>"Professional, punctual, and remarkably kind. The therapists and nurses truly focus on your holistic well-being. Highly recommended for any home care needs."</p>
                        </blockquote>
                        <figcaption class="mt-8 flex items-center gap-x-4 border-t border-slate-200/50 pt-6">
                            <div class="h-12 w-12 rounded-full bg-logo-light-green/20 flex items-center justify-center font-bold text-logo-light-green shadow-inner">EL</div>
                            <div>
                                <div class="font-bold text-brand-900">Emily Lawson</div>
                                <div class="text-xs font-semibold text-logo-light-green uppercase tracking-wider">Patient</div>
                            </div>
                        </figcaption>
                    </figure>

                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-brand-900 relative overflow-hidden py-24 sm:py-32" x-data="{ revealed: false }" x-intersect.once="revealed = true">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-logo-blue/20 via-transparent to-logo-light-green/10"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-logo-blue/20 rounded-full blur-[120px]"></div>
            
            <div class="px-6 relative z-10 transition-all duration-1000 transform" :class="revealed ? 'scale-100 opacity-100' : 'scale-95 opacity-0'">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-4xl font-bold tracking-tight text-white sm:text-6xl font-serif leading-tight">
                        Ready to experience <br> premium care?
                    </h2>
                    <p class="mx-auto mt-8 max-w-xl text-lg leading-8 text-slate-300">
                        Our care coordinators are available 24/7 to answer your questions and help set up a personalized care plan for you or your loved ones.
                    </p>
                    <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="#contact" class="rounded-full bg-logo-light-green px-8 py-4 text-base font-bold text-white shadow-[0_10px_30px_rgba(131,186,45,0.4)] hover:shadow-[0_15px_40px_rgba(131,186,45,0.6)] hover:-translate-y-1 transition-all transform duration-300">Book a Consultation</a>
                        <a href="tel:+18001234567" class="text-lg font-bold leading-6 text-white group flex items-center gap-3 hover:text-logo-light-green transition-colors">
                            <div class="bg-white/10 p-3 rounded-full group-hover:bg-logo-light-green/20 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            1-800-123-4567
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-brand-900 border-t border-white/5" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-12 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-12">
                <div class="space-y-10 xl:col-span-1">
                    <div class="flex items-center gap-2 transition-transform hover:scale-105">
                        <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-10 w-auto brightness-0 invert">
                    </div>
                    <p class="text-sm leading-6 text-slate-300">Making professional and compassionate home nursing care accessible to everyone who needs it.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-slate-400 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-slate-400 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#about" class="text-sm leading-6 text-slate-300 hover:text-white">About</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-slate-300 hover:text-white">Careers</a>
                                </li>
                                <li>
                                    <a href="#services" class="text-sm leading-6 text-slate-300 hover:text-white">Services</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-slate-300 hover:text-white">Partners</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 id="contact" class="text-sm font-semibold leading-6 text-white">Contact Info</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <span class="text-sm leading-6 text-slate-300">123 Health Avenue</span>
                                </li>
                                <li>
                                    <span class="text-sm leading-6 text-slate-300">New York, NY 10001</span>
                                </li>
                                <li>
                                    <a href="mailto:info@careconnect.com" class="text-sm leading-6 text-slate-300 hover:text-white">info@careconnect.com</a>
                                </li>
                                <li>
                                    <a href="tel:+18001234567" class="text-sm leading-6 text-slate-300 hover:text-white">1-800-123-4567</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm leading-6 text-slate-300 hover:text-white">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-slate-300 hover:text-white">Terms of Service</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-slate-300 hover:text-white">Patient Rights</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs leading-5 text-slate-400 font-medium tracking-wider uppercase">&copy; {{ date('Y') }} Venture Nursing Services. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-xs text-slate-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-xs text-slate-400 hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
