<div
    class="space-y-6"
    x-data="usersList(@js(url(App\Helpers\MenuHelper::getCurrentPrefix() . '/users-list')), @js(csrf_token()))"
    @keydown.escape.window="
        if (paymentOpen) { closePayment() }
        else if (detailOpen) { closeDetail() }
        else if (courseOpen) { closeCourse() }
        else if (performanceOpen) { closePerformance() }
    "
>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                Users List
            </h2>
           
        </div>

        <div class="w-full max-w-xs">
            <div class="relative">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search users..."
                    class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                >
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div wire:loading wire:target="search" class="absolute right-3 top-2.5">
                    <svg class="animate-spin h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Legends --}}
    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-6 px-1">
        <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
            Profile Details
        </div>
        @if(auth()->user()->role_type !== 'support')
        <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                </svg>
            </span>
            Module Activation
        </div>
        @endif
        <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-sky-50 text-sky-700 dark:bg-sky-900/20 dark:text-sky-400">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </span>
            Purchased Modules
        </div>
        <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-purple-50 text-purple-700 dark:bg-purple-900/20 dark:text-purple-400">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0V12m0 4.5V12m0 0h7.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 12h7.5m-7.5 0v3.75m0-3.75l3-3m0 0l3 3m-3-3v8.25m0-8.25L7.5 12" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6.75h3M12 3v3.75" />
                </svg>
            </span>
            Performance Analysis
        </div>
    </div>


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
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Unique ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Password
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Phone
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $user->unique_sequence_number ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $user->name ?: trim(($user->first_name ?? '').' '.($user->last_name ?? '')) ?: '—' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $user->email ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $user->password_raw ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $user->phone ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="inline-flex items-center justify-end gap-1">
                                    <button
                                        type="button"
                                        @click="openDetail(@js($user->only($userProfileKeys)))"
                                        class="inline-flex items-center justify-center rounded-lg p-2 text-indigo-600 transition-colors hover:bg-indigo-50 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 dark:text-indigo-400 dark:hover:bg-gray-700 dark:hover:text-indigo-300 dark:focus:ring-offset-gray-800"
                                        title="View user details"
                                    >
                                        <span class="sr-only">View user details</span>
                                        <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                    @if(auth()->user()->role_type !== 'support')
                                    <button
                                        type="button"
                                        @click="openPayment({{ $user->id }})"
                                        class="inline-flex items-center justify-center rounded-lg p-2 text-emerald-700 transition-colors hover:bg-emerald-50 hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 dark:text-emerald-400 dark:hover:bg-gray-700 dark:hover:text-emerald-300 dark:focus:ring-offset-gray-800"
                                        title="Module Activation"
                                    >
                                        <span class="sr-only">Module Activation</span>
                                        <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </button>
                                    @endif
                                    <button
                                        type="button"
                                        @click="openCourse({{ $user->id }})"
                                        class="inline-flex items-center justify-center rounded-lg p-2 text-sky-700 transition-colors hover:bg-sky-50 hover:text-sky-900 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-1 dark:text-sky-400 dark:hover:bg-gray-700 dark:hover:text-sky-300 dark:focus:ring-offset-gray-800"
                                        title="View purchased modules"
                                    >
                                        <span class="sr-only">View courses</span>
                                        <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        @click="openPerformance({{ $user->id }})"
                                        class="inline-flex items-center justify-center rounded-lg p-2 text-purple-700 transition-colors hover:bg-purple-50 hover:text-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1 dark:text-purple-400 dark:hover:bg-gray-700 dark:hover:text-purple-300 dark:focus:ring-offset-gray-800"
                                        title="View performance chart"
                                    >
                                        <span class="sr-only">View performance</span>
                                        <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0V12m0 4.5V12m0 0h7.5" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 12h7.5m-7.5 0v3.75m0-3.75l3-3m0 0l3 3m-3-3v8.25m0-8.25L7.5 12" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6.75h3M12 3v3.75" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                {{ $search ? 'No users found matching "'. $search .'".' : 'No users with this role yet.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($users->hasPages())
        <div class="px-2 mt-4">
            {{ $users->links() }}
        </div>
    @endif

    {{-- Profile detail popup --}}
    <div
        x-show="detailOpen"
        x-cloak
        class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
    >
        <div
            @click="closeDetail()"
            class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            @click.stop
            class="relative w-full max-w-2xl max-h-[85vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <button
                type="button"
                @click="closeDetail()"
                class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
            >
                <span class="sr-only">Close</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                        fill="currentColor" />
                </svg>
            </button>

            <div class="p-6 sm:p-10 overflow-y-auto max-h-[85vh]">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                    User profile
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    {{ auth()->user()->role_type === 'support' ? 'View learner account information.' : 'Update learner account information.' }}
                </p>

                <form @submit.prevent="submitDetailUpdate">
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($profileLabels as $key => $label)
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wide dark:text-gray-400">
                                    {{ $label }}
                                </label>
                                @if ($key === 'date_of_birth')
                                    <input type="date" x-model="detailForm['{{ $key }}']"
                                        @if(auth()->user()->role_type === 'support') readonly @endif
                                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                                @else
                                    <input type="text" x-model="detailForm['{{ $key }}']"
                                        @if(auth()->user()->role_type === 'support') readonly @endif
                                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        @if(auth()->user()->role_type === 'support')
                            <button type="button" @click="closeDetail()"
                                class="rounded-lg border border-gray-300 bg-logo-light-green px-8 py-2 text-sm font-bold text-white shadow transition hover:bg-green-600">
                                Close
                            </button>
                        @else
                            <button type="button" @click="closeDetail()"
                                class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-sm font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                Cancel
                            </button>
                            <button type="submit" :disabled="detailSubmitting"
                                class="inline-flex items-center rounded-lg bg-logo-light-green px-6 py-2 text-sm font-bold text-white shadow transition hover:bg-green-600 disabled:opacity-60">
                                <span x-show="! detailSubmitting">UPDATE INFORMATION</span>
                                <span x-show="detailSubmitting" x-cloak>Updating…</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Record payment popup --}}
    <div
        x-show="paymentOpen"
        x-cloak
        class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
    >
        <div
            @click="closePayment()"
            class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            @click.stop
            class="relative w-full max-w-lg max-h-[90vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <button
                type="button"
                @click="closePayment()"
                class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
            >
                <span class="sr-only">Close</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                        fill="currentColor" />
                </svg>
            </button>

            <div class="p-6 sm:p-8 overflow-y-auto max-h-[90vh]">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                     Module Activation
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Link a completed payment to a module available for this learner’s state. Start date defaults to today; end date is automatically calculated based on the module’s validity period and must be on or after the start date.
                </p>

                <div x-show="paymentLoading" class="text-sm text-gray-500 dark:text-gray-400 mb-4">Loading modules…</div>

                <p x-show="! paymentLoading && paymentInfoMessage" x-text="paymentInfoMessage"
                    class="text-sm text-amber-700 dark:text-amber-400 mb-4"></p>

                <div x-show="paymentError"
                    class="mb-4 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-800 dark:bg-red-900/30 dark:text-red-200"
                    x-text="paymentError"></div>

                <form class="space-y-4" @submit.prevent="submitPayment">
                    <div>
                        <label for="order-course" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Module</label>
                        <select id="order-course" x-model="paymentForm.course_detail_id" required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                            <option value="" disabled>Select a module</option>
                            <template x-for="c in paymentCourses" :key="c.id">
                                <option :value="String(c.id)" x-text="c.name + (c.is_failed ? ' (Failed - New purchase resets attempts)' : '')"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label for="order-payment-mode" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Payment mode</label>
                        <select id="order-payment-mode" x-model="paymentForm.payment_mode" required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                            <template x-for="m in paymentModes" :key="m.value">
                                <option :value="m.value" x-text="m.label"></option>
                            </template>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="order-start" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Start date</label>
                            <input id="order-start" type="date" x-model="paymentForm.start_date" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                        </div>
                        <div>
                            <label for="order-end" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">End date</label>
                            <input id="order-end" type="date" x-model="paymentForm.end_date" required
                                :min="paymentForm.start_date || todayISO()"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" />
                        </div>
                    </div>

                    <div>
                        <label for="order-remarks" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks</label>
                        <textarea id="order-remarks" x-model="paymentForm.remarks" rows="3"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                            placeholder="Optional notes"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="closePayment()"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" :disabled="paymentSubmitting || paymentLoading"
                            class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-60">
                            <span x-show="! paymentSubmitting">Activate</span>
                            <span x-show="paymentSubmitting" x-cloak>Activating…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- My Course popup --}}
    <div
        x-show="courseOpen"
        x-cloak
        class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
    >
        <div
            @click="closeCourse()"
            class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            @click.stop
            class="relative w-full max-w-4xl max-h-[90vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <button
                type="button"
                @click="closeCourse()"
                class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
            >
                <span class="sr-only">Close</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                        fill="currentColor" />
                </svg>
            </button>

            <div class="p-6 sm:p-8 overflow-y-auto max-h-[90vh]">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                    Purchased Modules
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Modules purchased by this learner and their completion status.
                </p>

                <div x-show="courseLoading" class="text-sm text-gray-500 dark:text-gray-400">Loading module data…</div>

                <div x-show="!courseLoading">
                    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Module</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Purchase Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Expiry Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Completion Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Status</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold uppercase text-gray-500 dark:text-gray-400">Certificate</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                <template x-for="(order, index) in courseOrders" :key="order.id">
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300" x-text="index + 1"></td>
                                        <td class="px-4 py-3 text-sm font-semibold text-gray-900 dark:text-white" x-text="order.course_name"></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300" x-text="order.purchase_date"></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300" x-text="order.expiry_date"></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300" x-text="order.completion_date"></td>
                                        <td class="px-4 py-3 text-sm">
                                            <template x-if="order.passed">
                                                <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-bold text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">Passed</span>
                                            </template>
                                            <template x-if="!order.passed && order.completion_date !== '-'">
                                                <span class="inline-flex rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-bold text-rose-800 dark:bg-rose-900/30 dark:text-rose-400">Failed</span>
                                            </template>
                                            <template x-if="order.completion_date === '-'">
                                                <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-bold text-gray-800 dark:bg-gray-800 dark:text-gray-400">Not Completed</span>
                                            </template>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <template x-if="order.passed">
                                                <a :href="`/certificates/${order.id}/download`" 
                                                   target="_blank"
                                                   class="inline-flex items-center justify-center rounded-lg p-1.5 text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-blue-400 dark:hover:bg-gray-700"
                                                   title="View Certificate">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </a>
                                            </template>
                                            <template x-if="!order.passed">
                                                <span class="text-gray-400">—</span>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="courseOrders.length === 0">
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">No modules purchased yet.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" @click="closeCourse()"
                        class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-sm font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Performance chart popup --}}
    <div
        x-show="performanceOpen"
        x-cloak
        class="fixed inset-0 z-[99999] flex items-center justify-center overflow-y-auto p-5"
    >
        <div
            @click="closePerformance()"
            class="fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            @click.stop
            class="relative w-full max-w-3xl max-h-[90vh] overflow-hidden rounded-3xl bg-white shadow-xl dark:bg-gray-900"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
        >
            <button
                type="button"
                @click="closePerformance()"
                class="absolute right-3 top-3 z-10 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11"
            >
                <span class="sr-only">Close</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                        fill="currentColor" />
                </svg>
            </button>

            <div class="p-6 sm:p-10 overflow-y-auto max-h-[90vh]">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 pr-10">
                    Performance Analysis
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Visual comparison of test scores across all purchased modules.
                </p>

                {{-- Module Filter Dropdown --}}
                <div x-show="!performanceLoading && performanceOrders.length > 0" class="mb-8 max-w-xs">
                    <label for="perf-module-select" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Course Module
                    </label>
                    <div class="relative">
                        <select 
                            id="perf-module-select" 
                            x-model="selectedPerformanceModule"
                            class="block w-full appearance-none rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 pr-10 text-sm font-medium text-gray-700 transition-all hover:border-indigo-300 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/10 dark:border-gray-700 dark:bg-gray-800/50 dark:text-gray-200 dark:hover:border-indigo-500/50 dark:focus:bg-gray-800"
                        >
                            <option value="all">All Modules</option>
                            <template x-for="order in performanceOrders" :key="order.id">
                                <option :value="String(order.id)" x-text="order.course_name + ' (' + order.purchase_date + ')'"></option>
                            </template>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div x-show="performanceLoading" class="flex flex-col items-center justify-center py-20">
                    <svg class="animate-spin h-10 w-10 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Loading graphical data...</p>
                </div>

                <div x-show="!performanceLoading">
                    <template x-if="performanceOrders.length > 0">
                        <div id="performanceChart" class="min-h-[350px]"></div>
                    </template>
                    <template x-if="performanceOrders.length === 0">
                        <div class="flex flex-col items-center justify-center py-20 bg-gray-50/50 dark:bg-gray-800/30 rounded-3xl border border-dashed border-gray-200 dark:border-gray-700">
                            <div class="mb-4 rounded-full bg-gray-100 p-4 dark:bg-gray-800">
                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">No Modules Purchased</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This user has not purchased any modules yet.</p>
                        </div>
                    </template>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" @click="closePerformance()"
                        class="rounded-lg border border-gray-300 bg-white px-6 py-2 text-sm font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
