<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CourseDetail;
use App\Models\CourseTitle;
use App\Models\CourseMaterial;
use App\Models\CourseQuestion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // User Stats
            'total_users' => User::where('role_type', 'user')->count(),
            'active_users' => User::where('role_type', 'user')->where('active_status', 1)->count(),
            
            // Course Stats
            'total_courses' => CourseDetail::count(),
            'total_titles' => CourseTitle::count(),
            'total_materials' => CourseMaterial::count(),
            'total_questions' => CourseQuestion::count(),
        ];

        return view('pages.dashboard.ecommerce', [
            'title' => 'Dashboard Overview',
            'stats' => $stats
        ]);
    }
}
