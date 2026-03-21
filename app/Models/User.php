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
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

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
        'zip_code',
        'country',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'tax_id',
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
            'zip_code' => 'encrypted',
            'country' => 'encrypted',
            'tax_id' => 'encrypted',
        ];
    }
}
