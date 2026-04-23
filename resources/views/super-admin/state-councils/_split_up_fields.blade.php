@php
    $split = $splitUp ?? null;
@endphp

<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Pre Test Configuration -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all hover:shadow-md">
            <div class="space-y-6">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Pre Test</h5>
                </div>
                <div class="flex items-end gap-3">
                    @foreach(['l1', 'l2', 'l3'] as $idx => $level)
                        @php $field = 'pre_'.$level; @endphp
                        <div class="flex-1 space-y-1">
                            <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                            <input type="number" name="split_up[{{ $field }}]" value="{{ old('split_up.'.$field, $split ? $split->$field : 0) }}" min="0"
                                class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Mock Test Configuration -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 dark:bg-gray-900 dark:border-gray-800 transition-all hover:shadow-md">
            <div class="space-y-6">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                    <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Mock Test</h5>
                </div>
                <div class="flex items-end gap-3">
                    @foreach(['l1', 'l2', 'l3'] as $idx => $level)
                        @php $field = 'mock_'.$level; @endphp
                        <div class="flex-1 space-y-1">
                            <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                            <input type="number" name="split_up[{{ $field }}]" value="{{ old('split_up.'.$field, $split ? $split->$field : 0) }}" min="0"
                                class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
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
                    @foreach(['l1', 'l2', 'l3'] as $idx => $level)
                        @php $field = 'final_'.$level; @endphp
                        <div class="flex-1 space-y-1">
                            <span class="block text-[10px] font-bold text-gray-400/80 uppercase tracking-tighter text-center">L{{ $idx + 1 }}</span>
                            <input type="number" name="split_up[{{ $field }}]" value="{{ old('split_up.'.$field, $split ? $split->$field : 0) }}" min="0"
                                class="h-10 w-full rounded-xl border border-gray-200 bg-gray-50/50 text-center text-lg font-bold text-gray-800 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/5 dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-all shadow-sm" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
