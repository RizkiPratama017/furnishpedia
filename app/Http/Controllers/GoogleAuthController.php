<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();
        dd($googleUser);

    //    try{
    //     $google_user = Socialite::driver('google')->user();
    //     $user = User::where('google_id', $google_user->getid())->first();
    //     if(!$user){
    //         $new_user = User::create([
    //             'name' => $google_user->getname(),
    //             'email' => $google_user->getemail(),
    //             'password' => Hash::make('password'),
    //             'google_id' => $google_user->getid(),
    //             'role' => 'buyer',
    //             'is_active' => true,
    //             'remember_token' => $google_user->token,
    //             'image' => $google_user->getavatar(),
    //         ]);

    //         Auth::login($new_user);
    //         return redirect('/dashboard');
    //     }else{
    //         Auth::login($user);
    //         return redirect('/dashboard');
    //     }

    //    }catch(\Throwable $th){
    //     Log::error('Google Auth Error: ' . $th->getMessage());
    //     return $th->getMessage();
    //    }
    }
}
