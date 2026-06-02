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
                <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-4 py-1.5 text-lg font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                    Legal
                </span>
                <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-3xl font-serif">
                    Website Terms and Conditions
                </h1>
                <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white/80 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 shadow-sm backdrop-blur-sm">
                    Last updated: 29 May 2026
                </p>
            </div>

            <div class="mt-14 lg:grid lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <aside class="mb-10 lg:col-span-4 xl:col-span-3 lg:mb-0">
                    <nav class="sticky top-28 rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-900/5 backdrop-blur-sm" aria-label="Terms sections">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">On this page</p>
                        <ul class="mt-4 space-y-1 text-sm">
                            <li><a href="#terms-intro" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">Introduction</a></li>
                            <li><a href="#terms-modifications" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">1. Modifications</a></li>
                            <li><a href="#terms-ownership" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">2. Ownership and IP</a></li>
                            <li><a href="#terms-use" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">3. Permitted Use</a></li>
                            <li><a href="#terms-submissions" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">4. Submissions</a></li>
                            <li><a href="#terms-third-party" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">5. Third-Party Links</a></li>
                            <li><a href="#terms-availability" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">6. Availability</a></li>
                            <li><a href="#terms-disclaimer" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">7. Disclaimer</a></li>
                            <li><a href="#terms-liability" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">8. Liability</a></li>
                            <li><a href="#terms-indemnification" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">9. Indemnification</a></li>
                            <li><a href="#terms-compliance" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">10. Compliance</a></li>
                            <li><a href="#terms-law" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">11. Governing Law</a></li>
                            <li><a href="#terms-contact" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-blue/10 hover:text-brand-900">12. Contact</a></li>
                        </ul>
                    </nav>
                </aside>

                <div class="lg:col-span-8 xl:col-span-9">
                    <article class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white/95 shadow-2xl shadow-slate-300/30 ring-1 ring-slate-900/5 backdrop-blur-sm">
                        <div class="divide-y divide-slate-100">
                            <section id="terms-intro" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">Introduction</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    These Terms and Conditions ("Terms") govern the access to and use of the corporate website of Impetus Healthcare Skills Private Limited located at <a href="https://www.ihsnursing.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">www.ihsnursing.com</a>, together with all associated websites, web pages, applications, and online services that display or link to these Terms (collectively referred to as the "Website" or "Site").
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Throughout these Terms, "Impetus Healthcare Skills Private Limited", "Company", "we", "us", or "our" shall refer to Impetus Healthcare Skills Private Limited and its affiliated entities, as applicable.
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    By accessing, browsing, or using the Website, you acknowledge that you have read, understood, and agreed to be bound by these Terms and Conditions, including the Privacy Policy, Cancellation and Refund Policy, and any additional policies, notices, guidelines, or disclaimers published on the Website. If you do not agree with these Terms, you are advised not to access or use the Website.
                                </p>
                            </section>

                            <section id="terms-modifications" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">1. Modifications to Terms</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Impetus Healthcare Skills Private Limited reserves the right to revise, amend, modify, or update these Terms and Conditions at any time without prior notice. Users are encouraged to review these Terms periodically. Continued use of the Website following publication of modifications constitutes acceptance of the revised Terms.
                                </p>
                            </section>

                            <section id="terms-ownership" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">2. Ownership of Content and Intellectual Property Rights</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    All content available on or accessible through the Website is the exclusive property of Impetus Healthcare Skills Private Limited or its licensors and is protected by applicable intellectual property laws.
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Except as expressly permitted in writing, users shall not:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Copy, reproduce, republish, distribute, transmit, display, modify, publish, upload, post, translate, or create derivative works from any content</li>
                                    <li>Sell, lease, license, or commercially exploit any part of the Website or its content</li>
                                    <li>Reverse engineer, decompile, disassemble, or attempt to derive source code</li>
                                    <li>Use robots, crawlers, spiders, scrapers, or data-mining tools to access or copy content</li>
                                    <li>Attempt unauthorized access to any part of the Website, servers, databases, or systems</li>
                                    <li>Circumvent or interfere with security features or operational integrity</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Any unauthorized use of the Website or its content may result in legal action.
                                </p>
                            </section>

                            <section id="terms-use" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">3. Permitted Use of the Website</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    The Website and its content are intended solely for lawful educational, informational, and professional purposes.
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Users agree not to:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Use the Website for unlawful, fraudulent, harmful, or unauthorized purposes</li>
                                    <li>Upload or transmit defamatory, obscene, abusive, threatening, misleading, or objectionable content</li>
                                    <li>Introduce viruses, malware, malicious code, or harmful software</li>
                                    <li>Use the Website for unauthorized advertising or solicitation</li>
                                    <li>Disrupt or interfere with Website functioning, accessibility, or security</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Impetus Healthcare Skills Private Limited reserves the right to suspend, restrict, or terminate access for violations.
                                </p>
                            </section>

                            <section id="terms-submissions" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">4. User Submissions and Communications</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Any feedback, suggestions, messages, ideas, documents, or other materials submitted through the Website ("Submissions") remain the user's responsibility.
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    By submitting content, the user grants Impetus Healthcare Skills Private Limited a perpetual, irrevocable, worldwide, royalty-free, transferable, and non-exclusive right to use, reproduce, modify, adapt, publish, distribute, display, and otherwise utilize such Submissions for operational, educational, promotional, research, or business purposes.
                                </p>
                            </section>

                            <section id="terms-third-party" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">5. Third-Party Websites and External Links</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    The Website may contain links to third-party websites or services for user convenience. Such links do not imply endorsement, sponsorship, or approval by Impetus Healthcare Skills Private Limited. We are not responsible for the availability, content, or reliability of external websites or for losses arising from their use.
                                </p>
                            </section>

                            <section id="terms-availability" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">6. System Availability and Technical Limitations</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Impetus Healthcare Skills Private Limited endeavors to maintain continuous Website availability. However, uninterrupted access cannot be guaranteed, and the Company is not liable for unavailability, technical failures, delays, data loss, or external factors beyond reasonable control.
                                </p>
                            </section>

                            <section id="terms-disclaimer" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">7. Disclaimer of Warranties</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    The Website, its content, products, services, educational materials, and resources are provided on an "as is" and "as available" basis without warranties of any kind. To the fullest extent permitted by law, the Company disclaims all warranties including accuracy, completeness, merchantability, fitness for purpose, non-infringement, and uninterrupted operation.
                                </p>
                            </section>

                            <section id="terms-liability" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">8. Limitation of Liability</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    To the maximum extent permitted by law, Impetus Healthcare Skills Private Limited and associated parties shall not be liable for direct, indirect, incidental, consequential, special, exemplary, or punitive damages arising from access, use, inability to use, technical failures, data loss, or reliance on Website content.
                                </p>
                            </section>

                            <section id="terms-indemnification" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">9. Indemnification</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Users agree to indemnify, defend, and hold harmless Impetus Healthcare Skills Private Limited and its affiliates from claims, liabilities, losses, and expenses (including legal fees) arising from violation of these Terms, misuse of the Website, or violation of applicable laws or third-party rights.
                                </p>
                            </section>

                            <section id="terms-compliance" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">10. Compliance with Applicable Laws</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Users agree to comply with all applicable local, state, national, and international laws and regulations while accessing or using the Website and its services.
                                </p>
                            </section>

                            <section id="terms-law" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">11. Governing Law and Jurisdiction</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    These Terms and Conditions are governed by the laws of India. Any disputes shall be subject to the exclusive jurisdiction of competent courts in Chennai, Tamil Nadu, India. Any claim arising from use of the Website must be initiated within one (1) year from when the cause of action arose.
                                </p>
                            </section>

                            <section id="terms-contact" class="scroll-mt-28 bg-gradient-to-br from-slate-50/90 to-white px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">12. Contact Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">For queries, permissions, complaints, or legal communications regarding these Terms and Conditions, users may contact:</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    <strong>Impetus Healthcare Skills Private Limited</strong><br>
                                    Website: <a href="https://www.ihsnursing.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">www.ihsnursing.com</a><br>
                                    Email: <a href="mailto:support@ihsnursing.com" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">support@ihsnursing.com</a>
                                </p>
                            </section>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>
@endsection
