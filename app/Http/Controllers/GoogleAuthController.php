<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        //cek
        // dd($googleUser->getId());
        // Cek apakah pengguna sudah ada
        $user = User::where('google_id', $googleUser->getId())->first();
        
        if (!$user) {
            // Pengguna baru, buat akun baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'password' => Hash::make(Str::random(16)), // Sandi acak untuk akun baru
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
                'google_id' => $googleUser->getId(),
                'role' => 'buyer',
                'is_active' => true,
                'remember_token' => $googleUser->token,
                'image' => $googleUser->getAvatar(),
            ]);

            // dd($user); 
            Auth::login($user);  // Login pengguna baru
            Log::info('User registered and logged in: ' . $user->name);
            return redirect('/dashboard');
        } else {
            Auth::login($user);  // Login pengguna yang sudah ada
            Log::info('User logged in: ' . $user->name);
            return redirect('/dashboard');
        }

    } catch (\Throwable $th) {
        Log::error('Google Auth Error: ' . $th->getMessage());
        return redirect('/login')->with('error', 'Terjadi kesalahan saat autentikasi.');
    }
}

}
