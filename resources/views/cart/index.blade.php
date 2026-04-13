@extends('layouts.frontend.app')

@section('title', 'Cart')

@section('content')
    <main class="pb-16">
        <div class="h-[140px]" aria-hidden="true"></div>

        <section class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="font-serif text-3xl font-bold tracking-tight text-slate-900">My Cart</h1>
                    <p class="mt-2 text-sm text-slate-600">Modules you added for purchase.</p>
                </div>
                <a href="{{ route('cne.modules') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-50">
                    Browse modules
                </a>
            </div>

            <div class="mt-10">
                @if ($items->isEmpty())
                    <div class="rounded-3xl border border-slate-200/80 bg-white px-8 py-14 text-center shadow-lg shadow-slate-200/50 ring-1 ring-slate-100">
                        <p class="text-lg leading-8 text-slate-600">Your cart is empty.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div class="lg:col-span-2 space-y-4">
                            @foreach ($items as $item)
                                @php
                                    $course = $item->courseDetail;
                                    $title = $course?->couse_name ?? 'Module';
                                    $imgUrl = $course?->attachmentPublicUrl();
                                    $isImage = $course?->attachmentIsImage() ?? false;
                                    $price = $item->offer_price ?? $item->mrp;
                                @endphp
                                <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-md shadow-slate-200/60 ring-1 ring-slate-100">
                                    <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:gap-6">
                                        <a href="{{ route('cne.modules.show', $course?->couse_name) }}" class="block overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 sm:h-28 sm:w-36">
                                            @if ($imgUrl && $isImage)
                                                <img src="{{ $imgUrl }}" alt="{{ $title }}" class="h-full w-full object-cover" loading="lazy">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-slate-400">
                                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex flex-col gap-1">
                                                <a href="{{ route('cne.modules.show', $course?->couse_name) }}" class="truncate text-lg font-semibold text-slate-900 hover:text-logo-blue">
                                                    {{ $title }}
                                                </a>
                                                <div class="flex flex-wrap gap-x-6 gap-y-1 text-sm text-slate-600">
                                                    @if (! is_null($item->valid_days))
                                                        <span>Valid: {{ $item->valid_days }} days</span>
                                                    @endif
                                                    @if (! is_null($item->pass_percentage))
                                                        <span>Pass: {{ $item->pass_percentage }}%</span>
                                                    @endif
                                                    @if (! is_null($item->points))
                                                        <span>Credits: {{ $item->points }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between gap-4 sm:flex-col sm:items-end sm:justify-center">
                                            <div class="text-right">
                                                <div class="text-sm text-slate-500">Price</div>
                                                <div class="text-xl font-bold text-slate-900">
                                                    {{ $price ? '₹'.$price : 'N/A' }}
                                                </div>
                                                @if (! is_null($item->mrp) && ! is_null($item->offer_price) && $item->offer_price < $item->mrp)
                                                    <div class="text-xs text-slate-500 line-through">₹{{ $item->mrp }}</div>
                                                @endif
                                            </div>

                                            <form method="POST" action="{{ route('cart.items.destroy', $course?->couse_name) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="h-fit rounded-3xl border border-slate-200/80 bg-white p-6 shadow-md shadow-slate-200/60 ring-1 ring-slate-100">
                            @php
                                $total = $items->sum(function ($item) {
                                    return (int) ($item->offer_price ?? $item->mrp ?? 0);
                                });
                            @endphp
                            <h2 class="font-serif text-xl font-bold text-slate-900">Summary</h2>
                            <div class="mt-5 flex items-center justify-between text-sm text-slate-600">
                                <span>Items</span>
                                <span class="font-semibold text-slate-900">{{ $items->count() }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between text-sm text-slate-600">
                                <span>Total</span>
                                <span class="text-lg font-bold text-slate-900">₹{{ $total }}</span>
                            </div>
                            <div class="mt-6">
                                <button type="button" disabled class="w-full cursor-not-allowed rounded-xl bg-logo-blue/60 px-5 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-logo-blue/20">
                                    Checkout
                                </button>
                                <p class="mt-3 text-xs text-slate-500">Checkout will be enabled once payment flow is connected.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
