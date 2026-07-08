@extends('layouts.frontend.app')

@section('title', 'Secure Payment Redirect')

@section('content')
<main class="min-h-screen flex items-center justify-center bg-slate-950 text-white relative overflow-hidden pb-16 pt-32">
    <!-- Background glow effects -->
    <div class="absolute top-1/4 left-1/4 w-[400px] h-[400px] rounded-full bg-blue-600/10 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] rounded-full bg-indigo-600/10 blur-[100px] pointer-events-none"></div>

    <div class="relative z-10 max-w-md w-full mx-6 p-8 rounded-3xl border border-slate-800/80 bg-slate-900/60 backdrop-blur-xl shadow-2xl ring-1 ring-slate-800 text-center space-y-8">
        <!-- Brand/Icon -->
        <div class="flex justify-center">
            <div class="relative flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 shadow-xl shadow-blue-500/20">
                <svg class="w-10 h-10 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                <div class="absolute inset-0 rounded-2xl border border-white/20"></div>
            </div>
        </div>

        <div class="space-y-3">
            <h1 class="text-2xl font-bold tracking-tight text-white">Secure Checkout</h1>
            <p class="text-sm text-slate-400 leading-relaxed">
                We are redirecting you to CCAvenue to securely complete your payment. Please do not close this window or refresh the page.
            </p>
        </div>

        <!-- Animated Progress/Spinner -->
        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="relative flex items-center justify-center">
                <!-- Glowing rotating outer ring -->
                <div class="w-16 h-16 rounded-full border-t-2 border-r-2 border-b-2 border-transparent border-t-blue-500 border-r-indigo-500 animate-spin"></div>
                <!-- Inner pulse -->
                <div class="absolute w-10 h-10 rounded-full bg-gradient-to-r from-blue-500/20 to-indigo-500/20 animate-ping"></div>
            </div>
            <span class="text-xs font-semibold tracking-widest text-blue-400 uppercase animate-pulse">Connecting Securely...</span>
        </div>

        <!-- Hidden Auto-submit Form -->
        <form id="ccavenue_form" method="POST" action="{{ $ccavenueUrl }}">
            <input type="hidden" name="encRequest" value="{{ $encRequest }}">
            <input type="hidden" name="access_code" value="{{ $accessCode }}">
            <noscript>
                <div class="pt-4 space-y-4">
                    <p class="text-xs text-slate-400">If you are not redirected automatically in a few seconds, click the button below.</p>
                    <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-blue-500/20 hover:bg-blue-500 transition">
                        Submit Payment
                    </button>
                </div>
            </noscript>
        </form>
    </div>
</main>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.getElementById('ccavenue_form').submit();
        }, 1200); // 1.2s delay for a smoother premium user visual experience
    });
</script>
@endsection
