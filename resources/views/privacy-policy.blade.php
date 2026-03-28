@extends('layouts.frontend.app')

@section('title', 'Privacy Policy')

@section('content')
    <main class="relative isolate pb-20 sm:pb-28">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[420px] overflow-hidden">
            <div class="absolute left-10 top-24 h-72 w-72 rounded-full bg-logo-light-green/12 blur-[100px]"></div>
            <div class="absolute right-10 top-28 h-96 w-96 rounded-full bg-logo-blue/10 blur-[100px]"></div>
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-logo-blue/12 to-logo-light-green/22 opacity-60 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-6 pt-28 sm:pt-32 lg:px-8">
            <div class="text-center">
                <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-4 py-1.5 text-sm font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                    Legal
                </span>
                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl font-serif">
                    Privacy policy
                </h1>
                <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white/80 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 shadow-sm backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-logo-light-green">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 012.25 2.25v7.5" />
                    </svg>
                    Last updated {{ date('F j, Y') }}
                </p>
            </div>

            <div class="mt-14 lg:grid lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <aside class="mb-10 lg:col-span-4 xl:col-span-3 lg:mb-0">
                    <nav class="sticky top-28 rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-900/5 backdrop-blur-sm" aria-label="Privacy policy sections">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">On this page</p>
                        <ul class="mt-4 space-y-1 text-sm">
                            <li><a href="#privacy-introduction" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Introduction</a></li>
                            <li><a href="#privacy-collect" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Information we collect</a></li>
                            <li><a href="#privacy-use" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">How we use information</a></li>
                            <li><a href="#privacy-sharing" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Sharing and disclosure</a></li>
                            <li><a href="#privacy-retention" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Data retention &amp; security</a></li>
                            <li><a href="#privacy-choices" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Your choices</a></li>
                            <li><a href="#privacy-contact" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">Contact</a></li>
                        </ul>
                    </nav>
                </aside>

                <div class="lg:col-span-8 xl:col-span-9">
                    <article class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white/95 shadow-2xl shadow-slate-300/30 ring-1 ring-slate-900/5 backdrop-blur-sm">
                        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50/80 to-white px-6 py-8 sm:px-10 sm:py-10">
                            <div class="flex items-start gap-4">
                                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-logo-light-green/25 to-logo-light-green/5 text-logo-light-green ring-1 ring-logo-light-green/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-serif text-xl font-bold text-slate-900 sm:text-2xl">Your privacy matters</h2>
                                    <p class="mt-2 text-sm leading-relaxed text-slate-600">
                                        We are committed to protecting personal information you share with us. This policy explains what we collect and how we use it in clear, plain language.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="divide-y divide-slate-100">
                            <section id="privacy-introduction" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-brand-900 text-xs font-bold text-white">01</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Introduction</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            Venture Nursing Services (“we,” “us,” or “our”) respects your privacy. This policy describes how we collect, use, disclose, and safeguard information when you use our website and related services (the “Services”).
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-collect" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">02</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Information we collect</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            We may collect information you provide directly, such as name, email address, phone number, professional credentials, and payment details when you register, purchase courses, or contact us. We also collect technical data such as IP address, browser type, device identifiers, and usage logs to operate and improve the Services.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-use" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">03</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">How we use information</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            We use information to provide and personalize the Services, process transactions, communicate with you, maintain security, comply with legal obligations, and analyze usage to improve our platform and content.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-sharing" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">04</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Sharing and disclosure</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            We may share information with service providers who assist us (for example, hosting, payment processing, and email delivery) under appropriate agreements. We may disclose information if required by law or to protect our rights, users, or the public.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-retention" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">05</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Data retention and security</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            We retain information as long as needed to fulfill the purposes described in this policy unless a longer period is required by law. We implement reasonable technical and organizational measures to protect personal information; however, no method of transmission or storage is completely secure.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-choices" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">06</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Your choices</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            Depending on your location, you may have rights to access, correct, delete, or restrict processing of your personal information, or to object to certain processing. Contact us using the details below to make a request.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="privacy-contact" class="scroll-mt-28 bg-gradient-to-br from-slate-50/90 to-white px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-logo-light-green/20 text-xs font-bold text-brand-900">07</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Contact</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            For questions about this privacy policy, email <a href="mailto:info@careconnect.com" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">info@careconnect.com</a> or write to us at 123 Health Avenue, New York, NY 10001.
                                        </p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </article>

                    <p class="mt-8 text-center text-xs text-slate-500">
                        Related:
                        <a href="{{ route('terms.conditions') }}" class="font-medium text-logo-blue hover:underline">Terms &amp; Conditions</a>
                        <span class="mx-2 text-slate-300">·</span>
                        <a href="{{ route('faq') }}" class="font-medium text-logo-blue hover:underline">FAQ</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
