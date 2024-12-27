<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Memastikan ada produk yang di-seed
        Product::factory(50)->create(); // Menambahkan 50 produk secara acak
    }
}
