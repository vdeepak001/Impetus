<?php

namespace App\Livewire\SuperAdmin\StateCouncil;

use App\Models\StateCouncil;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $viewType = 'modules';

    #[Url(except: '')]
    public $search = '';

    #[Url(except: 'id')]
    public $sortField = 'id';

    #[Url(except: 'desc')]
    public $sortDirection = 'desc';

    public $perPage = 10;

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

    public function toggleStatus(int $stateCouncilId): void
    {
        $stateCouncil = StateCouncil::findOrFail($stateCouncilId);
        $stateCouncil->active_status = ! $stateCouncil->active_status;
        $stateCouncil->save();

        $status = $stateCouncil->active_status ? 'activated' : 'deactivated';
        $this->dispatch('notify', message: "State council {$status} successfully.", title: 'Status Updated', variant: 'success');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = StateCouncil::with(['state', 'courseDetails']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('council_name', 'like', '%'.$this->search.'%')
                    ->orWhereHas('state', fn ($sq) => $sq->where('name', 'like', '%'.$this->search.'%'))
                    ->orWhereHas('courseDetails', fn ($sq) => $sq->where('couse_name', 'like', '%'.$this->search.'%'));
            });
        }

        $stateCouncils = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.super-admin.state-council.index', [
            'stateCouncils' => $stateCouncils,
        ]);
    }
}
