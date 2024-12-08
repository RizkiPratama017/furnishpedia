<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category = Category::inRandomOrder()->first();


        $productNames = [
            'Meja' => ['Meja Makan', 'Meja Kerja', 'Meja Kopi', 'Meja Belajar', 'Meja Lipat'],
            'Kursi' => ['Kursi Makan', 'Kursi Kantor', 'Kursi Santai', 'Kursi Gaming', 'Kursi Lipat'],
            'Sofa' => ['Sofa 2 Dudukan', 'Sofa Sudut', 'Sofa Tidur', 'Sofa Modular'],
            'Lemari' => ['Lemari Pakaian', 'Lemari Dapur', 'Lemari Buku', 'Lemari Arsip'],
            'Tempat Tidur' => ['Tempat Tidur King Size', 'Tempat Tidur Queen Size', 'Tempat Tidur Anak'],
            'Rak Buku' => ['Rak Buku Dinding', 'Rak Buku Kayu', 'Rak Buku Minimalis'],
            'Peralatan Dapur' => ['Panci', 'Wajan', 'Pisau Dapur', 'Blender', 'Talenan'],
            'Tekstil' => ['Sprei', 'Selimut', 'Handuk', 'Gorden', 'Karpet'],
            'Lampu' => ['Lampu Gantung', 'Lampu Meja', 'Lampu Lantai', 'Lampu LED'],
            'Dekorasi' => ['Vas Bunga', 'Bingkai Foto', 'Lilin Aromaterapi', 'Tanaman Hias Buatan'],
            'Peralatan Kamar Mandi' => ['Handuk Mandi', 'Tirai Mandi', 'Rak Penyimpanan', 'Keset Kamar Mandi'],
            'Peralatan Anak' => ['Tempat Tidur Bayi', 'Meja Belajar Anak', 'Mainan Edukasi', 'Rak Mainan']
        ];


        $categoryName = $category->name;
        $productNamesForCategory = $productNames[$categoryName];


        $name = fake()->randomElement($productNamesForCategory);

        return [
            "user_id" => User::whereNotIn('role', ['penjual', 'buyer'])->inRandomOrder()->first()->id,
            "category_id" => $category->id,
            "name" => $name,
            "description" => Str::slug(fake()->sentence()),
            "price" => fake()->randomFloat(0, 10000, 10000000),
            "stock" => fake()->numberBetween(1, 50),
            "image" => fake()->imageUrl(),
            "weight" => fake()->randomFloat(0, 1, 1000),
        ];
    }
}
