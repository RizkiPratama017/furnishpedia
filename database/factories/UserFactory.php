<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $addresses = [
            'Jl. Merdeka No. 10, Jakarta Pusat, DKI Jakarta, Indonesia',
            'Jl. Sudirman No. 50, Jakarta Selatan, DKI Jakarta, Indonesia',
            'Jl. Raya Bogor No. 1, Jakarta Timur, DKI Jakarta, Indonesia',
            'Jl. Tunjungan No. 12, Surabaya, Jawa Timur, Indonesia',
            'Jl. Pahlawan No. 30, Bandung, Jawa Barat, Indonesia',
            'Jl. Raya Seminyak No. 5, Bali, Indonesia',
            'Jl. Sisingamangaraja No. 15, Medan, Sumatera Utara, Indonesia',
            'Jl. Pemuda No. 22, Yogyakarta, Indonesia',
            'Jl. Riau No. 7, Pekanbaru, Riau, Indonesia',
            'Jl. Trans Kalimantan No. 8, Palangkaraya, Kalimantan Tengah, Indonesia',
        ];

        // Pilih alamat secara acak dari daftar
        $address = $this->faker->randomElement($addresses);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['seller', 'buyer']),
            'is_active' => false,
            'remember_token' => Str::random(10),
            'image' => 'default.png',
            'address' => $address,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
