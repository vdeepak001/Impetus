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
