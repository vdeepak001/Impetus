@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div class="w-full">
        <livewire:super-admin.state-council.index view-type="modules" />
    </div>
@endsection
