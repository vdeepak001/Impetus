<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'ihsid',
        'query_for',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
