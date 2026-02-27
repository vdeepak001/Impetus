<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_type',
        'active_status',
    ];

    protected $casts = [
        'first_name' => 'encrypted',
        'last_name' => 'encrypted',
        'email' => 'encrypted',
        'password' => 'hashed',
        'active_status' => 'boolean',
    ];
}
