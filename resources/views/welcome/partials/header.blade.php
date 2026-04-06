@php
    $navDesktopClass = fn (string $routeName): string => request()->routeIs($routeName)
        ? 'rounded-full px-3 py-2 text-sm font-semibold text-logo-light-green bg-logo-light-green/15 transition-colors'
        : 'rounded-full px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green';
    $navMobileClass = fn (string $routeName): string => request()->routeIs($routeName)
        ? '-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-logo-light-green bg-logo-light-green/10'
        : '-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50';
@endphp
<!-- Navigation: mobile menu is a sibling of <header> so position:fixed overlays are not trapped by backdrop-blur (containing block). -->
<div
    x-data="{ mobileMenuOpen: false, scrolled: true }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    @keydown.escape.window="mobileMenuOpen = false"
>
<header class="fixed top-4 inset-x-4 z-50 max-w-7xl mx-auto rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200/70 shadow-2xl py-3 px-6 transition-all duration-500">
    <nav class="mx-auto w-full" aria-label="Global">
        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5 flex items-center gap-2 group transition-transform hover:scale-105">
                <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-16 w-auto">
            </a>

            <div class="hidden lg:flex lg:items-center lg:justify-center lg:gap-2 xl:gap-3">
                <a href="{{ route('home') }}" class="{{ $navDesktopClass('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                <a href="{{ route('about') }}" class="{{ $navDesktopClass('about') }}" @if (request()->routeIs('about')) aria-current="page" @endif>About Us</a>
                <a href="{{ route('cne.modules') }}" class="{{ $navDesktopClass('cne.modules') }}" @if (request()->routeIs('cne.modules')) aria-current="page" @endif>CPD Modules</a>
                <a href="{{ route('cpd.certifications') }}" class="{{ $navDesktopClass('cpd.certifications') }}" @if (request()->routeIs('cpd.certifications')) aria-current="page" @endif>CPD Certification</a>
                <a href="{{ route('learning.materials') }}" class="{{ $navDesktopClass('learning.materials') }}" @if (request()->routeIs('learning.materials')) aria-current="page" @endif>Learning Materials</a>
                <a href="{{ route('practice.test') }}" class="{{ $navDesktopClass('practice.test') }}" @if (request()->routeIs('practice.test')) aria-current="page" @endif>Practice Test</a>
                <a href="{{ route('online.examination') }}" class="{{ $navDesktopClass('online.examination') }}" @if (request()->routeIs('online.examination')) aria-current="page" @endif>Online Test</a>
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
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button
                                type="button"
                                @click="userMenuOpen = !userMenuOpen"
                                @click.outside="userMenuOpen = false"
                                class="inline-flex items-center gap-2 rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-900 transition-colors hover:border-logo-light-green hover:text-logo-light-green"
                            >
                                <span>Hi, {{ auth()->user()->name }}</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div
                                x-show="userMenuOpen"
                                x-cloak
                                class="absolute right-0 z-50 mt-2 w-48 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl"
                            >
                                <a
                                    href="{{ route('profile') }}"
                                    @click="userMenuOpen = false"
                                    class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-logo-light-green"
                                >
                                    My Profile
                                </a>
                                <a
                                    href="{{ route('profile.change-password') }}"
                                    @click="userMenuOpen = false"
                                    class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-logo-light-green"
                                >
                                    Change Password
                                </a>
                                @if (auth()->user()?->role_type !== 'user')
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        @click="userMenuOpen = false"
                                        class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-logo-light-green"
                                    >
                                        Dashboard
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full rounded-xl px-3 py-2 text-left text-sm font-medium text-slate-700 transition hover:bg-slate-50 hover:text-logo-light-green">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-wrap items-center justify-end gap-2">
                            {{-- @include('welcome.partials.google-sign-in-button') --}}
                            <button type="button" @click="$dispatch('open-login-modal')" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-900 transition-colors hover:border-logo-light-green hover:text-logo-light-green">
                                Log in
                            </button>
                        </div>
                    @endauth
                @endif
            </div>
        </div>

    </nav>
</header>
    <!-- Mobile menu: outside header so fixed layers cover the viewport (not clipped by header blur) -->
    <div x-show="mobileMenuOpen" x-cloak class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-[100] bg-black/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
        <div
            class="fixed inset-y-0 right-0 z-[101] flex w-full max-w-sm flex-col bg-white shadow-2xl ring-1 ring-slate-900/10"
            style="max-height: 100dvh; padding-top: env(safe-area-inset-top, 0px); padding-bottom: env(safe-area-inset-bottom, 0px);"
        >
            <div class="flex shrink-0 items-center justify-between border-b border-slate-100 px-6 py-5">
                <a href="{{ route('home') }}" class="-m-1.5 flex items-center gap-2 p-1.5" @click="mobileMenuOpen = false">
                    <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-10 w-auto">
                </a>
                <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-slate-700 hover:bg-slate-100">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex min-h-0 flex-1 flex-col overflow-y-auto overscroll-y-contain px-6 py-6" aria-label="Mobile">
                <div class="space-y-1">
                    <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                    <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('about') }}" @if (request()->routeIs('about')) aria-current="page" @endif>About Us</a>
                    <a href="{{ route('cne.modules') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('cne.modules') }}" @if (request()->routeIs('cne.modules')) aria-current="page" @endif>CPD Modules</a>
                    <a href="{{ route('cpd.certifications') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('cpd.certifications') }}" @if (request()->routeIs('cpd.certifications')) aria-current="page" @endif>CPD Certification</a>
                    <a href="{{ route('learning.materials') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('learning.materials') }}" @if (request()->routeIs('learning.materials')) aria-current="page" @endif>Learning Materials</a>
                    <a href="{{ route('practice.test') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('practice.test') }}" @if (request()->routeIs('practice.test')) aria-current="page" @endif>Practice Test</a>
                    <a href="{{ route('online.examination') }}" @click="mobileMenuOpen = false" class="{{ $navMobileClass('online.examination') }}" @if (request()->routeIs('online.examination')) aria-current="page" @endif>Online Test</a>
                </div>
                @if (Route::has('login'))
                    <div class="mt-8 border-t border-slate-200 pt-6">
                        @auth
                            @if (auth()->user()?->role_type === 'user')
                                <span class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900">
                                    Hi, {{ auth()->user()->name }}
                                </span>
                            @else
                                <a href="{{ url('/dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">Dashboard</a>
                            @endif
                            <a href="{{ route('profile') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                My Profile
                            </a>
                            <a href="{{ route('profile.change-password') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                Change Password
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="-mx-3 block w-full rounded-lg px-3 py-2.5 text-left text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                    Logout
                                </button>
                            </form>
                        @else
                            <div class="-mx-3 px-3 py-1">
                                @include('welcome.partials.google-sign-in-button', ['asBlock' => true])
                            </div>
                            <button type="button" @click="mobileMenuOpen = false; $dispatch('open-login-modal')" class="-mx-3 block w-full rounded-lg px-3 py-2.5 text-left text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                Log in
                            </button>
                            <button type="button" @click="mobileMenuOpen = false; $dispatch('open-register-modal')" class="-mx-3 block w-full rounded-lg px-3 py-2.5 text-left text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                Sign up
                            </button>
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
    </div>
</div>
