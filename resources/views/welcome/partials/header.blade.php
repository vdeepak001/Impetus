@php
    $navDesktopClass = fn (string $routeName): string => request()->routeIs($routeName)
        ? 'rounded-full px-2 xl:px-3 py-2 text-sm font-semibold text-logo-light-green bg-logo-light-green/15 transition-colors'
        : 'rounded-full px-2 xl:px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green';
    $navMobileClass = fn (string $routeName): string => request()->routeIs($routeName)
        ? '-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-logo-light-green bg-logo-light-green/10'
        : '-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50';
    $cartCount = 0;
    if (auth()->check() && auth()->user()?->role_type === 'user') {
        $cartCount = \App\Models\CartItem::query()->where('user_id', auth()->id())->count();
    }
    $contactPrefill = [
        'name' => auth()->user()?->name ?? '',
        'email' => auth()->user()?->email ?? '',
        'phone' => auth()->user()?->phone ?? '',
        'ihsid' => auth()->user()?->unique_sequence_number ?? '',
    ];
    $contactHasErrors = $errors->has('contact_name')
        || $errors->has('contact_email')
        || $errors->has('contact_phone')
        || $errors->has('contact_query_for')
        || $errors->has('contact_ihsid');
@endphp
<!-- Navigation: mobile menu is a sibling of <header> so position:fixed overlays are not trapped by backdrop-blur (containing block). -->
<div
    x-data="{ mobileMenuOpen: false, scrolled: true, contactModalOpen: {{ $contactHasErrors ? 'true' : 'false' }} }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    @keydown.escape.window="mobileMenuOpen = false"
