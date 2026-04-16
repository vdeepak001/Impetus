<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\LevelScore;
use Illuminate\Http\Request;

class LevelScoreController extends Controller
{
    public function index()
    {
        $levelScore = LevelScore::query()->latest()->first();

        return view('super-admin.level-scores.index', [
            'title' => 'Level Scores',
            'levelScore' => $levelScore,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level_1' => ['required', 'integer', 'min:0'],
            'level_2' => ['required', 'integer', 'min:0'],
            'level_3' => ['required', 'integer', 'min:0'],
        ]);

        $levelScore = LevelScore::query()->latest()->first();

        if ($levelScore) {
            $levelScore->update($validated);
        } else {
            LevelScore::create($validated);
        }

        return redirect()
            ->route(MenuHelper::getCurrentPrefix().'.level-scores.index')
            ->with('success', 'Level score saved successfully.');
    }
}
