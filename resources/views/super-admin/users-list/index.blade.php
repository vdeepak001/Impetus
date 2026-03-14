@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
            {{ $title }}
        </h2>
    </div>

    <div class="bg-white shadow-md rounded-lg p-12 text-center dark:bg-gray-800">
        <p class="text-2xl font-semibold text-gray-600 dark:text-gray-300">
            Coming Soon
        </p>
        <p class="mt-2 text-gray-500 dark:text-gray-400">
            Users list will be available here.
        </p>
    </div>
@endsection
