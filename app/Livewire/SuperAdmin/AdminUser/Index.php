<?php

namespace App\Livewire\SuperAdmin\AdminUser;

use App\Models\User;
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

    #[Url(except: 'created_at')]
    public $sortField = 'created_at';

    #[Url(except: 'desc')]
    public $sortDirection = 'desc';

    public $perPage = 10;

    public function mount()
    {
        // No manual initialization needed with #[Url]
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->active_status = !$user->active_status;
        $user->save();

        $status = $user->active_status ? 'activated' : 'deactivated';
        
        $this->dispatch('notify', 
            message: "User {$status} successfully!",
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
        // Get all users and filter in memory due to encryption
        $allUsers = User::all();

        $filteredUsers = $allUsers->filter(function ($user) {
            // Apply Status Filter
            if ($this->filter === 'active' && !$user->active_status) return false;
            if ($this->filter === 'inactive' && $user->active_status) return false;

            // Apply Search
            if ($this->search) {
                $searchTerm = mb_strtolower($this->search);
                $firstName = mb_strtolower($user->first_name ?? '');
                $lastName = mb_strtolower($user->last_name ?? '');
                $email = mb_strtolower($user->email ?? '');
                $name = mb_strtolower($user->name ?? '');

                return str_contains($firstName, $searchTerm) || 
                       str_contains($lastName, $searchTerm) || 
                       str_contains($email, $searchTerm) ||
                       str_contains($name, $searchTerm);
            }

            return true;
        });

        // Apply Sorting
        $sortedUsers = $this->sortDirection === 'asc' 
            ? $filteredUsers->sortBy($this->sortField) 
            : $filteredUsers->sortByDesc($this->sortField);

        // Paginate the collection
        $page = method_exists($this, 'getPage') ? $this->getPage() : 1;
        $items = $sortedUsers->forPage($page, $this->perPage);
        
        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $sortedUsers->count(),
            $this->perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('livewire.super-admin.admin-user.index', [
            'users' => $users,
            'totalCount' => $allUsers->count(),
            'activeCount' => $allUsers->where('active_status', true)->count(),
            'inactiveCount' => $allUsers->where('active_status', false)->count(),
        ]);
    }
}
