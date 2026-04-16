<?php

namespace App\Livewire\SuperAdmin\CourseQuestion;

use App\Models\QuestionSplitUp as SplitUpModel;
use App\Models\StateCouncil;
use Livewire\Component;

class QuestionSplitUp extends Component
{
    public ?StateCouncil $stateCouncil = null;

    // Mock Test Split Up
    public $mock_l1 = 0, $mock_l2 = 0, $mock_l3 = 0;

    // Pre Test Split Up
    public $pre_l1 = 0, $pre_l2 = 0, $pre_l3 = 0;

    // Final Test Split Up
    public $final_l1 = 0, $final_l2 = 0, $final_l3 = 0;

    protected $rules = [
        'mock_l1' => 'required|integer|min:0',
        'mock_l2' => 'required|integer|min:0',
        'mock_l3' => 'required|integer|min:0',
        'pre_l1' => 'required|integer|min:0',
        'pre_l2' => 'required|integer|min:0',
        'pre_l3' => 'required|integer|min:0',
        'final_l1' => 'required|integer|min:0',
        'final_l2' => 'required|integer|min:0',
        'final_l3' => 'required|integer|min:0',
    ];

    public function mount(?StateCouncil $stateCouncil = null)
    {
        $this->stateCouncil = $stateCouncil;
        
        if ($this->stateCouncil && $this->stateCouncil->exists) {
            $settings = SplitUpModel::where('state_council_id', $this->stateCouncil->id)->first();
            if ($settings) {
                $this->mock_l1 = $settings->mock_l1; $this->mock_l2 = $settings->mock_l2; $this->mock_l3 = $settings->mock_l3;
                $this->pre_l1 = $settings->pre_l1; $this->pre_l2 = $settings->pre_l2; $this->pre_l3 = $settings->pre_l3;
                $this->final_l1 = $settings->final_l1; $this->final_l2 = $settings->final_l2; $this->final_l3 = $settings->final_l3;
            }
        } else {
            // Load global defaults if needed, or leave as 0
            $settings = SplitUpModel::whereNull('state_council_id')->first();
            if ($settings) {
                $this->mock_l1 = $settings->mock_l1; $this->mock_l2 = $settings->mock_l2; $this->mock_l3 = $settings->mock_l3;
                $this->pre_l1 = $settings->pre_l1; $this->pre_l2 = $settings->pre_l2; $this->pre_l3 = $settings->pre_l3;
                $this->final_l1 = $settings->final_l1; $this->final_l2 = $settings->final_l2; $this->final_l3 = $settings->final_l3;
            }
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'mock_l1' => $this->mock_l1,
            'mock_l2' => $this->mock_l2,
            'mock_l3' => $this->mock_l3,
            'pre_l1' => $this->pre_l1,
            'pre_l2' => $this->pre_l2,
            'pre_l3' => $this->pre_l3,
            'final_l1' => $this->final_l1,
            'final_l2' => $this->final_l2,
            'final_l3' => $this->final_l3,
        ];

        if ($this->stateCouncil && $this->stateCouncil->exists) {
            SplitUpModel::updateOrCreate(['state_council_id' => $this->stateCouncil->id], $data);
        } else {
            // This case handles global settings or create view where ID isn't known yet
            // If it's the Create view, we might need a different handling or just save globally
            // But the instructions say "with state_id", so we'll assume it's for specific councils.
            SplitUpModel::updateOrCreate(['state_council_id' => null], $data);
        }

        $this->dispatch('notify', 
            message: "Difficulty distribution updated successfully!",
            title: 'Success!',
            variant: 'success'
        );
    }

    public function render()
    {
        return view('livewire.super-admin.course-question.question-split-up');
    }
}
