<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StateCouncilController extends Controller
{
    public function stateWiseModules(): View
    {
        return view('super-admin.state-councils.state-wise-modules', [
            'title' => 'State-wise Modules',
        ]);
    }

    public function stateWisePassPercentage(): View
    {
        return view('super-admin.state-councils.state-wise-pass-percentage', [
            'title' => 'State-wise Pass Percentage',
        ]);
    }
}
