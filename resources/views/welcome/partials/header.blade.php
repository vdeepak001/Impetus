<!-- Navigation -->
<header x-data="{ mobileMenuOpen: false, scrolled: true }"
        @scroll.window="scrolled = (window.pageYOffset > 50)"
        class="fixed top-4 inset-x-4 z-50 max-w-7xl mx-auto rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200/70 shadow-2xl py-3 px-6 transition-all duration-500">
    <nav class="mx-auto w-full" aria-label="Global">
        <div class="flex items-center justify-between gap-4">
            <a href="#" class="-m-1.5 p-1.5 flex items-center gap-2 group transition-transform hover:scale-105">
                <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-12 w-auto">
            </a>

            <div class="hidden lg:flex lg:items-center lg:justify-center lg:gap-2 xl:gap-3">
                <a href="#home" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">Home</a>
                <a href="#about" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">About Us</a>
                <a href="#cne-modules" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">CNE Modules</a>
                <a href="#cpd-certification" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">CPD Certification</a>
                <a href="#learning-materials" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">Learning Materials</a>
                <a href="#practice-test" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">Practice Test</a>
                <a href="#online-exam" class="rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">Online Exam</a>
            </div>

            <div class="flex lg:hidden">
                <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-slate-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

            <div class="hidden lg:flex items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-900 transition-colors hover:border-logo-light-green hover:text-logo-light-green">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-900 transition-colors hover:border-logo-light-green hover:text-logo-light-green">Log in</a>
                    @endauth
                @endif
            </div>
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
                        <a href="#cne-modules" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">CNE Modules</a>
                        <a href="#cpd-certification" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">CPD Certification</a>
                        <a href="#learning-materials" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Learning Materials</a>
                        <a href="#practice-test" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Practice Test</a>
                        <a href="#online-exam" @click="mobileMenuOpen = false" class="-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Online Exam</a>
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
