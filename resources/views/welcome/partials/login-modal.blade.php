<div x-data="{ open: {{ ($errors->has('email') || $errors->has('password')) ? 'true' : 'false' }} }"
     x-show="open"
     x-cloak
     id="login-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="login-modal-title"
     class="fixed inset-0 z-[9999] grid place-items-center p-4 sm:p-6"
     @open-login-modal.window="open = true"
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
                <h2 id="login-modal-title" class="font-serif text-xl font-semibold text-slate-900">Log in</h2>
                <p class="mt-1 text-sm text-slate-600">Enter your email and password to continue.</p>
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

        <form method="POST" action="{{ route('frontend.login') }}" class="space-y-4">
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
                <input type="password"
                       name="password"
                       id="login-modal-password"
                       required
                       autocomplete="current-password"
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <label class="inline-flex cursor-pointer items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-logo-light-green focus:ring-logo-light-green" @checked(old('remember')) />
                    <span>Remember me</span>
                </label>
                <button type="submit"
                        formaction="{{ route('frontend.password.resend') }}"
                        formmethod="POST"
                        class="text-sm font-medium text-logo-blue hover:text-brand-900 hover:underline">
                    Resend login password
                </button>
            </div>
            <button type="submit"
                    class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-logo-light-green/90 focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                Sign in
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600">
            Don’t have an account?
            <button type="button" @click="open = false; $dispatch('open-register-modal')" class="font-medium text-logo-blue hover:underline">
                Register
            </button>
        </p>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
