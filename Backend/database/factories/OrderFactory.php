<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    public function definition()
    {
        return [
            'client_name' => $this->faker->name,
            'total' => $this->faker->randomFloat(2, 20, 500),
            'status' => $this->faker->randomElement(['initiated', 'sent', 'delivered']),
        ];
    }
}
