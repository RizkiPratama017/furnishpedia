<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
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

        'order_id' => Order::inRandomOrder()->first()->id,
        'product_id' => Product::inRandomOrder()->first()->id,
        'quantity' => $this->faker->numberBetween(1, 100),
        'price' => $this->faker->randomFloat(2, 1, 1000),
        'subtotal' => function (array $attributes) {
            return $attributes['quantity'] * $attributes['price'];
        },
        ];
    }
}
