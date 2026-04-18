<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseTestAnswer extends Model
{
    protected $fillable = [
        'course_test_attempt_id',
        'course_question_id',
        'display_index',
        'selected_choice',
        'is_correct',
    ];

    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
        ];
    }

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(CourseTestAttempt::class, 'course_test_attempt_id');
    }

    public function courseQuestion(): BelongsTo
    {
        return $this->belongsTo(CourseQuestion::class, 'course_question_id');
    }
}
