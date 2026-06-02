@extends('layouts.fullscreen-layout')

@section('content')
    <div class="relative min-h-screen overflow-hidden bg-white dark:bg-gray-950">
        <div class="relative flex min-h-screen w-full flex-col lg:flex-row">
            <div class="flex w-full flex-1 items-center justify-center p-6 sm:p-10 lg:w-1/2 lg:bg-[#f8fafc] dark:lg:bg-gray-950">
                <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-xl sm:p-10 dark:border-gray-800 dark:bg-gray-900">
                    <div>
                        <div class="mb-6 sm:mb-8">
                            <p class="mb-2 text-xs font-semibold tracking-[0.2em] text-brand-500 uppercase">Welcome back</p>
                            <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800 dark:text-white/90">
                                Sign In
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Enter your credentials to access your student portal.
                            </p>
                        </div>
                        <div>
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="space-y-5">
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Email Address<span class="text-error-500">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-xl border border-gray-300 bg-slate-50 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Password<span class="text-error-500">*</span>
                                        </label>
                                        <div x-data="{ showPassword: false }" class="relative">
                                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                                placeholder="Enter your password"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-xl border border-gray-300 bg-slate-50 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                            <span @click="showPassword = !showPassword"
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500 dark:text-gray-400">
                                                <svg x-show="!showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" fill="#98A2B3" />
                                                </svg>
                                                <svg x-show="showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"
                                                        fill="#98A2B3" />
                                                </svg>
                                            </span>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="flex items-center justify-between gap-3">
                                        <div x-data="{ checkboxToggle: {{ old('remember') ? 'true' : 'false' }} }">
                                            <label for="remember"
                                                class="flex cursor-pointer items-center text-sm font-normal text-gray-700 select-none dark:text-gray-400">
                                                <div class="relative">
                                                    <input type="checkbox" id="remember" name="remember" class="sr-only" @change="checkboxToggle = !checkboxToggle" />
                                                    <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                                        'bg-transparent border-gray-300 dark:border-gray-700'"
                                                        class="mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                        <span :class="checkboxToggle ? '' : 'opacity-0'">
                                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                                Keep me logged in
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-brand-500 hover:text-brand-600 text-sm font-semibold transition dark:text-brand-400">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 flex h-11 w-full items-center justify-center rounded-xl px-4 py-3 text-sm font-semibold text-white transition">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-5">
                                <p class="text-center text-sm font-normal text-gray-700 dark:text-gray-400">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="text-brand-500 hover:text-brand-600 dark:text-brand-400">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative hidden w-full items-center justify-center bg-gradient-to-br from-[#0b1430] via-[#111b3a] to-[#1d3a77] px-8 py-12 lg:flex lg:min-h-screen lg:w-1/2">
                <div class="absolute inset-0 opacity-30">
                    <div class="h-full w-full bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.18),transparent_42%),radial-gradient(circle_at_70%_80%,rgba(56,189,248,0.18),transparent_40%)]"></div>
                </div>
                <div class="relative z-10 mx-auto w-full max-w-md rounded-3xl border border-white/10 bg-white/8 p-10 shadow-2xl backdrop-blur-lg">
                    <div class="mx-auto mb-6 flex h-20 w-56 items-center justify-center rounded-2xl bg-white/95 p-3 shadow-lg">
                        <img src="{{ asset('images/venture.svg') }}" alt="Logo" class="h-full w-auto object-contain" />
                    </div>
                    <h2 class="mb-4 text-center text-2xl font-semibold text-brand-400">
                        Ventura Learning Solutions
                    </h2>
                    <p class="mx-auto mb-6 max-w-sm text-center text-sm leading-6 text-slate-200">
                        Empowering healthcare professionals through engaging courses, exam preparation, and interactive training.
                    </p>
                    <p class="text-center text-xs tracking-[0.22em] text-teal-300 uppercase">
                        Ventura Secure Learning Gateway
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
