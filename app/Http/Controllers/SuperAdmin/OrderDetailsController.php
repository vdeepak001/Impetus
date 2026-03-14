<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderDetailsController extends Controller
{
    public function index(): View
    {
        return view('super-admin.order-details.index', [
            'title' => 'Order Details',
        ]);
    }
}
