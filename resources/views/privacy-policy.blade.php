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
                <span class="inline-flex items-center rounded-full bg-logo-light-green/10 px-4 py-1.5 text-lg font-medium text-logo-light-green ring-1 ring-inset ring-logo-light-green/20">
                    Legal
                </span>
                <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-3xl font-serif">
                    Privacy Policy
                </h1>
                <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white/80 px-4 py-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 shadow-sm backdrop-blur-sm">
                    Last updated 29 May 2026
                </p>
            </div>

            <div class="mt-14 lg:grid lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <aside class="mb-10 lg:col-span-4 xl:col-span-3 lg:mb-0">
                    <nav class="sticky top-28 rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-lg shadow-slate-200/40 ring-1 ring-slate-900/5 backdrop-blur-sm" aria-label="Privacy policy sections">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">On this page</p>
                        <ul class="mt-4 space-y-1 text-sm">
                            <li><a href="#privacy-about" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">About our Privacy Policy</a></li>
                            <li><a href="#privacy-scope" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">1. Scope</a></li>
                            <li><a href="#privacy-collect" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">2. Information We Collect</a></li>
                            <li><a href="#privacy-automatic" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">3. Collected Automatically</a></li>
                            <li><a href="#privacy-purpose" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">4. Purpose of Use</a></li>
                            <li><a href="#privacy-sharing" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">5. Sharing</a></li>
                            <li><a href="#privacy-legal" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">6. Legal Disclosure</a></li>
                            <li><a href="#privacy-public" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">7. Publicly Shared Info</a></li>
                            <li><a href="#privacy-retention" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">8. Access and Retention</a></li>
                            <li><a href="#privacy-security" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">9. Data Security</a></li>
                            <li><a href="#privacy-cross-border" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">10. Cross-Border Transfer</a></li>
                            <li><a href="#privacy-amendments" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">11. Amendments</a></li>
                            <li><a href="#privacy-contact" class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-logo-light-green/10 hover:text-brand-900">12. Contact Information</a></li>
                        </ul>
                    </nav>
                </aside>

                <div class="lg:col-span-8 xl:col-span-9">
                    <article class="overflow-hidden rounded-3xl border border-slate-200/90 bg-white/95 shadow-2xl shadow-slate-300/30 ring-1 ring-slate-900/5 backdrop-blur-sm">
                        <div class="divide-y divide-slate-100">
                            <section id="privacy-about" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">About our Privacy Policy</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    Ventura Learning Solutions Private Limited ("Ventura Learning Solutions", "Company", "we", "us", or "our") is committed to safeguarding the privacy, confidentiality, and security of the personal information entrusted to us. This Privacy Policy outlines the manner in which personal information is collected, used, maintained, disclosed, and protected through our website, applications, and associated services ("Services"). By accessing or using our Services, you acknowledge that you have read, understood, and agreed to the practices described in this Privacy Policy.
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    This privacy policy describes how the personal information that is collected when you visit the Ventura Learning Solutions website, application that posts a link to this privacy policy ("Service") will be used by Ventura Learning Solutions Private Limited company that owns the Service ("Ventura Learning Solutions," "we," "us" or "our"). This policy may be supplemented by additional privacy terms or notices set forth on certain areas of the Service.
                                </p>
                            </section>

                            <section id="privacy-scope" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">1. Scope of the Privacy Policy</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">This Privacy Policy applies to all personal information collected through the websites, applications, online learning platforms, and related digital services operated by Ventura Learning Solutions Private Limited.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">This Policy may be supplemented or modified by additional privacy notices applicable to specific services, programs, or transactions.</p>
                            </section>

                            <section id="privacy-collect" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">2. Information We Collect</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">We collect information from users through direct interactions and through automated technologies associated with the use of our Services.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify"><strong>2.1 Information Provided by Users</strong></p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">The categories of personal information collected may include, but are not limited to:</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify"><strong>2.2 Personal Identification Information</strong><br>Full name, Date of birth, Gender, Email address, Mobile number, Correspondence address.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify"><strong>2.3 Professional and Educational Information</strong><br>Academic qualifications, Area of specialization, Year of completion of study, Name and address of institution attended, Affiliated university or educational board, Nursing registration details, including Registered Nurse and Registered Midwife numbers.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify"><strong>2.4 Employment Information</strong><br>Name of employing institution or organization, Designation or professional role, Total years of professional experience.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify"><strong>2.5 Account and Transaction Information</strong></p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Username and password credentials</li>
                                    <li>Payment and billing information, including debit or credit card details</li>
                                    <li>Communication preferences</li>
                                    <li>Feedback, comments, suggestions, and other user-submitted content</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Users may be required to create an account and complete a registration process in order to access specific features, educational programs, assessments, or services offered by the Company.</p>
                            </section>

                            <section id="privacy-automatic" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">3. Information Collected Automatically</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">When users access or interact with our Services, certain technical and usage-related information may be collected automatically through cookies, web beacons, server logs, and similar technologies.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Such information may include:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Internet Protocol (IP) address</li>
                                    <li>Browser type and browser version</li>
                                    <li>Operating system</li>
                                    <li>Device identifiers and device configuration details</li>
                                    <li>Mobile platform information</li>
                                    <li>Access dates and times</li>
                                    <li>Usage patterns and interaction data within the Services</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">We may use aggregated or anonymized information for analytical, statistical, research, and operational purposes where such information does not identify any individual personally. Users may modify browser settings to refuse or restrict cookies; however, certain functionalities of the Services may not operate effectively if cookies are disabled.</p>
                            </section>

                            <section id="privacy-purpose" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">4. Purpose of Collection and Use of Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">The personal information collected by the Company may be used for the following purposes:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>To provide access to educational programs, training modules, assessments, certifications, and related services</li>
                                    <li>To process registrations, applications, transactions, and payments</li>
                                    <li>To communicate with users regarding services, updates, notifications, and support requests</li>
                                    <li>To provide technical assistance and customer support</li>
                                    <li>To personalize and improve user experience</li>
                                    <li>To develop, evaluate, and enhance our educational services, digital platforms, and operational processes</li>
                                    <li>To conduct research, audits, reporting, and usage analysis</li>
                                    <li>To ensure security, integrity, and proper functioning of the Services</li>
                                    <li>To inform users about new courses, programs, events, surveys, promotional offers, and other relevant communications</li>
                                    <li>To comply with legal, regulatory, and institutional obligations</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">We may also combine information collected through online and offline sources, affiliated entities, or authorized third parties for the purposes described herein.</p>
                            </section>

                            <section id="privacy-sharing" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">5. Disclosure and Sharing of Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Personal information may be shared with:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Authorized service providers, consultants, agents, and technology partners engaged for operational and administrative support</li>
                                    <li>Affiliates, subsidiaries, and associated entities of Ventura Learning Solutions</li>
                                    <li>Academic institutions, sponsors, professional bodies, or organizations associated with educational or certification activities</li>
                                    <li>Payment processing agencies and financial institutions for transaction-related purposes</li>
                                </ul>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Where users access institutional or subscription-based learning services, relevant usage information and academic performance data may be shared with the sponsoring institution for educational administration, reporting, subscription management, assessment, and remediation purposes.</p>
                            </section>

                            <section id="privacy-legal" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">6. Legal and Regulatory Disclosure</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">The Company reserves the right to disclose personal information where such disclosure is necessary to:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>Comply with applicable laws, regulations, legal proceedings, court orders, or governmental requests</li>
                                    <li>Enforce the Company’s terms, policies, and legal rights</li>
                                    <li>Prevent, investigate, or address fraud, cybersecurity incidents, unauthorized access, or unlawful activities</li>
                                    <li>Protect the rights, property, safety, and security of users, employees, or the public</li>
                                    <li>Facilitate mergers, acquisitions, restructuring, transfer of assets, or business transitions involving the Company</li>
                                </ul>
                            </section>

                            <section id="privacy-public" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">7. Publicly Shared Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Certain areas of the Services may permit users to post comments, discussions, feedback, or other content in publicly accessible sections. Any information voluntarily disclosed in public forums may be viewed, collected, or used by third parties and may become publicly searchable. Users are advised to exercise discretion when sharing personal information in such areas.</p>
                            </section>

                            <section id="privacy-retention" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">8. Access, Correction, and Retention of Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Registered users may review and update their account information through their user account login credentials.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Users may also request access to personal information maintained by the Company or request correction, modification, or deletion of such information, subject to applicable legal and operational requirements.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">While the Company will make reasonable efforts to honor deletion requests, certain information may be retained:</p>
                                <ul class="mt-2 list-disc pl-6 text-lg leading-8 text-slate-600">
                                    <li>For legal or regulatory compliance</li>
                                    <li>For legitimate business purposes</li>
                                    <li>In archived or backup systems for a limited duration</li>
                                </ul>
                            </section>

                            <section id="privacy-security" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">9. Data Security</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Ventura Learning Solutions employs reasonable administrative, technical, and physical safeguards to protect personal information from unauthorized access, misuse, alteration, disclosure, loss, or destruction.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Despite our best efforts, no method of electronic transmission or storage can be guaranteed to be completely secure. Users acknowledge and accept such inherent risks associated with digital communication and online services.</p>
                            </section>

                            <section id="privacy-cross-border" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">10. Cross-Border Transfer of Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Personal information may be processed, stored, or transferred to servers and facilities located outside the user’s country of residence where data protection laws may differ. By using the Services, users consent to such international transfer and processing of their information in accordance with this Privacy Policy.</p>
                            </section>

                            <section id="privacy-amendments" class="scroll-mt-28 px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">11. Amendments to the Privacy Policy</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Ventura Learning Solutions reserves the right to revise, amend, or update this Privacy Policy at any time without prior notice.</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Any modifications shall become effective immediately upon posting on the official website or digital platform, together with the updated revision date. Users are encouraged to review this Privacy Policy periodically.</p>
                            </section>

                            <section id="privacy-contact" class="scroll-mt-28 bg-gradient-to-br from-slate-50/90 to-white px-6 py-8 sm:px-10 sm:py-10">
                                <h2 class="text-3xl font-semibold text-slate-900 sm:text-3xl font-serif">12. Contact Information</h2>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">For any questions, concerns, requests, or clarifications regarding this Privacy Policy or the processing of personal information, users may contact:</p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">
                                    <strong>Ventura Learning Solutions Private Limited</strong><br>
                                    Email: <a href="mailto:support@venturacpd.com" class="font-semibold text-logo-blue underline decoration-logo-blue/30 underline-offset-2 transition hover:text-brand-900">support@venturacpd.com</a>
                                </p>
                                <p class="mt-3 text-lg leading-8 text-slate-600 text-justify">Users may also submit queries through the contact form available on our official website.</p>
                                <p class="mt-4 text-sm font-medium text-slate-600">Last updated: on 1st June 2026.</p>
                            </section>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>
@endsection
