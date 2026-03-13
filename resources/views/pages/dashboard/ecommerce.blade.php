@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 md:gap-6">
        <!-- Total Courses -->
        <x-dashboard.metric-card 
            title="Total Courses" 
            value="{{ $stats['total_courses'] }}" 
            icon="book-open"
            color="brand"
        />

        <!-- Course Titles -->
        <x-dashboard.metric-card 
            title="Course Titles" 
            value="{{ $stats['total_titles'] }}" 
            icon="tag"
            color="indigo"
        />

        <!-- Title Materials -->
        <x-dashboard.metric-card 
            title="Course Materials" 
            value="{{ $stats['total_materials'] }}" 
            icon="document-duplicate"
            color="blue"
        />

        <!-- Course Questions -->
        <x-dashboard.metric-card 
            title="Total Questions" 
            value="{{ $stats['total_questions'] }}" 
            icon="question-mark-circle"
            color="orange"
        />

        <!-- Total Users -->
        <x-dashboard.metric-card 
            title="Total Users" 
            value="{{ $stats['total_users'] }}" 
            icon="users"
            color="purple"
        />

        <!-- Active Users -->
        <x-dashboard.metric-card 
            title="Active Users" 
            value="{{ $stats['active_users'] }}" 
            icon="check-circle"
            color="success"
        />
    </div>
@endsection
