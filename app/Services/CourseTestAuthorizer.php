<?php

namespace App\Services;

use App\Enums\CourseTestType;
use App\Models\CourseDetail;
use App\Models\CourseTestAttempt;
use App\Models\Order;
use App\Models\User;

class CourseTestAuthorizer
{
    public function ensureCanAccess(User $user, CourseDetail $course, CourseTestType $type): void
    {
        abort_unless($user->role_type === 'user', 403);
        abort_unless((int) $course->active_status === 1, 404);
        abort_unless(Order::userHasActivePurchaseForCourse($user, $course), 403);

        if ($type === CourseTestType::Practice) {
            abort_unless(filled($course->practice_content), 404);
            abort_unless(
                CourseTestAttempt::isTypeCompleted($user->id, $course->id, CourseTestType::Mock),
                403
            );

            return;
        }

        $needs = $type->prerequisite();
        if ($needs !== null) {
            $ok = CourseTestAttempt::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $course->id)
                ->where('test_type', $needs->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->exists();
            abort_unless($ok, 403);
        }
    }
}
