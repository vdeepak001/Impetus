<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\StateCouncil;
use App\Models\User;

class CourseStateCouncilResolver
{
    public function resolveForUserCourse(User $user, CourseDetail $course): ?StateCouncil
    {
        $order = Order::query()
            ->where('user_id', $user->id)
            ->where('course_detail_id', $course->id)
            ->where('payment_status', PaymentStatus::Completed)
            ->whereNotNull('state_council_id')
            ->latest('id')
            ->first();

        if ($order?->state_council_id) {
            return StateCouncil::query()->find($order->state_council_id);
        }

        if (! filled($user->state)) {
            return null;
        }

        $stateName = trim((string) $user->state);
        $normalized = mb_strtolower($stateName);

        return $course->stateCouncils()
            ->where('active_status', true)
            ->whereHas('state', function ($q) use ($stateName, $normalized) {
                $q->where('status', 'active')
                    ->where(function ($sq) use ($stateName, $normalized) {
                        $sq->where('name', $stateName)
                            ->orWhereRaw('LOWER(TRIM(name)) = ?', [$normalized]);
                    });
            })
            ->first();
    }
}
