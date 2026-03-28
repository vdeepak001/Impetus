@extends('layouts.frontend.app')

@section('title', 'Terms and Conditions')

@section('content')
    <main class="relative isolate pb-20 sm:pb-28">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[420px] overflow-hidden">
            <div class="absolute left-10 top-24 h-72 w-72 rounded-full bg-logo-blue/10 blur-[100px]"></div>
            <div class="absolute right-10 top-28 h-96 w-96 rounded-full bg-logo-light-green/12 blur-[100px]"></div>
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-logo-light-green/20 to-logo-blue/15 opacity-60 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-6 pt-28 sm:pt-32 lg:px-8">
            <div class="text-center">
                <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-4 py-1.5 text-sm font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                    Legal
                </span>
                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl font-serif">
                    Terms and conditions
                </h1>
                <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white/80 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 shadow-sm backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-logo-blue">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Last updated {{ date('F j, Y') }}
                </p>
            </div>

            <div class="mt-14 lg:grid lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <aside class="mb-10 lg:col-span-4 xl:col-span-3 lg:mb-0">
                    <nav class="sticky top-28 rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-900/5 backdrop-blur-sm" aria-label="Terms sections">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">On this page</p>
                        <ul class="mt-4 space-y-1 text-sm">
                            <li><a href="#terms-agreement" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Agreement</a></li>
                            <li><a href="#terms-eligibility" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Eligibility &amp; accounts</a></li>
                            <li><a href="#terms-courses" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Courses &amp; content</a></li>
                            <li><a href="#terms-fees" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Fees &amp; payments</a></li>
                            <li><a href="#terms-warranty" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Disclaimer</a></li>
                            <li><a href="#terms-liability" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Limitation of liability</a></li>
                            <li><a href="#terms-changes" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Changes</a></li>
                            <li><a href="#terms-contact" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Contact</a></li>
                        </ul>
                    </nav>
                </aside>

                <div class="lg:col-span-8 xl:col-span-9">
                    <article class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white/95 shadow-2xl shadow-slate-300/30 ring-1 ring-slate-900/5 backdrop-blur-sm">
                        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50/80 to-white px-6 py-8 sm:px-10 sm:py-10">
                            <div class="flex items-start gap-4">
                                <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-logo-blue/20 to-logo-blue/5 text-logo-blue ring-1 ring-logo-blue/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v15.341A8.967 8.967 0 0118 12a8.967 8.967 0 00-6-5.958zM15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-serif text-xl font-bold text-slate-900 sm:text-2xl">Please read carefully</h2>
                                    <p class="mt-2 text-sm leading-relaxed text-slate-600">
                                        These terms govern your use of our website and services. By continuing to use the platform, you confirm that you understand and accept them.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="divide-y divide-slate-100">
                            <section id="terms-agreement" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-brand-900 text-xs font-bold text-white">01</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Agreement</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            By accessing or using the website and services operated by Venture Nursing Services (“we,” “us,” or “our”), you agree to these terms and conditions. If you do not agree, do not use the Services.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-eligibility" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">02</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Eligibility and accounts</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            You must provide accurate registration information and keep your credentials confidential. You are responsible for activity under your account. We may suspend or terminate accounts that violate these terms or pose a risk to the Services or other users.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-courses" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">03</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Courses and digital content</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            Access to courses, materials, and assessments is granted according to your purchase or enrollment. Unless expressly stated, content is licensed for your personal, non-commercial educational use and may not be copied, redistributed, or reverse engineered except as allowed by applicable law.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-fees" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">04</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Fees and payments</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            Prices and payment terms are displayed at checkout. You authorize us and our payment processors to charge applicable fees. Refunds, if any, are handled according to the refund policy stated at the time of purchase.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-warranty" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">05</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Disclaimer of warranties</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            The Services are provided “as is” and “as available” without warranties of any kind, express or implied, to the fullest extent permitted by law. We do not guarantee uninterrupted or error-free operation or that content will meet every licensing or regulatory requirement in your jurisdiction; you remain responsible for your professional compliance.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-liability" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">06</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Limitation of liability</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or for loss of profits, data, or goodwill, arising from your use of the Services.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-changes" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-600">07</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Changes</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            We may update these terms from time to time. Continued use of the Services after changes constitutes acceptance of the revised terms. Material changes will be indicated on this page with an updated date.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section id="terms-contact" class="scroll-mt-28 bg-gradient-to-br from-slate-50/90 to-white px-6 py-8 sm:px-10 sm:py-10">
                                <div class="flex gap-5">
                                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-logo-blue/15 text-xs font-bold text-brand-900">08</span>
                                    <div>
                                        <h2 class="text-lg font-semibold text-slate-900">Contact</h2>
                                        <p class="mt-3 text-sm leading-7 text-slate-600">
                                            Questions about these terms may be sent to <a href="mailto:info@careconnect.com" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">info@careconnect.com</a>.
                                        </p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </article>

                    <p class="mt-8 text-center text-xs text-slate-500">
                        Related:
                        <a href="{{ route('privacy.policy') }}" class="font-medium text-logo-blue hover:underline">Privacy Policy</a>
                        <span class="mx-2 text-slate-300">·</span>
                        <a href="{{ route('faq') }}" class="font-medium text-logo-blue hover:underline">FAQ</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
