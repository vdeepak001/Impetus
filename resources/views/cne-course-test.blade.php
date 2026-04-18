@extends('layouts.frontend.app')

@section('title', $title)

@section('content')
    <livewire:frontend.course-test-taking :course-id="$course->id" :test-type="$testType->value" :key="'test-'.$course->id.'-'.$testType->value" />
@endsection
