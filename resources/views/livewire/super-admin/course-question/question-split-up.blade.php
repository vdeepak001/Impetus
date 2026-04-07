<div>
    <div class="max-w-7xl mx-auto space-y-10">
        <!-- Header Section -->
        <div class="bg-white shadow-sm rounded-3xl p-8 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 transition-all duration-300">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-500 text-white shadow-xl shadow-brand-500/20">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight">Global Question Split Up</h2>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">Configure the default difficulty distribution for all automated assessments system-wide.</p>
                    </div>
                </div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route(App\Helpers\MenuHelper::getCurrentPrefix().'.dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-brand-500 transition-colors uppercase tracking-widest">Dashboard</a></li>
                        <li><svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></li>
                        <li><span class="text-xs font-bold text-gray-800 dark:text-white uppercase tracking-widest">Global Settings</span></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Settings Form Card -->
        <div class="bg-white shadow-2xl rounded-[2.5rem] overflow-hidden border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all duration-500">
            <div class="p-10 md:p-14">
                <form wire:submit.prevent="save" class="space-y-16">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        
                        <!-- Mock Test Configuration -->
                        <div class="relative group">
                            <div class="absolute -top-6 -left-2 h-12 w-12 bg-brand-500/5 rounded-full blur-2xl group-hover:bg-brand-500/10 transition-all"></div>
                            <div class="relative space-y-8">
                                <div class="flex items-center gap-3">
                                    <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.25em] group-hover:text-brand-500 transition-colors">Mock Test Distribution</h4>
                                </div>
                                <div class="flex items-end gap-5">
                                    @foreach(['mock_l1', 'mock_l2', 'mock_l3'] as $idx => $field)
                                        <div class="flex-1 space-y-2">
                                            <span class="block text-[10px] font-black text-gray-400/80 uppercase tracking-tighter text-center">Level {{ $idx + 1 }}</span>
                                            <input type="number" wire:model.defer="{{ $field }}" min="0"
                                                class="h-16 w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 text-center text-2xl font-black text-gray-800 focus:bg-white focus:border-brand-500 focus:ring-8 focus:ring-brand-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[10px] font-bold text-gray-400 text-center italic">Specify the count of L1, L2, and L3 questions for Mock Tests.</p>
                            </div>
                        </div>

                        <!-- Pre Test Configuration -->
                        <div class="relative group">
                            <div class="absolute -top-6 -left-2 h-12 w-12 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-all"></div>
                            <div class="relative space-y-8">
                                <div class="flex items-center gap-3">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.25em] group-hover:text-emerald-500 transition-colors">Pre Test Distribution</h4>
                                </div>
                                <div class="flex items-end gap-5">
                                    @foreach(['pre_l1', 'pre_l2', 'pre_l3'] as $idx => $field)
                                        <div class="flex-1 space-y-2">
                                            <span class="block text-[10px] font-black text-gray-400/80 uppercase tracking-tighter text-center">Level {{ $idx + 1 }}</span>
                                            <input type="number" wire:model.defer="{{ $field }}" min="0"
                                                class="h-16 w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 text-center text-2xl font-black text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[10px] font-bold text-gray-400 text-center italic">Specify the count of L1, L2, and L3 questions for Pre-Tests.</p>
                            </div>
                        </div>

                        <!-- Final Test Configuration -->
                        <div class="relative group">
                            <div class="absolute -top-6 -left-2 h-12 w-12 bg-purple-500/5 rounded-full blur-2xl group-hover:bg-purple-500/10 transition-all"></div>
                            <div class="relative space-y-8">
                                <div class="flex items-center gap-3">
                                    <span class="h-2 w-2 rounded-full bg-purple-500"></span>
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.25em] group-hover:text-purple-500 transition-colors">Final Test Distribution</h4>
                                </div>
                                <div class="flex items-end gap-5">
                                    @foreach(['final_l1', 'final_l2', 'final_l3'] as $idx => $field)
                                        <div class="flex-1 space-y-2">
                                            <span class="block text-[10px] font-black text-gray-400/80 uppercase tracking-tighter text-center">Level {{ $idx + 1 }}</span>
                                            <input type="number" wire:model.defer="{{ $field }}" min="0"
                                                class="h-16 w-full rounded-2xl border-2 border-gray-50 bg-gray-50/50 text-center text-2xl font-black text-gray-800 focus:bg-white focus:border-purple-500 focus:ring-8 focus:ring-purple-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[10px] font-bold text-gray-400 text-center italic">Specify the count of L1, L2, and L3 questions for Final Exams.</p>
                            </div>
                        </div>

                    </div>

                    <!-- Footer Action -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-8 pt-12 border-t border-gray-50 dark:border-gray-800">
                        <div class="flex items-center gap-4 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs font-bold uppercase tracking-widest">Settings are applied instantly to newly generated tests.</p>
                        </div>
                        <button type="submit" class="group relative w-full sm:w-auto px-12 py-5 rounded-[2rem] bg-brand-500 text-white text-sm font-black shadow-2xl shadow-brand-500/30 hover:bg-brand-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300 uppercase tracking-[0.2em]">
                            <span class="flex items-center justify-center gap-3">
                                <span>Save Global Settings</span>
                                <svg class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification script remains same (assumed handled by parent or standard system) -->
</div>
