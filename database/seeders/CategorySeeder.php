<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(3)->create();

        Category::create([
            'name' => 'Laptop',
            'slug' => 'laptop'
        ]);

        Category::create([
            'name' => 'Smartphone',
            'slug' => 'smartphone'
        ]);

        Category::create([
            'name' => 'Tablet',
            'slug' => 'tablet'
        ]);

        Category::create([
            'name' => 'Desktop',
            'slug' => 'desktop'
        ]);

    }
}
