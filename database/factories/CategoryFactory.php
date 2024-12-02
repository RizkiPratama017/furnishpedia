<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $categories = [
            'Meja',
            'Kursi',
            'Sofa',
            'Lemari',
            'Tempat Tidur',
            'Rak Buku',
            'Peralatan Dapur',
            'Tekstil',
            'Lampu',
            'Dekorasi',
            'Peralatan Kamar Mandi',
            'Peralatan Anak'
        ];

        // Ambil satu kategori dari array dan hapus untuk menghindari duplikasi
        $name = array_shift($categories);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
