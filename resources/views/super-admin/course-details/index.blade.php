@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            Course Details
        </h2>
    </div>

    <div>
        <div class="w-full">
            <livewire:super-admin.course-detail.index />
        </div>
    </div>
@endsection
