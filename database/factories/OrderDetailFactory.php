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
        // Ambil produk secara acak, pastikan produk ini berasal dari seller yang sesuai
        $product = Product::inRandomOrder()->first();

        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $product->price, // Ambil harga dari produk untuk sinkronisasi
            'subtotal' => function (array $attributes) {
                return $attributes['quantity'] * $attributes['price'];
            },
        ];
    }
}
