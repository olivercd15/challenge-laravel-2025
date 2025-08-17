<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(3),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}
