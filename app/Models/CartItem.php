<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'course_detail_id',
        'state_council_id',
        'mrp',
        'offer_price',
        'points',
        'valid_days',
        'pass_percentage',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courseDetail(): BelongsTo
    {
        return $this->belongsTo(CourseDetail::class, 'course_detail_id');
    }

    public function stateCouncil(): BelongsTo
    {
        return $this->belongsTo(StateCouncil::class);
    }
}
