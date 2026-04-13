<?php

namespace App\Livewire\SuperAdmin\CourseQuestion;

use App\Models\CourseDetail;
use App\Models\CourseQuestion;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search = '';

    #[Url(except: 'all')]
    public $filter = 'all';

    #[Url(except: 'all')]
    public $courseId = 'all';

    #[Url(except: 'all')]
    public $level = 'all';

    #[Url(except: 'id')]
    public $sortField = 'id';

    #[Url(except: 'asc')]
    public $sortDirection = 'asc';

    public $perPage = 10;

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleStatus($questionId)
    {
        $question = CourseQuestion::findOrFail($questionId);
        $question->active_status = ! $question->active_status;
        $question->save();

        $status = $question->active_status ? 'activated' : 'deactivated';

        $this->dispatch('notify',
            message: "Question {$status} successfully!",
            title: 'Status Updated',
            variant: 'success'
        );
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function updatingCourseId(): void
    {
        $this->resetPage();
    }

    public function updatingLevel(): void
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render()
    {
        $query = CourseQuestion::with(['course', 'user']);

        // Apply Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('question', 'like', '%'.$this->search.'%')
                    ->orWhere('question_code', 'like', '%'.$this->search.'%')
                    ->orWhereHas('course', function ($cq) {
                        $cq->where('couse_name', 'like', '%'.$this->search.'%');
                    });
            });
        }

        // Apply Course Filter
        if ($this->courseId !== 'all' && $this->courseId !== '' && $this->courseId !== null) {
            $query->where('course_id', $this->courseId);
        }

        // Apply Level Filter
        if ($this->level !== 'all' && $this->level !== '' && $this->level !== null) {
            $query->where('question_level', $this->level);
        }

        $totalCount = (clone $query)->count();
        $activeCount = (clone $query)->where('active_status', true)->count();
        $inactiveCount = (clone $query)->where('active_status', false)->count();

        // Apply Status Filter
        if ($this->filter === 'active') {
            $query->where('active_status', true);
        } elseif ($this->filter === 'inactive') {
            $query->where('active_status', false);
        }

        // Apply Sorting
        $questions = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.super-admin.course-question.index', [
            'questions' => $questions,
            'courses' => CourseDetail::orderBy('couse_name')->get(['id', 'couse_name', 'course_code']),
            'levels' => ['Level 1', 'Level 2', 'Level 3'],
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
        ]);
    }
}
