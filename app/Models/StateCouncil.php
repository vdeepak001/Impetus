<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pivots\CourseDetailStateCouncil;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StateCouncil extends Model
{
    protected $fillable = [
        'state_id',
        'council_name',
        'pass_percentage',
        'mrp',
        'price',
        'points',
        'valid_days',
        'active_status',
    ];

    protected function casts(): array
    {
        return [
            'pass_percentage' => 'array',
            'mrp' => 'array',
            'price' => 'array',
            'points' => 'array',
            'valid_days' => 'array',
            'active_status' => 'boolean',
        ];
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function courseDetails(): BelongsToMany
    {
        return $this->belongsToMany(CourseDetail::class, 'course_detail_state_council')
            ->using(CourseDetailStateCouncil::class)
            ->withPivot(['pass_percentage', 'mrp', 'offer_price', 'points', 'valid_days', 'pre_test_questions', 'mock_test_questions', 'final_test_questions'])
            ->withTimestamps();
    }
}
