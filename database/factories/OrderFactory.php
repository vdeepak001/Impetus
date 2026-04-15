<?php

namespace Database\Factories;

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'course_detail_id' => 1,
            'state_council_id' => null,
            'payment_mode' => PaymentMode::InternetBanking->value,
            'start_date' => now()->subDay(),
            'end_date' => now()->addYear(),
            'remarks' => null,
            'payment_status' => PaymentStatus::Completed->value,
            'recorded_by_id' => null,
        ];
    }
}
