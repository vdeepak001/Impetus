@php
    $frontendRegisterErrors = $errors->getBag('frontendRegister');
    $activeStates = \App\Models\State::query()
        ->where('status', 'active')
        ->orderBy('name')
        ->pluck('name');
@endphp

<div x-data="{ open: {{ $frontendRegisterErrors->isNotEmpty() ? 'true' : 'false' }} }"
     x-show="open"
     x-cloak
     id="register-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="register-modal-title"
     class="fixed inset-0 z-[9999] grid place-items-center p-4 sm:p-6"
     @open-register-modal.window="open = true"
     @keydown.escape.window="open = false">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"></div>

    <div class="relative z-10 w-full max-w-2xl rounded-3xl border border-slate-200/80 bg-white p-6 shadow-2xl shadow-slate-900/10 sm:p-7"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.stop>
        <div class="mb-5 flex items-start justify-between gap-4">
            <div>
                <h2 id="register-modal-title" class="font-serif text-xl font-semibold text-slate-900">Create account</h2>
                <p class="mt-1 text-sm text-slate-600">Register as a user with your nursing details. A random password will be emailed to you.</p>
            </div>
            <button type="button"
                    @click="open = false"
                    class="shrink-0 rounded-full p-2 text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-800"
                    aria-label="Close register dialog">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        @if (config('services.google.client_id'))
            <div class="mb-5">
                @include('welcome.partials.google-sign-in-button', ['asBlock' => true])
                <p class="mt-2 text-center text-xs text-slate-500">Quick sign-in with Google. You can complete your profile later from My Profile.</p>
            </div>
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-xs font-medium uppercase tracking-wide">
                    <span class="bg-white px-2 text-slate-500">Or register with details</span>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('frontend.register') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            @csrf
            <div class="sm:col-span-2">
                <label for="register-name" class="mb-1.5 block text-sm font-medium text-slate-700">Name</label>
                <input type="text"
                       id="register-name"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$frontendRegisterErrors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="register-state" class="mb-1.5 block text-sm font-medium text-slate-700">State</label>
                <select id="register-state"
                        name="state"
                        required
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25">
                    <option value="">Select state</option>
                    @foreach ($activeStates as $stateName)
                        <option value="{{ $stateName }}" @selected(old('state') === $stateName)>{{ $stateName }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$frontendRegisterErrors->get('state')" class="mt-2" />
            </div>

            <div>
                <label for="register-qualification" class="mb-1.5 block text-sm font-medium text-slate-700">Qualification</label>
                <select id="register-qualification"
                        name="qualification"
                        required
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25">
                    <option value="">Select qualification</option>
                    @foreach (['GNM', 'ANM', 'PB BSC Nursing', 'BSC Nursing', 'MSC Nursing', 'PHD Nursing'] as $qualification)
                        <option value="{{ $qualification }}" @selected(old('qualification') === $qualification)>{{ $qualification }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$frontendRegisterErrors->get('qualification')" class="mt-2" />
            </div>

            <div>
                <label for="register-dob" class="mb-1.5 block text-sm font-medium text-slate-700">Date of birth</label>
                <input type="date"
                       id="register-dob"
                       name="date_of_birth"
                       value="{{ old('date_of_birth') }}"
                       required
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$frontendRegisterErrors->get('date_of_birth')" class="mt-2" />
            </div>

            <div>
                <label for="register-email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input type="email"
                       id="register-email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$frontendRegisterErrors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="register-phone" class="mb-1.5 block text-sm font-medium text-slate-700">Phone</label>
                <input type="text"
                       id="register-phone"
                       name="phone"
                       value="{{ old('phone') }}"
                       required
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$frontendRegisterErrors->get('phone')" class="mt-2" />
            </div>

            <div>
                <label for="register-rn-number" class="mb-1.5 block text-sm font-medium text-slate-700">RN Number</label>
                <input type="text"
                       id="register-rn-number"
                       name="rn_number"
                       value="{{ old('rn_number') }}"
                       required
                       class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 focus:border-logo-light-green focus:outline-none focus:ring-2 focus:ring-logo-light-green/25" />
                <x-input-error :messages="$frontendRegisterErrors->get('rn_number')" class="mt-2" />
            </div>

            <div class="sm:col-span-2 mt-1">
                <button type="submit"
                        class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-logo-light-green/90 focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                    Create account
                </button>
            </div>
        </form>
    </div>
</div>

@if(session('registered_user'))
<div x-data="{ open: true }"
     x-show="open"
     x-cloak
     id="register-success-modal"
     role="dialog"
     aria-modal="true"
     class="fixed inset-0 z-[9999] grid place-items-center p-4 sm:p-6"
     @keydown.escape.window="open = false">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"></div>

    <div class="relative z-10 w-full max-w-md rounded-3xl border border-slate-200/80 bg-white p-6 shadow-2xl shadow-slate-900/10 sm:p-7"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.stop>
        
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <h2 class="mt-4 font-serif text-xl font-semibold text-slate-900">Registration Successful!</h2>
            <p class="mt-2 text-sm text-slate-600">Your account has been created. Please keep your login details safe.</p>
        </div>

        <div class="mt-6 rounded-xl bg-slate-50 p-4 border border-slate-200">
            <div class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-3 text-sm">
                <div class="text-slate-500">Name:</div>
                <div class="font-medium text-slate-900 break-all">{{ session('registered_user')['name'] }}</div>
                
                <div class="text-slate-500">Email:</div>
                <div class="font-medium text-slate-900 break-all">{{ session('registered_user')['email'] }}</div>
                
                <div class="text-slate-500 flex items-center">Password:</div>
                <div>
                    <span class="font-mono font-bold text-logo-blue bg-blue-50 px-2 py-1 rounded inline-block">{{ session('registered_user')['password'] }}</span>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <button type="button"
                    @click="open = false; $dispatch('open-login-modal')"
                    class="w-full rounded-full bg-logo-light-green px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-logo-light-green/90 focus:outline-none focus:ring-2 focus:ring-logo-light-green focus:ring-offset-2">
                Proceed to Login
            </button>
        </div>
    </div>
</div>
@endif
