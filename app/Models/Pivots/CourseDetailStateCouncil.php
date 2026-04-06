<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseDetailStateCouncil extends Pivot
{
    protected $casts = [
        'pass_percentage' => 'array',
        'mrp' => 'array',
        'offer_price' => 'array',
        'points' => 'array',
        'valid_days' => 'array',
    ];
}
