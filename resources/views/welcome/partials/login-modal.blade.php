<div x-data="{
         open: {{ ($errors->has('email') || $errors->has('password') || session('success')) ? 'true' : 'false' }},
         showPassword: false,
         mode: '{{ old('form_type') === 'forgot' ? 'forgot' : 'login' }}'
     }"
     x-show="open"
     x-cloak
     id="login-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="login-modal-title"
     class="fixed inset-0 z-[9999] grid place-items-center p-4 sm:p-6"
     @open-login-modal.window="open = true; mode = 'login'"
     @keydown.escape.window="open = false">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"></div>

    <div class="relative z-10 w-full max-w-md rounded-3xl border border-slate-200/80 bg-white p-6 shadow-2xl shadow-slate-900/10"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.stop>
        <div class="mb-6 flex items-start justify-between gap-4">
            <div>
                <h2 id="login-modal-title" class="font-serif text-xl font-semibold text-slate-900" x-text="mode === 'login' ? 'Log in' : 'Forgot Password'">Log in</h2>
                <p class="mt-1 text-sm text-slate-600" x-text="mode === 'login' ? 'Enter your email and password to continue.' : 'Enter your email address and we will send you a new password.'">Enter your email and password to continue.</p>
            </div>
            <button type="button"
                    @click="open = false"
                    class="shrink-0 rounded-full p-2 text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-800"
                    aria-label="Close login dialog">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        @if (config('services.google.client_id'))
            <div x-show="mode === 'login'">
                <div class="mb-5">
                    @include('welcome.partials.google-sign-in-button', ['asBlock' => true])
                </div>
                <div class="relative mb-5">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-medium uppercase tracking-wide">
                        <span class="bg-white px-2 text-slate-500">Or continue with email</span>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('frontend.login') }}" class="space-y-4" x-show="mode === 'login'">
            @csrf
            <div>
                <label for="login-modal-email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input type="email"
                       name="email"
                       id="login-modal-email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <label for="login-modal-password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'"
                           name="password"
                           id="login-modal-password"
                           required
                           autocomplete="current-password"
                           class="block w-full rounded-xl border border-slate-300 bg-white pl-4 pr-11 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                            aria-label="Toggle password visibility">
                        <!-- Eye open icon (visible when showPassword is true) -->
                        <svg x-show="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <!-- Eye closed icon (visible when showPassword is false) -->
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-logo-light-green focus:ring-logo-light-green" @checked(old('remember')) />
                    <span>Remember me</span>
                </label>
                <button type="button"
                        @click="mode = 'forgot'"
                        class="text-sm font-medium text-logo-blue hover:underline">
                    Forgot password?
                </button>
            </div>
            <button type="submit"
                    class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-logo-light-green/90 focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                Sign in
            </button>
        </form>

        <form method="POST" action="{{ route('frontend.password.resend') }}" class="space-y-4" x-show="mode === 'forgot'" x-cloak>
            @csrf
            <input type="hidden" name="form_type" value="forgot">
            <div>
                <label for="forgot-modal-email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input type="email"
                       name="email"
                       id="forgot-modal-email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <button type="submit"
                    class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-logo-light-green/90 focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                Send login password
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600" x-show="mode === 'login'">
            Don’t have an account?
            <button type="button" @click="open = false; $dispatch('open-register-modal')" class="font-medium text-logo-blue hover:underline">
                Register
            </button>
        </p>

        <p class="mt-5 text-center text-sm text-slate-600" x-show="mode === 'forgot'" x-cloak>
            Remembered your password?
            <button type="button" @click="mode = 'login'" class="font-medium text-logo-blue hover:underline">
                Back to login
            </button>
        </p>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
