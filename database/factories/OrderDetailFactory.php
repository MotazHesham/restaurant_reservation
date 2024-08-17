<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first(),
            'meal_id' => Meal::inRandomOrder()->first(),
            'amount_to_pay' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
