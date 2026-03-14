<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function index(): View
    {
        return view('super-admin.reports.index', [
            'title' => 'Reports',
        ]);
    }
}
