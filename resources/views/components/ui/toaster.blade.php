{{-- resources/views/components/ui/toaster.blade.php --}}
@props([
    'variant' => 'success',
    'title' => '',
    'message' => '',
])

<div
    x-data="{
        show: false,
        message: '',
        title: '',
        variant: 'success',
        timeout: null,
        
        init() {
            @if(session()->has('success'))
                this.notify({{ \Illuminate\Support\Js::from(session('success')) }}, 'Success', 'success');
            @endif
            @if(session()->has('error'))
                this.notify({{ \Illuminate\Support\Js::from(session('error')) }}, 'Error', 'error');
            @endif

            window.addEventListener('notify', (event) => {
                let data = event.detail;
                if (!data) return;

                // Livewire 3 dispatches parameters as an object or array
                let msg = data.message || (Array.isArray(data) ? data[0]?.message : null) || (typeof data === 'string' ? data : '');
                let t = data.title || (Array.isArray(data) ? data[0]?.title : '') || '';
                let v = data.variant || (Array.isArray(data) ? data[0]?.variant : 'success') || 'success';

                if (msg) {
                    this.notify(msg, t, v);
                }
            });
        },

        notify(message, title, variant) {
            if (this.timeout) clearTimeout(this.timeout);
            
            this.show = false;
            
            this.$nextTick(() => {
                this.message = message;
                this.title = title;
                this.variant = variant;
                this.show = true;

                this.timeout = setTimeout(() => {
                    this.show = false;
                }, 5000);
            });
        }
    }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-20 right-4 z-[100000] w-full max-w-sm rounded-xl border bg-white shadow-2xl dark:bg-gray-900"
    :class="{
        'border-green-500/50 dark:border-green-500/50': variant === 'success',
        'border-red-500/50 dark:border-red-500/50': variant === 'error',
        'border-blue-500/50 dark:border-blue-500/50': variant === 'info',
        'border-yellow-500/50 dark:border-yellow-500/50': variant === 'warning',
    }"
    style="display: none;"
>
    <div class="p-4">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <!-- Success Icon -->
                <template x-if="variant === 'success'">
                    <div class="text-green-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </template>
                <!-- Error Icon -->
                <template x-if="variant === 'error'">
                    <div class="text-red-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </template>
                <!-- Info Icon -->
                <template x-if="variant === 'info'">
                    <div class="text-blue-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                </template>
                <!-- Warning Icon -->
                <template x-if="variant === 'warning'">
                    <div class="text-yellow-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </template>
            </div>
            <div class="flex-1 pt-0.5">
                <p x-text="title" class="text-sm font-semibold text-gray-900 dark:text-white"></p>
                <p x-text="message" class="mt-1 text-sm text-gray-500 dark:text-gray-400"></p>
            </div>
            <div class="ml-4 flex flex-shrink-0">
                <button type="button" @click="show = false" class="inline-flex rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:hover:text-gray-300">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Progress bar for auto-dismiss -->
    <div class="h-1 bg-gray-100 dark:bg-gray-800">
        <div x-show="show" 
             class="h-full transition-all duration-[5000ms] ease-linear"
             :class="{
                'w-full': show,
                'w-0': !show,
                'bg-green-500': variant === 'success',
                'bg-red-500': variant === 'error',
                'bg-blue-500': variant === 'info',
                'bg-yellow-500': variant === 'warning',
             }">
        </div>
    </div>
</div>
