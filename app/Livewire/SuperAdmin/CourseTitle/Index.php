<?php

namespace App\Livewire\SuperAdmin\CourseTitle;

use App\Models\CourseTitle;
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

    #[Url(except: 'id')]
    public $sortField = 'id';

    #[Url(except: 'desc')]
    public $sortDirection = 'desc';

    public $perPage = 10;

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleStatus($titleId)
    {
        $title = CourseTitle::findOrFail($titleId);
        $title->active_status = ! $title->active_status;
        $title->save();

        $status = $title->active_status ? 'activated' : 'deactivated';

        $this->dispatch('notify',
            message: "Title {$status} successfully!",
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
        $query = CourseTitle::with(['course', 'user']);

        // Apply Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title_name', 'like', '%'.$this->search.'%')
                    ->orWhere('title_description', 'like', '%'.$this->search.'%')
                    ->orWhereHas('course', function ($cq) {
                        $cq->where('couse_name', 'like', '%'.$this->search.'%');
                    });
            });
        }

        // Apply Status Filter
        if ($this->filter === 'active') {
            $query->where('active_status', true);
        } elseif ($this->filter === 'inactive') {
            $query->where('active_status', false);
        }

        // Apply Sorting
        $titles = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.super-admin.course-title.index', [
            'titles' => $titles,
            'totalCount' => CourseTitle::count(),
            'activeCount' => CourseTitle::where('active_status', true)->count(),
            'inactiveCount' => CourseTitle::where('active_status', false)->count(),
        ]);
    }
}
