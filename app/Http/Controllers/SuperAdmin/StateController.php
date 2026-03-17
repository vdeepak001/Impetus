<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StateController extends Controller
{
    public function index(): View
    {
        return view('super-admin.states.index', ['title' => 'States']);
    }

    public function create(): View
    {
        return view('super-admin.states.create', ['title' => 'Create State']);
    }

    public function store(StoreStateRequest $request): RedirectResponse
    {
        State::create($request->validated());

        return redirect()->route(MenuHelper::getCurrentPrefix().'.states.index')
            ->with('success', 'State created successfully.');
    }

    public function edit(State $state): View
    {
        return view('super-admin.states.edit', [
            'state' => $state,
            'title' => 'Edit State',
        ]);
    }

    public function update(UpdateStateRequest $request, State $state): RedirectResponse
    {
        $state->update($request->validated());

        return redirect()->route(MenuHelper::getCurrentPrefix().'.states.index')
            ->with('success', 'State updated successfully.');
    }

    public function destroy(State $state): RedirectResponse
    {
        $state->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.states.index')
            ->with('success', 'State deleted successfully.');
    }
}
