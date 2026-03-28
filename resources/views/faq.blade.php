@extends('layouts.frontend.app')

@section('title', 'FAQ')

@section('content')
    <main class="relative isolate pb-20 sm:pb-28">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[480px] overflow-hidden">
            <div class="absolute left-10 top-24 h-72 w-72 rounded-full bg-logo-light-green/15 blur-[100px]"></div>
            <div class="absolute right-10 top-32 h-96 w-96 rounded-full bg-logo-blue/10 blur-[100px]"></div>
            <div class="absolute bottom-0 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-brand-900/5 blur-[90px]"></div>
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-logo-blue/15 to-logo-light-green/25 opacity-50 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
        </div>

        <div class="mx-auto w-full max-w-2xl px-5 pt-28 sm:px-6 sm:pt-32 lg:px-8">
            <div class="text-center">
                <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-4 py-1.5 text-sm font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                    Help center
                </span>
                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl font-serif">
                    Frequently asked questions
                </h1>
                <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    Quick answers about courses, accounts, certifications, and using our platform.
                </p>
            </div>

            <div class="mt-14 space-y-4" x-data="{ open: 0 }">
                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white/90 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur-sm transition-shadow hover:shadow-xl hover:shadow-slate-300/40">
                    <button type="button" class="flex w-full items-start gap-4 px-5 py-5 text-left outline-none ring-0 focus:outline-none focus:ring-0 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-logo-light-green/40 sm:px-6 sm:py-6" @click="open = open === 0 ? null : 0" :aria-expanded="open === 0">
                        <span class="mt-0.5 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-logo-light-green/20 to-logo-light-green/5 text-logo-light-green ring-1 ring-logo-light-green/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-base font-semibold text-slate-900 sm:text-lg">How do I create an account?</span>
                        </span>
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-transform duration-200" :class="open === 0 ? 'rotate-180 bg-logo-light-green/15 text-logo-light-green' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="open === 0"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="border-t border-slate-100 bg-slate-50/80 px-5 pb-5 pt-0 sm:px-6 sm:pb-6"
                    >
                        <p class="pl-0 text-sm leading-7 text-slate-600 sm:pl-14">
                            Use the Register option in the site header, complete the form with a valid email address, and verify your account when prompted. You can then sign in to access your dashboard and enrolled materials.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white/90 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur-sm transition-shadow hover:shadow-xl hover:shadow-slate-300/40">
                    <button type="button" class="flex w-full items-start gap-4 px-5 py-5 text-left outline-none ring-0 focus:outline-none focus:ring-0 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-logo-light-green/40 sm:px-6 sm:py-6" @click="open = open === 1 ? null : 1" :aria-expanded="open === 1">
                        <span class="mt-0.5 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-logo-blue/15 to-logo-blue/5 text-logo-blue ring-1 ring-logo-blue/15">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v15.341A8.967 8.967 0 0118 12a8.967 8.967 0 00-6-5.958zM15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-base font-semibold text-slate-900 sm:text-lg">How do CNE modules and credit hours work?</span>
                        </span>
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-transform duration-200" :class="open === 1 ? 'rotate-180 bg-logo-light-green/15 text-logo-light-green' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="open === 1"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="border-t border-slate-100 bg-slate-50/80 px-5 pb-5 pt-0 sm:px-6 sm:pb-6"
                    >
                        <p class="text-sm leading-7 text-slate-600 sm:pl-14">
                            Each module lists its credit value and learning objectives. Complete the required content and any assessments. Approved completion is reflected in your account and may be used toward your continuing education requirements as applicable to your license.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white/90 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur-sm transition-shadow hover:shadow-xl hover:shadow-slate-300/40">
                    <button type="button" class="flex w-full items-start gap-4 px-5 py-5 text-left outline-none ring-0 focus:outline-none focus:ring-0 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-logo-light-green/40 sm:px-6 sm:py-6" @click="open = open === 2 ? null : 2" :aria-expanded="open === 2">
                        <span class="mt-0.5 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-900/10 to-brand-900/5 text-brand-900 ring-1 ring-brand-900/10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-base font-semibold text-slate-900 sm:text-lg">Can I access courses on a phone or tablet?</span>
                        </span>
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-transform duration-200" :class="open === 2 ? 'rotate-180 bg-logo-light-green/15 text-logo-light-green' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="open === 2"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="border-t border-slate-100 bg-slate-50/80 px-5 pb-5 pt-0 sm:px-6 sm:pb-6"
                    >
                        <p class="text-sm leading-7 text-slate-600 sm:pl-14">
                            Yes. The platform is designed to work in modern browsers on desktop and mobile devices. For the best experience during timed activities or exams, use a stable connection and avoid switching apps mid-session.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white/90 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur-sm transition-shadow hover:shadow-xl hover:shadow-slate-300/40">
                    <button type="button" class="flex w-full items-start gap-4 px-5 py-5 text-left outline-none ring-0 focus:outline-none focus:ring-0 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-logo-light-green/40 sm:px-6 sm:py-6" @click="open = open === 3 ? null : 3" :aria-expanded="open === 3">
                        <span class="mt-0.5 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-logo-light-green/20 to-logo-light-green/5 text-logo-light-green ring-1 ring-logo-light-green/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.832-6.832c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-base font-semibold text-slate-900 sm:text-lg">How do I reset my password?</span>
                        </span>
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-transform duration-200" :class="open === 3 ? 'rotate-180 bg-logo-light-green/15 text-logo-light-green' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="open === 3"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="border-t border-slate-100 bg-slate-50/80 px-5 pb-5 pt-0 sm:px-6 sm:pb-6"
                    >
                        <p class="text-sm leading-7 text-slate-600 sm:pl-14">
                            From the login screen, use the password reset link and follow the instructions sent to your registered email. If you do not see the message, check spam or junk folders.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white/90 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur-sm transition-shadow hover:shadow-xl hover:shadow-slate-300/40">
                    <button type="button" class="flex w-full items-start gap-4 px-5 py-5 text-left outline-none ring-0 focus:outline-none focus:ring-0 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-logo-light-green/40 sm:px-6 sm:py-6" @click="open = open === 4 ? null : 4" :aria-expanded="open === 4">
                        <span class="mt-0.5 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-logo-blue/15 to-logo-blue/5 text-logo-blue ring-1 ring-logo-blue/15">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-base font-semibold text-slate-900 sm:text-lg">Who do I contact for support?</span>
                        </span>
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition-transform duration-200" :class="open === 4 ? 'rotate-180 bg-logo-light-green/15 text-logo-light-green' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="open === 4"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="border-t border-slate-100 bg-slate-50/80 px-5 pb-5 pt-0 sm:px-6 sm:pb-6"
                    >
                        <p class="text-sm leading-7 text-slate-600 sm:pl-14">
                            Email us at <a href="mailto:info@careconnect.com" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition-colors hover:text-brand-900 hover:decoration-brand-900/40">info@careconnect.com</a> or call <a href="tel:+18001234567" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition-colors hover:text-brand-900 hover:decoration-brand-900/40">1-800-123-4567</a>. Include your account email and a short description of the issue so we can help faster.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-14 rounded-3xl border border-slate-200/80 bg-gradient-to-br from-brand-900 via-brand-900 to-brand-800 p-8 text-center shadow-2xl shadow-brand-900/25 sm:p-10">
                <h2 class="font-serif text-2xl font-bold text-white sm:text-3xl">Still have questions?</h2>
                <p class="mx-auto mt-3 max-w-lg text-sm leading-7 text-slate-300">
                    Our team is happy to help with account access, course selection, or technical issues.
                </p>
                <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row sm:gap-4">
                    <a href="mailto:info@careconnect.com" class="inline-flex items-center justify-center rounded-full bg-logo-light-green px-6 py-3 text-sm font-bold text-white shadow-lg shadow-logo-light-green/30 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-logo-light-green/40">
                        Email support
                    </a>
                    <a href="tel:+18001234567" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/15">
                        Call 1-800-123-4567
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