>
<header class="fixed top-4 inset-x-4 z-50 max-w-7xl mx-auto rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200/70 shadow-2xl py-3 px-6 transition-all duration-500">
    <nav class="mx-auto w-full" aria-label="Global">
        <div class="flex items-center justify-between gap-2 xl:gap-4">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5 flex items-center gap-2 group transition-transform hover:scale-105">
                <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" class="h-16 w-auto">
            </a>

            <div class="hidden lg:flex lg:items-center lg:justify-center lg:gap-1 xl:gap-2">
                <a href="{{ route('home') }}" class="{{ $navDesktopClass('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                <a href="{{ route('about') }}" class="{{ $navDesktopClass('about') }}" @if (request()->routeIs('about')) aria-current="page" @endif>About Us</a>
                <a href="{{ route('cne.modules') }}" class="{{ $navDesktopClass('cne.modules') }}" @if (request()->routeIs('cne.modules')) aria-current="page" @endif>CPD Modules</a>
                <a href="{{ route('cpd.certifications') }}" class="{{ $navDesktopClass('cpd.certifications') }}" @if (request()->routeIs('cpd.certifications')) aria-current="page" @endif>CPD Certification</a>
                <a href="{{ route('learning.materials') }}" class="{{ $navDesktopClass('learning.materials') }}" @if (request()->routeIs('learning.materials')) aria-current="page" @endif>Learning Materials</a>
                <a href="{{ route('practice.test') }}" class="{{ $navDesktopClass('practice.test') }}" @if (request()->routeIs('practice.test')) aria-current="page" @endif>Practice Test</a>
                <a href="{{ route('online.examination') }}" class="{{ $navDesktopClass('online.examination') }}" @if (request()->routeIs('online.examination')) aria-current="page" @endif>Online Test</a>
                <button type="button" @click="contactModalOpen = true" class="rounded-full px-2 xl:px-3 py-2 text-sm font-medium text-slate-800 transition-colors hover:bg-logo-light-green/10 hover:text-logo-light-green">
                    Contact Us
                </button>
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
                        <div class="flex items-center gap-3">
                            @if ($cartCount > 0)
                                <a href="{{ route('cart.index') }}" class="relative inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-800 transition hover:border-logo-light-green hover:text-logo-light-green">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l1.5 13.5h13.5l2.25-9H6.375" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm10.5 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-logo-blue px-1 text-xs font-bold text-white">
                                        {{ $cartCount }}
                                    </span>
                                </a>
                            @endif

                             <div x-data="{ userMenuOpen: false }" class="relative flex-shrink-0 flex flex-col items-center gap-1">
                                <button
                                    type="button"
                                    @click="userMenuOpen = !userMenuOpen"
                                    @click.outside="userMenuOpen = false"
                                    class="inline-flex w-40 items-center justify-between rounded-lg border border-slate-300 bg-white px-3 py-1 text-sm font-medium text-slate-900 transition-colors hover:border-logo-light-green hover:text-logo-light-green"
                                >
                                    <span class="truncate">Hi, {{ auth()->user()->name }}</span>
                                    <svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                                <div class="w-40 rounded-lg bg-logo-blue py-1 text-center text-[13px] font-bold text-white shadow-sm">
                                    UID: {{ auth()->user()->unique_sequence_number ?? 'N/A' }}
                                </div>

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
                    <button type="button" @click="contactModalOpen = true; mobileMenuOpen = false" class="-mx-3 block w-full rounded-lg px-3 py-2 text-left text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                        Contact Us
                    </button>
                </div>
                @if (Route::has('login'))
                    <div class="mt-8 border-t border-slate-200 pt-6">
                        @auth
                            @if (auth()->user()?->role_type === 'user')
                                <span class="-mx-3 block truncate rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900">
                                    Hi, {{ auth()->user()->name }}
                                </span>
                                @if ($cartCount > 0)
                                    <a href="{{ route('cart.index') }}" class="-mx-3 flex items-center justify-between rounded-lg px-3 py-2.5 text-base font-medium leading-7 text-slate-900 hover:bg-slate-50">
                                        <span>Cart</span>
                                        <span class="inline-flex h-6 min-w-[1.5rem] items-center justify-center rounded-full bg-logo-blue px-2 text-xs font-bold text-white">
                                            {{ $cartCount }}
                                        </span>
                                    </a>
                                @endif
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

    <div x-show="contactModalOpen" x-cloak class="fixed inset-0 z-[9999] grid place-items-center p-4 sm:p-6" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="contactModalOpen = false"></div>

        <div class="relative z-10 w-full max-w-4xl rounded-3xl border border-slate-200/80 bg-white p-0 shadow-2xl shadow-slate-900/10 overflow-hidden" @click.stop>
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-3 p-6 sm:p-8 flex flex-col justify-between">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-slate-900 mb-1">Contact Us</h2>
                            <p class="text-xs sm:text-sm text-slate-600">Send us an inquiry and we'll get back to you shortly.</p>
                        </div>
                        <button type="button" @click="contactModalOpen = false" class="shrink-0 rounded-full p-2 text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-800 md:hidden" aria-label="Close contact dialog">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('contact.inquiries.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">Name <span class="text-rose-500 font-bold">*</span></label>
                            <input type="text" name="contact_name" value="{{ old('contact_name', $contactPrefill['name']) }}" required
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/25" />
                            @error('contact_name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">Email ID <span class="text-rose-500 font-bold">*</span></label>
                                <input type="email" name="contact_email" value="{{ old('contact_email', $contactPrefill['email']) }}" required
                                    class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/25" />
                                @error('contact_email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">Mobile # <span class="text-rose-500 font-bold">*</span></label>
                                <input type="text" name="contact_phone" value="{{ old('contact_phone', $contactPrefill['phone']) }}" required
                                    class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/25" />
                                @error('contact_phone') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">IHSID <span class="text-slate-400 text-xs font-normal">(Optional)</span></label>
                            <input type="text" name="contact_ihsid" value="{{ old('contact_ihsid', $contactPrefill['ihsid']) }}"
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/25" />
                            @error('contact_ihsid') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-xs font-bold text-slate-700 uppercase tracking-wider">Query for <span class="text-rose-500 font-bold">*</span></label>
                            <textarea name="contact_query_for" required rows="3" placeholder="Please enter details of your query..."
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/25">{{ old('contact_query_for') }}</textarea>
                            @error('contact_query_for') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                                Submit Query
                            </button>
                        </div>
                    </form>
                </div>

                <div class="md:col-span-2 bg-gradient-to-br from-logo-blue to-slate-900 text-white p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-orange-500/15 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -left-10 -top-10 w-36 h-36 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="flex items-start justify-between">
                            <h3 class="font-serif text-2xl font-bold text-white mb-3">Contact Info</h3>
                            <button type="button" @click="contactModalOpen = false" class="shrink-0 rounded-full p-1.5 text-slate-400 transition-colors hover:bg-white/10 hover:text-white focus:outline-none hidden md:inline-flex" aria-label="Close contact dialog">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-8">Feel free to reach out to us directly through any of these communication channels.</p>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-white/10 rounded-xl text-orange-400 shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mobile</h4>
                                    <div class="text-sm font-semibold text-slate-200 mt-2 space-y-1.5 leading-relaxed">
                                        <p><a href="tel:+919361737318" class="hover:text-orange-400 transition-colors">+91 9361737318</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-white/10 rounded-xl text-orange-400 shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mail ID</h4>
                                    <p class="text-sm font-semibold text-slate-200 mt-2 leading-relaxed">
                                        <a href="mailto:support@venturacpd.com" class="hover:text-orange-400 transition-colors">support@venturacpd.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-4 border-t border-white/5 text-[10px] text-slate-400 relative z-10 leading-normal">
                        IHS Nursing CNE & Continuing Education Portal
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
