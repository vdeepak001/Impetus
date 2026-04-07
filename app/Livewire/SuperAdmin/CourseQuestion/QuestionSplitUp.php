<?php

namespace App\Livewire\SuperAdmin\CourseQuestion;

use App\Models\QuestionSplitUp as SplitUpModel;
use Livewire\Component;

class QuestionSplitUp extends Component
{
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

    public function mount()
    {
        $settings = SplitUpModel::first();
        if ($settings) {
            $this->mock_l1 = $settings->mock_l1; $this->mock_l2 = $settings->mock_l2; $this->mock_l3 = $settings->mock_l3;
            $this->pre_l1 = $settings->pre_l1; $this->pre_l2 = $settings->pre_l2; $this->pre_l3 = $settings->pre_l3;
            $this->final_l1 = $settings->final_l1; $this->final_l2 = $settings->final_l2; $this->final_l3 = $settings->final_l3;
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

        SplitUpModel::updateOrCreate(['id' => 1], $data);

        $this->dispatch('notify', 
            message: "Global settings updated successfully!",
            title: 'Success!',
            variant: 'success'
        );
    }

    public function render()
    {
        return view('livewire.super-admin.course-question.question-split-up')
            ->extends('layouts.app')
            ->section('content');
    }
}
