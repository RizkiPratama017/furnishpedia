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
        // Ambil semua orders untuk memastikan order_id valid
        $orders = Order::all();

        // Loop untuk membuat OrderDetail terkait setiap Order
        foreach ($orders as $order) {
            // Ambil produk yang terkait dengan seller dari order ini
            $products = Product::where('user_id', $order->seller_id)  // Pastikan produk dari seller yang sesuai
                ->inRandomOrder()
                ->take(rand(1, 5))  // Ambil produk secara acak, antara 1 hingga 5 produk
                ->get();

            // Buat detail pesanan untuk setiap produk
            foreach ($products as $product) {
                // Gunakan factory untuk membuat OrderDetail dengan data yang valid
                OrderDetail::factory()->create([
                    'order_id' => $order->id,  // ID order terkait
                    'product_id' => $product->id,  // ID produk terkait
                    'quantity' => rand(1, 10),  // Ambil jumlah produk secara acak
                    'price' => $product->price,  // Ambil harga produk
                    'subtotal' => $product->price * rand(1, 10),  // Hitung subtotal berdasarkan quantity acak
                    'seller_id' => $product->user->id,  // Ambil seller_id dari produk
                    'seller_address' => $product->user->address,  // Ambil alamat seller dari produk
                ]);
            }
        }
    }
}
