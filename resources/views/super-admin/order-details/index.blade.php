@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Module payment orders recorded for learners.
        </p>
    </div>

    <form method="GET" id="order-filters-form" class="mb-4 rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[220px] flex-1">
                <label for="order-search" class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-300">
                    Search
                </label>
                <input id="order-search" name="search" type="text" value="{{ $filters['search'] }}"
                    placeholder="Learner, email, module, remarks"
                    oninput="window.orderFiltersDebounceSubmit()"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
            </div>

            <div class="min-w-[180px]">
                <label for="order-mode" class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-300">
                    Payment mode
                </label>
                <select id="order-mode" name="payment_mode" onchange="this.form.submit()"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100">
                    <option value="">All</option>
                    @foreach ($paymentModes as $mode)
                        <option value="{{ $mode['value'] }}" @selected($filters['payment_mode'] === $mode['value'])>
                            {{ $mode['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="min-w-[160px]">
                <label for="order-status" class="mb-1 block text-xs font-medium text-gray-600 dark:text-gray-300">
                    Status
                </label>
                <select id="order-status" name="payment_status" onchange="this.form.submit()"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100">
                    <option value="">All</option>
                    @foreach ($paymentStatuses as $status)
                        <option value="{{ $status['value'] }}" @selected($filters['payment_status'] === $status['value'])>
                            {{ $status['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route(request()->route()->getName()) }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-700">
                Clear
            </a>
        </div>
    </form>

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
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Learner
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Email
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 min-w-[10rem]">
                            Module
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            State council
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            Payment mode
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            Start
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            End
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            Recorded by
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 whitespace-nowrap">
                            Created
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300 min-w-[8rem]">
                            Remarks
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    @php
                                        $learner = $order->user;
                                        $learnerName = $learner
                                            ? ($learner->name ?: trim(($learner->first_name ?? '').' '.($learner->last_name ?? '')) ?: '—')
                                            : '—';
                                    @endphp
                                    {{ $learnerName }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $order->user?->email ?? '—' }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $order->courseDetail?->couse_name ?? '—' }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $order->stateCouncil?->council_name ?? '—' }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ \App\Enums\PaymentMode::tryFrom($order->payment_mode)?->label() ?? \Illuminate\Support\Str::of($order->payment_mode)->replace('_', ' ')->title() }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span @class([
                                    'inline-flex rounded-full px-2 py-0.5 text-xs font-medium',
                                    'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200' => $order->payment_status->value === 'completed',
                                    'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-200' => $order->payment_status->value === 'pending',
                                ])>
                                    {{ $order->payment_status->label() }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                {{ $order->start_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                {{ $order->end_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                @if ($order->recordedBy)
                                    @php
                                        $rec = $order->recordedBy;
                                        $recName = $rec->name ?: trim(($rec->first_name ?? '').' '.($rec->last_name ?? '')) ?: '—';
                                    @endphp
                                    {{ $recName }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400 max-w-[12rem]">
                                @if ($order->remarks)
                                    <span class="line-clamp-2" title="{{ e($order->remarks) }}">{{ $order->remarks }}</span>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12"
                                class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                No orders recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($orders->hasPages())
        <div class="mt-4 px-2">
            {{ $orders->links() }}
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        let orderFiltersDebounceTimer;

        window.orderFiltersDebounceSubmit = function () {
            clearTimeout(orderFiltersDebounceTimer);
            orderFiltersDebounceTimer = setTimeout(() => {
                document.getElementById('order-filters-form')?.submit();
            }, 500);
        };
    </script>
@endpush
