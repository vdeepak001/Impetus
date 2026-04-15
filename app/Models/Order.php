<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_detail_id',
        'state_council_id',
        'payment_mode',
        'start_date',
        'end_date',
        'remarks',
        'payment_status',
        'recorded_by_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'payment_status' => PaymentStatus::class,
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

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by_id');
    }

    /**
     * Course IDs the learner may access as purchased (completed payment within validity dates).
     *
     * @return Collection<int, int>
     */
    public static function purchasedCourseDetailIdsFor(User $user): Collection
    {
        return static::query()
            ->where('user_id', $user->id)
            ->where('payment_status', PaymentStatus::Completed)
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->pluck('course_detail_id')
            ->unique()
            ->values();
    }

    public static function userHasActivePurchaseForCourse(User $user, CourseDetail $course): bool
    {
        return static::query()
            ->where('user_id', $user->id)
            ->where('course_detail_id', $course->id)
            ->where('payment_status', PaymentStatus::Completed)
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->exists();
    }
}
