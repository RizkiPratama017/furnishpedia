<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        
            return [
                'user_id' => User::inRandomOrder()->first()->id,
                'status' => $this->faker->randomElement(['pending', 'paid', 'shipped']),
                'total_price' => $this->faker->randomFloat(2, 10, 1000),
                'shipping_cost' => $this->faker->randomFloat(2, 0, 100),
                'shipping_address' => $this->faker->address,
                'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'cod']),
                'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            ];


            
    }
}
