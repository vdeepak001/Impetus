<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UsersListController extends Controller
{
    public function index(): View
    {
        return view('super-admin.users-list.index', [
            'title' => 'Users List',
        ]);
    }
}
