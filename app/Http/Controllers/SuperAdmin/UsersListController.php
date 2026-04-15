<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UsersListController extends Controller
{
    /**
     * Column keys shown in the detail popup (read-only for staff).
     *
     * @var list<string>
     */
    private const USER_PROFILE_KEYS = [
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

    public function index(): View
    {
        $users = User::query()
            ->where('role_type', 'user')
            ->orderBy('id')
            ->paginate(15);

        $staffUrlPrefix = MenuHelper::getCurrentPrefix() ?? 'super-admin';

        return view('super-admin.users-list.index', [
            'title' => 'Users List',
            'users' => $users,
            'userProfileKeys' => self::USER_PROFILE_KEYS,
            'profileLabels' => self::PROFILE_LABELS,
            'usersListBaseUrl' => url($staffUrlPrefix.'/users-list'),
        ]);
    }
}
