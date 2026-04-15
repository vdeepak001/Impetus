<?php

namespace App\Http\Requests;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Models\CourseDetail;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreUserCourseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_detail_id' => ['required', 'integer', 'exists:course_details,id'],
            'payment_mode' => ['required', 'string', Rule::enum(PaymentMode::class)],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'remarks' => ['nullable', 'string', 'max:10000'],
            'payment_status' => ['sometimes', 'nullable', 'string', Rule::enum(PaymentStatus::class)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $userId = (int) $this->route('userId');
            $user = User::query()->find($userId);

            if (! $user || $user->role_type !== 'user') {
                $validator->errors()->add('user', 'Invalid learner account.');

                return;
            }

            $courseId = (int) $this->input('course_detail_id');
            if ($courseId === 0) {
                return;
            }

            $course = CourseDetail::query()->find($courseId);

            if (! $course) {
                return;
            }

            if ((int) $course->active_status !== 1) {
                $validator->errors()->add('course_detail_id', 'This module is not active.');
            }

            if (! filled($user->state)) {
                return;
            }

            $stateName = trim((string) $user->state);

            $stateCouncil = $course->stateCouncils()
                ->where('active_status', true)
                ->whereHas('state', function ($stateQuery) use ($stateName) {
                    $stateQuery->where('name', $stateName)->where('status', 'active');
                })
                ->first();

            if (! $stateCouncil) {
                $validator->errors()->add('course_detail_id', "This module is not available for this learner's state.");
            }
        });
    }
}
