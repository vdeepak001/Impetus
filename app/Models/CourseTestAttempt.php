<?php

namespace App\Models;

use App\Enums\CourseTestType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseTestAttempt extends Model
{
    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'course_detail_id',
        'state_council_id',
        'test_type',
        'status',
        'question_ids',
        'score_percent',
        'correct_count',
        'total_questions',
        'passed',
        'pass_threshold_percent',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'test_type' => CourseTestType::class,
            'question_ids' => 'array',
            'score_percent' => 'decimal:2',
            'passed' => 'boolean',
            'pass_threshold_percent' => 'decimal:2',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

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

    public function answers(): HasMany
    {
        return $this->hasMany(CourseTestAnswer::class);
    }

    public static function isTypeCompleted(int $userId, int $courseId, CourseTestType $type): bool
    {
        return static::query()
            ->where('user_id', $userId)
            ->where('course_detail_id', $courseId)
            ->where('test_type', $type->value)
            ->where('status', self::STATUS_COMPLETED)
            ->exists();
    }
}
