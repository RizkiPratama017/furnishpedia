<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

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

        // Nama produk
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
        $productNamesForCategory = $productNames[$categoryName] ?? [];

        $name = fake()->randomElement($productNamesForCategory);

        // Gambar dari Unsplash API
        $image = $this->getUnsplashImage($name);

        return [
            "user_id" => User::whereNotIn('role', ['admin', 'buyer'])->inRandomOrder()->first()->id,
            "category_id" => $category->id,
            "name" => $name,
            "description" => fake()->sentence(),
            "price" => fake()->randomFloat(2, 10000, 10000000),
            "stock" => fake()->numberBetween(1, 50),
            "image" => $image,
            "weight" => fake()->randomFloat(2, 0, 1000),
        ];
    }

    private function getUnsplashImage(string $query): string
    {
        $translations = [
            'Meja Makan' => 'Dining Table',
            'Meja Kerja' => 'Work Desk',
            'Meja Kopi' => 'Coffee Table',
            'Meja Belajar' => 'Study Table',
            'Meja Lipat' => 'Folding Table',
            'Kursi Makan' => 'Dining Chair',
            'Kursi Kantor' => 'Office Chair',
            'Kursi Santai' => 'Lounge Chair',
            'Kursi Gaming' => 'Gaming Chair',
            'Kursi Lipat' => 'Folding Chair',
            'Sofa 2 Dudukan' => 'Two Seater Sofa',
            'Sofa Sudut' => 'Sectional Sofa',
            'Sofa Tidur' => 'Sleeper Sofa',
            'Sofa Modular' => 'Modular Sofa',
            'Lemari Pakaian' => 'Wardrobe',
            'Lemari Dapur' => 'Kitchen Cabinet',
            'Lemari Buku' => 'Bookshelf',
            'Lemari Arsip' => 'Filing Cabinet',
            'Tempat Tidur King Size' => 'King Size Bed',
            'Tempat Tidur Queen Size' => 'Queen Size Bed',
            'Tempat Tidur Anak' => 'Children Bed',
            'Rak Buku Dinding' => 'Wall Bookshelf',
            'Rak Buku Kayu' => 'Wooden Bookshelf',
            'Rak Buku Minimalis' => 'Minimalist Bookshelf',
            'Panci' => 'Cooking Pot',
            'Wajan' => 'Frying Pan',
            'Pisau Dapur' => 'Kitchen Knife',
            'Blender' => 'Blender',
            'Talenan' => 'Cutting Board',
            'Sprei' => 'Bed Sheet',
            'Selimut' => 'Blanket',
            'Handuk' => 'Towel',
            'Gorden' => 'Curtain',
            'Karpet' => 'Carpet',
            'Lampu Gantung' => 'Chandelier',
            'Lampu Meja' => 'Table Lamp',
            'Lampu Lantai' => 'Floor Lamp',
            'Lampu LED' => 'LED Lamp',
            'Vas Bunga' => 'Flower Vase',
            'Bingkai Foto' => 'Photo Frame',
            'Lilin Aromaterapi' => 'Aromatherapy Candle',
            'Tanaman Hias Buatan' => 'Artificial Plant',
            'Handuk Mandi' => 'Bath Towel',
            'Tirai Mandi' => 'Shower Curtain',
            'Rak Penyimpanan' => 'Storage Rack',
            'Keset Kamar Mandi' => 'Bath Mat',
            'Tempat Tidur Bayi' => 'Baby Crib',
            'Meja Belajar Anak' => 'Kids Study Desk',
            'Mainan Edukasi' => 'Educational Toy',
            'Rak Mainan' => 'Toy Organizer'
        ];

        $translatedQuery = $translations[$query] ?? $query;
        $apiKey = env('UNSPLASH_API_KEY');
        $response = Http::get("https://api.unsplash.com/photos/random", [
            'query' => $translatedQuery,
            'client_id' => $apiKey,
            'orientation' => 'landscape'
        ]);

        // Log respons untuk debugging
        if (!$response->successful()) {
            logger()->error('Unsplash API error: ' . $response->body());
        } else {
            logger()->info('Unsplash API response: ', $response->json());
        }

        if ($response->successful() && isset($response['urls']['regular'])) {
            return $response['urls']['regular'];
        }

        return 'https://via.placeholder.com/300?text=Image+Not+Found';
    }
}
