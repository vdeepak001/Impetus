@extends('layouts.app')

@section('content')
    <div
        class="space-y-6"
        x-data="{
            usersListBaseUrl: @js($usersListBaseUrl),
            csrfToken: @js(csrf_token()),
            detailOpen: false,
            detailUser: null,
            paymentOpen: false,
            paymentUserId: null,
            paymentCourses: [],
            paymentModes: [],
            paymentInfoMessage: '',
            paymentLoading: false,
            paymentSubmitting: false,
            paymentError: '',
            paymentForm: {
                course_detail_id: '',
                payment_mode: '',
                start_date: '',
                end_date: '',
                remarks: '',
            },
            todayISO() {
                return new Date().toISOString().slice(0, 10);
            },
            todayPlusDaysISO(days) {
                const d = new Date();
                d.setDate(d.getDate() + days);
                const y = d.getFullYear();
                const m = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');

                return `${y}-${m}-${day}`;
            },
            openDetail(user) {
                if (this.paymentOpen) {
                    this.closePayment();
                }
                this.detailUser = user;
                this.detailOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeDetail() {
                this.detailOpen = false;
                this.detailUser = null;
                if (! this.paymentOpen) {
                    document.body.style.overflow = 'unset';
                }
            },
            resetPaymentForm() {
                this.paymentForm = {
                    course_detail_id: '',
                    payment_mode: '',
                    start_date: this.todayISO(),
                    end_date: this.todayPlusDaysISO(60),
                    remarks: '',
                };
                this.paymentError = '';
            },
            async openPayment(userId) {
                if (this.detailOpen) {
                    this.closeDetail();
                }
                this.paymentUserId = userId;
                this.resetPaymentForm();
                this.paymentOpen = true;
                this.paymentCourses = [];
                this.paymentModes = [];
                this.paymentInfoMessage = '';
                document.body.style.overflow = 'hidden';
                await this.loadPaymentCourses();
            },
            closePayment() {
                this.paymentOpen = false;
                this.paymentUserId = null;
                this.paymentCourses = [];
                this.paymentModes = [];
                this.paymentLoading = false;
                if (! this.detailOpen) {
                    document.body.style.overflow = 'unset';
                }
            },
            async loadPaymentCourses() {
                this.paymentLoading = true;
                this.paymentError = '';
                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + this.paymentUserId + '/state-courses', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    });
                    const data = await res.json();
                    this.paymentCourses = data.courses || [];
                    this.paymentModes = data.payment_modes || [];
                    this.paymentInfoMessage = data.message || '';
                    if (this.paymentModes.length && ! this.paymentForm.payment_mode) {
                        this.paymentForm.payment_mode = this.paymentModes[0].value;
                    }
                    if (this.paymentCourses.length && ! this.paymentForm.course_detail_id) {
                        this.paymentForm.course_detail_id = String(this.paymentCourses[0].id);
                    }
                } catch (e) {
                    this.paymentError = 'Could not load modules. Please try again.';
                } finally {
                    this.paymentLoading = false;
                }
            },
            async submitPayment() {
                this.paymentSubmitting = true;
                this.paymentError = '';
                const fd = new FormData();
                fd.append('_token', this.csrfToken);
                fd.append('course_detail_id', this.paymentForm.course_detail_id);
                fd.append('payment_mode', this.paymentForm.payment_mode);
                fd.append('start_date', this.paymentForm.start_date);
                fd.append('end_date', this.paymentForm.end_date);
                fd.append('remarks', this.paymentForm.remarks || '');
                try {
                    const res = await fetch(this.usersListBaseUrl + '/' + this.paymentUserId + '/orders', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                        body: fd,
                    });
                    const data = await res.json().catch(() => ({}));
                    if (res.status === 422) {
                        let msg = data.message || '';
                        if (data.errors) {
                            msg = Object.values(data.errors).flat().join(' ');
                        }
                        this.paymentError = msg || 'Validation failed.';
                        return;
                    }
                    if (! res.ok) {
                        this.paymentError = data.message || 'Could not save order.';
                        return;
                    }
                    window.location.reload();
                } catch (e) {
                    this.paymentError = 'Network error. Please try again.';
                } finally {
                    this.paymentSubmitting = false;
                }
            },
            displayValue(key, value) {
                if (value === undefined || value === null || value === '') {
                    return '—';
                }
                if (key === 'active_status') {
                    return value ? 'Active' : 'Inactive';
                }
                return value;
            },
        }"
        @@keydown.escape.window="
            if (paymentOpen) { closePayment() }
            else if (detailOpen) { closeDetail() }
        "
    >
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                {{ $title }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Registered learners (<span class="capitalize">role: user</span>).
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 w-14">
                                S.No.
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                Password
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                Phone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $user->name ?: trim(($user->first_name ?? '').' '.($user->last_name ?? '')) ?: '—' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->email ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->password_raw ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->phone ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="inline-flex items-center justify-end gap-1">
                                        <button
                                            type="button"
                                            @@click="openDetail(@js($user->only($userProfileKeys)))"
                                            class="inline-flex items-center justify-center rounded-lg p-2 text-indigo-600 transition-colors hover:bg-indigo-50 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:text-indigo-400 dark:hover:bg-gray-700 dark:hover:text-indigo-300 dark:focus:ring-offset-gray-800"
                                            title="View user details"
                                        >
                                            <span class="sr-only">View user details</span>
                                            <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        <button
                                            type="button"
                                            @@click="openPayment({{ $user->id }})"
                                            class="inline-flex items-center justify-center rounded-lg p-2 text-emerald-700 transition-colors hover:bg-emerald-50 hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 dark:text-emerald-400 dark:hover:bg-gray-700 dark:hover:text-emerald-300 dark:focus:ring-offset-gray-800"
                                            title="Record payment for a module"
                                        >
                                            <span class="sr-only">Record payment</span>
                                            <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No users with this role yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->hasPages())
            <div class="px-2">
                {{ $users->links() }}
            </div>
        @endif

        {{-- Profile detail popup --}}
        <div
            x-show="detailOpen"
            x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
        >
            <div
                @@click="closeDetail()"
                class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>

            <div
                @@click.stop
                class="relative w-full max-w-2xl max-h-[85vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                <button
                    type="button"
                    @@click="closeDetail()"
                    class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <span class="sr-only">Close</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                            fill="currentColor" />
                    </svg>
                </button>

                <div class="p-6 sm:p-10 overflow-y-auto max-h-[85vh]">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                        User profile
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        Read-only details for this learner account.
                    </p>

                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($profileLabels as $key => $label)
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 py-3 sm:items-center">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide dark:text-gray-400">
                                    {{ $label }}
                                </dt>
                                <dd
                                    class="sm:col-span-2 text-sm text-gray-900 dark:text-gray-100 break-words"
                                    x-text="displayValue('{{ $key }}', detailUser ? detailUser['{{ $key }}'] : null)"
                                ></dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>

        {{-- Record payment popup --}}
        <div
            x-show="paymentOpen"
            x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
        >
            <div
                @@click="closePayment()"
                class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            ></div>

            <div
                @@click.stop
                class="relative w-full max-w-lg max-h-[90vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
            >
                <button
                    type="button"
                    @@click="closePayment()"
                    class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
                >
                    <span class="sr-only">Close</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                            fill="currentColor" />
                    </svg>
                </button>

                <div class="p-6 sm:p-8 overflow-y-auto max-h-[90vh]">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                        Record payment
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        Link a completed payment to a module available for this learner’s state. Start date defaults to today; end date defaults to 60 days from today and must be on or after the start date.
                    </p>

                    <div x-show="paymentLoading" class="text-sm text-gray-500 dark:text-gray-400 mb-4">Loading modules…</div>

                    <p x-show="! paymentLoading && paymentInfoMessage" x-text="paymentInfoMessage"
                        class="text-sm text-amber-700 dark:text-amber-400 mb-4"></p>

                    <div x-show="paymentError"
                        class="mb-4 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-800 dark:bg-red-900/30 dark:text-red-200"
                        x-text="paymentError"></div>

                    <form class="space-y-4" @@submit.prevent="submitPayment">
                        <div>
                            <label for="order-course" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Module</label>
                            <select id="order-course" x-model="paymentForm.course_detail_id" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                <option value="" disabled>Select a module</option>
                                <template x-for="c in paymentCourses" :key="c.id">
                                    <option :value="String(c.id)" x-text="c.name"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label for="order-payment-mode" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Payment mode</label>
                            <select id="order-payment-mode" x-model="paymentForm.payment_mode" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                <template x-for="m in paymentModes" :key="m.value">
                                    <option :value="m.value" x-text="m.label"></option>
                                </template>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="order-start" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Start date</label>
                                <input id="order-start" type="date" x-model="paymentForm.start_date" required
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                            </div>
                            <div>
                                <label for="order-end" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">End date</label>
                                <input id="order-end" type="date" x-model="paymentForm.end_date" required
                                    :min="paymentForm.start_date || todayISO()"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                            </div>
                        </div>

                        <div>
                            <label for="order-remarks" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
                            <textarea id="order-remarks" x-model="paymentForm.remarks" rows="3"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                                placeholder="Optional notes"></textarea>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" @@click="closePayment()"
                                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                Cancel
                            </button>
                            <button type="submit" :disabled="paymentSubmitting || paymentLoading"
                                class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-60">
                                <span x-show="! paymentSubmitting">Save order</span>
                                <span x-show="paymentSubmitting" x-cloak>Saving…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
