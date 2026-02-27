@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 md:gap-6">
        <!-- Total Users -->
        <x-dashboard.metric-card 
            title="Total Users" 
            value="{{ $stats['total_users'] }}" 
            icon="users"
            color="brand"
        />

        <!-- Active Users -->
        <x-dashboard.metric-card 
            title="Active Users" 
            value="{{ $stats['active_users'] }}" 
            icon="check-circle"
            color="success"
        />

        <!-- Super Admins -->
        <x-dashboard.metric-card 
            title="Super Admins" 
            value="{{ $stats['superadmins'] }}" 
            icon="shield-check"
            color="indigo"
        />

        <!-- Admins -->
        <x-dashboard.metric-card 
            title="Admins" 
            value="{{ $stats['admins'] }}" 
            icon="user-group"
            color="blue"
        />
        
        <!-- SME -->
        <x-dashboard.metric-card 
            title="SME" 
            value="{{ $stats['smes'] }}" 
            icon="academic-cap"
            color="orange"
        />

        <!-- Support -->
        <x-dashboard.metric-card 
            title="Support" 
            value="{{ $stats['support'] }}" 
            icon="headset"
            color="purple"
        />

        <!-- Inactive -->
        <x-dashboard.metric-card 
            title="Inactive Users" 
            value="{{ $stats['inactive_users'] }}" 
            icon="x-circle"
            color="error"
        />
    </div>
@endsection
