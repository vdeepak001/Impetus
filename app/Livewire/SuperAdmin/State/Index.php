<?php

namespace App\Livewire\SuperAdmin\State;

use App\Models\State;
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

    #[Url(except: 'name')]
    public $sortField = 'name';

    #[Url(except: 'asc')]
    public $sortDirection = 'asc';

    public $perPage = 40;

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleStatus(int $stateId): void
    {
        $state = State::findOrFail($stateId);
        $state->status = $state->status === 'active' ? 'inactive' : 'active';
        $state->save();

        $status = $state->status === 'active' ? 'activated' : 'deactivated';
        $this->dispatch('notify', message: "State {$status} successfully.", title: 'Status Updated', variant: 'success');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
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
        $query = State::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('status', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->filter === 'active') {
            $query->where('status', 'active');
        } elseif ($this->filter === 'inactive') {
            $query->where('status', 'inactive');
        }

        $states = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.super-admin.state.index', [
            'states' => $states,
            'totalCount' => State::count(),
            'activeCount' => State::where('status', 'active')->count(),
            'inactiveCount' => State::where('status', 'inactive')->count(),
        ]);
    }
}
