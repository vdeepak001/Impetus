<div class="space-y-6">
    <div class="flex items-center gap-4 p-6 bg-gray-50 rounded-2xl border border-gray-200 dark:bg-gray-800/30 dark:border-gray-700">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-500 text-white shadow-lg shadow-brand-500/20">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
        </div>
        <div>
            <h4 class="text-base font-bold text-gray-800 dark:text-white/90">Test Question Difficulty Distribution</h4>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-1">Configure the difficult level split up for Mock, Pre and Final tests.</p>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Mock Test Configuration -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all hover:shadow-md">
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                        <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Mock Test</h5>
                    </div>
                    <div class="flex items-end gap-3">
                        @foreach(['mock_l1', 'mock_l2', 'mock_l3'] as $idx => $field)
                            <div class="flex-1 space-y-1">
                                <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                                <input type="number" wire:model.defer="{{ $field }}" min="0"
                                    class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Pre Test Configuration -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all hover:shadow-md">
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Pre Test</h5>
                    </div>
                    <div class="flex items-end gap-3">
                        @foreach(['pre_l1', 'pre_l2', 'pre_l3'] as $idx => $field)
                            <div class="flex-1 space-y-1">
                                <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                                <input type="number" wire:model.defer="{{ $field }}" min="0"
                                    class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Final Test Configuration -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all hover:shadow-md">
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-purple-500"></span>
                        <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Final Test</h5>
                    </div>
                    <div class="flex items-end gap-3">
                        @foreach(['final_l1', 'final_l2', 'final_l3'] as $idx => $field)
                            <div class="flex-1 space-y-1">
                                <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                                <input type="number" wire:model.defer="{{ $field }}" min="0"
                                    class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center gap-3 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-[10px] font-bold uppercase tracking-widest">Settings are applied to this council immediately.</p>
            </div>
            <button type="submit" class="px-8 py-3 rounded-xl bg-brand-500 text-white text-xs font-black shadow-lg shadow-brand-500/20 hover:bg-brand-600 transition-all uppercase tracking-widest">
                Save Distribution
            </button>
        </div>
    </form>
</div>

