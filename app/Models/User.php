<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'google_id',
        'password',
        'role_type',
        'active_status',
        'password_raw',
        'phone',
        'designation',
        'bio',
        'profile_image',
        'address',
        'city',
        'state',
        'date_of_birth',
        'gender',
        'zip_code',
        'country',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'tax_id',
        'pan_number',
        'aadhar_number',
        'district',
        'address_line_1',
        'address_line_2',
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'name' => 'encrypted',
            'first_name' => 'encrypted',
            'last_name' => 'encrypted',
            'email' => 'encrypted',
            'active_status' => 'boolean',
            'password_raw' => 'encrypted',
            'phone' => 'encrypted',
            'address' => 'encrypted',
            'city' => 'encrypted',
            'state' => 'encrypted',
            'date_of_birth' => 'date',
            'gender' => 'encrypted',
            'zip_code' => 'encrypted',
            'country' => 'encrypted',
            'tax_id' => 'encrypted',
            'pan_number' => 'encrypted',
            'aadhar_number' => 'encrypted',
            'district' => 'encrypted',
            'address_line_1' => 'encrypted',
            'address_line_2' => 'encrypted',
            'rn_number' => 'encrypted',
            'rm_number' => 'encrypted',
            'qualification' => 'encrypted',
            'academic_state' => 'encrypted',
            'institution_name' => 'encrypted',
            'completed_year' => 'encrypted',
            'total_years_experience' => 'encrypted',
            'organization_name' => 'encrypted',
            'organization_type' => 'encrypted',
            'department_name' => 'encrypted',
            'professional_address_line_1' => 'encrypted',
            'professional_address_line_2' => 'encrypted',
            'professional_city' => 'encrypted',
            'professional_district' => 'encrypted',
            'professional_state' => 'encrypted',
        ];
    }
}
