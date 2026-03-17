<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateCouncilRequest;
use App\Http\Requests\UpdateStateCouncilRequest;
use App\Models\CourseDetail;
use App\Models\State;
use App\Models\StateCouncil;
use Illuminate\Http\RedirectResponse;
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

    public function create(): View
    {
        $states = State::orderBy('name')->get();
        $courses = CourseDetail::orderBy('couse_name')->get();

        return view('super-admin.state-councils.create', [
            'title' => 'Create State Council',
            'states' => $states,
            'courses' => $courses,
        ]);
    }

    public function store(StoreStateCouncilRequest $request): RedirectResponse
    {
        $data = collect($request->validated())->except('course_detail_ids')->all();
        $stateCouncil = StateCouncil::create($data);
        $stateCouncil->courseDetails()->sync($request->validated('course_detail_ids', []));

        return redirect()->route(MenuHelper::getCurrentPrefix().'.state-councils.state-wise-modules')
            ->with('success', 'State council created successfully.');
    }

    public function edit(StateCouncil $state_council): View
    {
        $states = State::orderBy('name')->get();
        $courses = CourseDetail::orderBy('couse_name')->get();

        return view('super-admin.state-councils.edit', [
            'stateCouncil' => $state_council,
            'title' => 'Edit State Council',
            'states' => $states,
            'courses' => $courses,
        ]);
    }

    public function update(UpdateStateCouncilRequest $request, StateCouncil $state_council): RedirectResponse
    {
        $data = collect($request->validated())->except('course_detail_ids')->all();
        $state_council->update($data);
        $state_council->courseDetails()->sync($request->validated('course_detail_ids', []));

        return redirect()->route(MenuHelper::getCurrentPrefix().'.state-councils.state-wise-modules')
            ->with('success', 'State council updated successfully.');
    }

    public function destroy(StateCouncil $state_council): RedirectResponse
    {
        $state_council->delete();

        return redirect()->route(MenuHelper::getCurrentPrefix().'.state-councils.state-wise-modules')
            ->with('success', 'State council deleted successfully.');
    }
}
