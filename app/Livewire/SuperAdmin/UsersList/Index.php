<?php

namespace App\Livewire\SuperAdmin\UsersList;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search = '';

    public $perPage = 20;

    /**
     * Column keys shown in the detail popup (read-only for staff).
     *
     * @var list<string>
     */
    private const USER_PROFILE_KEYS = [
        'id',
        'name',
        'date_of_birth',
        'rn_number',
        'email',
        'phone',
        'qualification',
        'designation',
        'state',
    ];

    /**
     * Human-readable labels for profile popup fields (same order as keys).
     *
     * @var array<string, string>
     */
    private const PROFILE_LABELS = [
        'name' => 'Full Name',
        'date_of_birth' => 'Date of Birth',
        'rn_number' => 'RN',
        'email' => 'Email ID',
        'phone' => 'Mobile number',
        'qualification' => 'Qualification',
        'designation' => 'Designation',
        'state' => 'State',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Fetch all learners and filter in memory due to encryption
        $allUsers = User::query()
            ->where('role_type', 'user')
            ->orderByDesc('id')
            ->get();

        $filteredUsers = $allUsers->when($this->search !== '', function ($collection) {
            $searchTerm = mb_strtolower($this->search);
            return $collection->filter(function ($user) use ($searchTerm) {
                return str_contains(mb_strtolower($user->unique_sequence_number ?? ''), $searchTerm)
                    || str_contains(mb_strtolower($user->name ?? ''), $searchTerm)
                    || str_contains(mb_strtolower($user->first_name ?? ''), $searchTerm)
                    || str_contains(mb_strtolower($user->last_name ?? ''), $searchTerm)
                    || str_contains(mb_strtolower($user->email ?? ''), $searchTerm)
                    || str_contains(mb_strtolower($user->phone ?? ''), $searchTerm);
            });
        });

        // Paginate the collection manually
        $page = $this->getPage();
        $items = $filteredUsers->forPage($page, $this->perPage);
        
        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $filteredUsers->count(),
            $this->perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('livewire.super-admin.users-list.index', [
            'users' => $users,
            'userProfileKeys' => self::USER_PROFILE_KEYS,
            'profileLabels' => self::PROFILE_LABELS,
        ]);
    }
}
