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
            'order_id' => Order::inRandomOrder()->first()->id,  // Ambil ID pesanan secara acak
            'product_id' => $product->id,  // Ambil ID produk yang dipilih
            'quantity' => $this->faker->numberBetween(1, 10),  // Ambil jumlah produk secara acak
            'price' => $product->price,  // Ambil harga produk
            'subtotal' => function (array $attributes) {
                return $attributes['quantity'] * $attributes['price'];  // Hitung subtotal berdasarkan quantity dan harga
            },
            'seller_id' => $product->user->id,  // Dapatkan ID seller berdasarkan produk
            'seller_address' => $product->user->address,  // Dapatkan alamat seller dari produk
        ];
    }
}
