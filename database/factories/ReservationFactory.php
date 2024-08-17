<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'customer_id' => Customer::inRandomOrder()->first(),
            'from_time' => $this->faker->dateTimeBetween('now', '+1 hours'),
            'to_time' => $this->faker->dateTimeBetween('+2 hours', '+4 hours'),
        ];
    }
}
