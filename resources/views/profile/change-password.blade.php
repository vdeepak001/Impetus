@extends('layouts.frontend.app')

@section('title', 'Change Password')

@section('content')
    @php
        $inputClass = 'mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-700 focus:border-logo-blue focus:outline-none focus:ring-2 focus:ring-logo-blue/20';
    @endphp

    <section class="mx-auto max-w-3xl px-4 pb-16 pt-32 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h2 class="text-2xl font-semibold text-slate-900">Change Password</h2>
            <p class="mt-1 text-sm text-slate-500">Use a strong password to keep your account secure.</p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-slate-700">Current Password</label>
                    <input type="password" name="current_password" autocomplete="current-password" class="{{ $inputClass }}">
                    @error('current_password', 'updatePassword')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">New Password</label>
                    <input type="password" name="password" autocomplete="new-password" class="{{ $inputClass }}">
                    @error('password', 'updatePassword')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Confirm New Password</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password" class="{{ $inputClass }}">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex rounded-full bg-logo-light-green px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-green-600">
                        UPDATE PASSWORD
                    </button>
                    <a href="{{ route('profile') }}" class="text-sm font-medium text-logo-blue hover:underline">Back to Profile</a>
                </div>
            </form>
        </div>
    </section>
@endsection
