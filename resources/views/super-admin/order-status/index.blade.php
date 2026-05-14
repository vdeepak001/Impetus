@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                {{ $title }}
            </h2>
        </div>

        <div class="w-full max-w-xs">
            <form action="{{ request()->url() }}" method="GET" id="order-status-filters" class="relative">
                <input 
                    type="text" 
                    name="search"
                    id="order-search"
                    value="{{ $filters['search'] ?? '' }}"
                    placeholder="Search orders..."
                    oninput="window.orderStatusDebounceSubmit()"
                    class="w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400 shadow-sm"
                >
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-8">
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#0082c8]">
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Sl.No</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">UID</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Module name</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Date of purchase</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20">Time of purchase</th>
                        <th class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider border-b border-blue-400/20 text-center">Status (S/P/F/A)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $order->user->unique_sequence_number ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white uppercase">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $order->courseDetail->couse_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $order->created_at->format('h:i A') }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-center">
                                @php
                                    $statusChar = match($order->payment_status->value) {
                                        'completed' => 'S',
                                        'pending' => 'P',
                                        'failed' => 'F',
                                        'aborted' => 'A',
                                        default => '?'
                                    };
                                    $statusColor = match($statusChar) {
                                        'S' => 'text-green-600',
                                        'P' => 'text-blue-600',
                                        'F' => 'text-red-600',
                                        'A' => 'text-orange-600',
                                        default => 'text-gray-600'
                                    };
                                @endphp
                                <span class="{{ $statusColor }}">{{ $statusChar }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-20 text-center">
                                <p class="text-lg font-semibold text-gray-400 dark:text-gray-500">No orders found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($orders->hasPages())
        <div class="mb-8">
            {{ $orders->links() }}
        </div>
    @endif

    <div class="mt-10 bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex flex-wrap gap-8 justify-center items-center text-sm font-bold text-gray-600 dark:text-gray-400">
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-lg">S</span>
                <span>- Success</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-blue-600 text-lg">P</span>
                <span>- Purchased</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-red-600 text-lg">F</span>
                <span>- Failed</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-orange-600 text-lg">A</span>
                <span>- Aborted</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let orderStatusDebounceTimer;

        window.orderStatusDebounceSubmit = function () {
            clearTimeout(orderStatusDebounceTimer);
            orderStatusDebounceTimer = setTimeout(() => {
                document.getElementById('order-status-filters')?.submit();
            }, 500);
        };
    </script>
@endpush
