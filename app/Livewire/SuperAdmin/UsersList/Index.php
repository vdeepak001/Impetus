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
        'unique_sequence_number',
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'designation',
        'bio',
        'city',
        'state',
        'district',
        'country',
        'zip_code',
        'address_line_1',
        'address_line_2',
        'date_of_birth',
        'gender',
        'rn_number',
        'rm_number',
        'qualification',
        'academic_state',
        'institution_name',
        'completed_year',
        'total_years_experience',
        'organization_name',
        'organization_type',
        'department_name',
        'professional_address_line_1',
        'professional_address_line_2',
        'professional_city',
        'professional_district',
        'professional_state',
        'active_status',
        'email_verified_at',
    ];

    /**
     * Human-readable labels for profile popup fields (same order as keys).
     *
     * @var array<string, string>
     */
    private const PROFILE_LABELS = [
        'unique_sequence_number' => 'Unique ID',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'name' => 'Full name',
        'email' => 'Email',
        'phone' => 'Phone',
        'designation' => 'Designation',
        'bio' => 'Bio',
        'city' => 'City',
        'state' => 'State',
        'district' => 'District',
        'country' => 'Country',
        'zip_code' => 'ZIP code',
        'address_line_1' => 'Address line 1',
        'address_line_2' => 'Address line 2',
        'date_of_birth' => 'Date of birth',
        'gender' => 'Gender',
        'rn_number' => 'RN number',
        'rm_number' => 'RM number',
        'qualification' => 'Qualification',
        'academic_state' => 'Academic state',
        'institution_name' => 'Institution',
        'completed_year' => 'Completed year',
        'total_years_experience' => 'Years of experience',
        'organization_name' => 'Organization',
        'organization_type' => 'Organization type',
        'department_name' => 'Department',
        'professional_address_line_1' => 'Professional address line 1',
        'professional_address_line_2' => 'Professional address line 2',
        'professional_city' => 'Professional city',
        'professional_district' => 'Professional district',
        'professional_state' => 'Professional state',
        'active_status' => 'Account status',
        'email_verified_at' => 'Email verified at',
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
