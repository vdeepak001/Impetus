@extends('layouts.frontend.app')

@section('title', $title)

@section('content')
    {{-- Fixed header is top-4 + ~5.5rem bar; pt clears it with a little gap below the shadow --}}
    <div class="pt-28 sm:pt-32">
        <livewire:frontend.course-test-taking :course-id="$course->id" :test-type="$testType->value" :key="'test-'.$course->id.'-'.$testType->value" />
    </div>
@endsection
