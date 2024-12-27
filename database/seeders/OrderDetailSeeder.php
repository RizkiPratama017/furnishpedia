<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan terdapat data Order dan Product sebelum membuat OrderDetail
        if (Order::count() === 0 || Product::count() === 0) {
            $this->command->error("Seeding gagal: Pastikan data Order dan Product sudah ada.");
            return;
        }

        // Ambil order secara acak dan buat detail pesanan untuk setiap order
        Order::all()->each(function ($order) {
            // Buat 1-5 detail pesanan untuk setiap order
            $orderDetailsCount = rand(1, 5);

            for ($i = 0; $i < $orderDetailsCount; $i++) {
                // Ambil produk secara acak yang sesuai dengan seller
                $product = Product::inRandomOrder()->first();

                // Buat detail pesanan
                OrderDetail::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 10),
                    'price' => $product->price,
                    'subtotal' => function (array $attributes) {
                        return $attributes['quantity'] * $attributes['price'];
                    },
                    'seller_id' => $product->user->id,
                    'seller_address' => $product->user->address,
                ]);
            }
        });
    }
}
