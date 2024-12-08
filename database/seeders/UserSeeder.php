<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'remember_token' => Str::random(10),
            'image' => 'default.png',
            'address' => 'jl. Dr. Setiabudi No. 193, Gegerkalong. Kec. Sukasari, Kota Bandung, Jawa Barat 40153',
        ]);

        user::factory(10)->create();
    }
}
