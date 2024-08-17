<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => Table::inRandomOrder()->first(),
            'reservation_id' => Reservation::inRandomOrder()->first(),
            'customer_id' => Customer::inRandomOrder()->first(),
            'user_id' => 1,
            'total' => $this->faker->randomFloat(2, 20, 200),
            'paid' => $this->faker->boolean(),
            'date' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
