<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderStatusLogFactory extends Factory
{
    protected $model = OrderItem::class;
    public function definition()
    {
        $statuses = ['initiated', 'sent', 'delivered'];

        $previous = $this->faker->randomElement($statuses);
        $new = $this->faker->randomElement(array_diff($statuses, [$previous]));

        return [
            'order_id' => \App\Models\Order::factory(),
            'previous_status' => $previous,
            'new_status' => $new,
            'changed_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
