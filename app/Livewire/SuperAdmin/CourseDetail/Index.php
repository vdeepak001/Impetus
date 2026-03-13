<?php

namespace App\Livewire\SuperAdmin\CourseDetail;

use App\Models\CourseDetail;
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

    public function toggleStatus($courseId)
    {
        $course = CourseDetail::findOrFail($courseId);
        $course->active_status = $course->active_status == 1 ? 0 : 1;
        $course->save();

        $status = $course->active_status == 1 ? 'activated' : 'deactivated';
        
        $this->dispatch('notify', 
            message: "Course {$status} successfully!",
            title: 'Status Updated',
            variant: 'success'
        );
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilter() { $this->resetPage(); }

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
        $query = CourseDetail::with('user');

        // Apply Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('couse_name', 'like', '%' . $this->search . '%')
                  ->orWhere('course_code', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply Status Filter
        if ($this->filter === 'active') {
            $query->where('active_status', 1);
        } elseif ($this->filter === 'inactive') {
            $query->where('active_status', 0);
        }

        // Apply Sorting
        $courses = $query->orderBy($this->sortField, $this->sortDirection)
                         ->paginate($this->perPage);

        return view('livewire.super-admin.course-detail.index', [
            'courses' => $courses,
            'totalCount' => CourseDetail::count(),
            'activeCount' => CourseDetail::where('active_status', 1)->count(),
            'inactiveCount' => CourseDetail::where('active_status', 0)->count(),
        ]);
    }
}
