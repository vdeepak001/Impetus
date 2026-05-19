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
        $activeOrder = Order::activeOrderFor($user, $course);
        abort_unless($activeOrder !== null, 403);

        if ($type === CourseTestType::Pre) {
            abort_unless(session()->has('pretest_otp_verified_' . $course->id), 403);
        }

        if ($type === CourseTestType::Mock) {
            abort_unless(session()->has('mocktest_otp_verified_' . $course->id), 403);
        }

        if ($type === CourseTestType::Final) {
            abort_unless(session()->has('finaltest_otp_verified_' . $course->id), 403);
        }

        if ($type === CourseTestType::Practice) {
            abort_unless(filled($course->practice_content), 404);
            $preDone = CourseTestAttempt::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $course->id)
                ->where('test_type', CourseTestType::Pre->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->where('started_at', '>=', $activeOrder->created_at)
                ->exists();
            abort_unless($preDone, 403);

            return;
        }

        $needs = $type->prerequisite();
        if ($needs !== null) {
            $ok = CourseTestAttempt::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $course->id)
                ->where('test_type', $needs->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->where('started_at', '>=', $activeOrder->created_at)
                ->exists();
            abort_unless($ok, 403);
        }
    }
}
