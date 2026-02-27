<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'superadmins' => User::where('role_type', 'superadmin')->count(),
            'admins' => User::where('role_type', 'admin')->count(),
            'smes' => User::where('role_type', 'sme')->count(),
            'support' => User::where('role_type', 'support')->count(),
            'active_users' => User::where('active_status', 1)->count(),
            'inactive_users' => User::where('active_status', 0)->count(),
        ];

        return view('pages.dashboard.ecommerce', [
            'title' => 'Impetus Dashboard',
            'stats' => $stats
        ]);
    }
}
