<?php

namespace App\Livewire\SuperAdmin\CourseMaterial;

use App\Models\CourseMaterial;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search = '';

    #[Url(except: 'id')]
    public $sortField = 'id';

    #[Url(except: 'desc')]
    public $sortDirection = 'desc';

    public $perPage = 10;

    public function updatingSearch() { $this->resetPage(); }

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
        $query = CourseMaterial::with(['course', 'courseTitle']);

        // Apply Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('course', function($cq) {
                      $cq->where('couse_name', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('courseTitle', function($tq) {
                      $tq->where('title_name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply Sorting
        $materials = $query->orderBy($this->sortField, $this->sortDirection)
                          ->paginate($this->perPage);

        return view('livewire.super-admin.course-material.index', [
            'materials' => $materials,
            'totalCount' => CourseMaterial::count(),
        ]);
    }
}
