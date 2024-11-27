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
        return [    
            "user_id" => User::whereNotIn('role', ['admin', 'buyer'])->inRandomOrder()->first()->id,
            "category_id" => Category::inRandomOrder()->first()->id,
            "name" => fake()->name(),
            "description" => Str::slug(fake()->sentence()),
            "price" => fake()->randomFloat(2, 1, 100),
            "stock" => fake()->numberBetween(1, 100),
            "image" => fake()->imageUrl()

        ];
    }
}
