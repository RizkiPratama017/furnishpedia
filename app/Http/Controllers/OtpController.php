<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTP;



class OtpController extends Controller
{
//     public function showOtpForm()
//     {
//         return view('auth.verify-otp');
//     }

    public function sendOTP(Request $request)
{
    $user = Auth::user();

    if (!$user || $user->role !== 'buyer') {
        return response()->json(['error' => 'Unauthorized or invalid role'], 403);
    }

    // Generate OTP
    $otp = Str::random(6);
    $user->otp = $otp;
    $user->otp_expires_at = Carbon::now()->addMinutes(5); // OTP berlaku 5 menit
    $user->save();

    // Kirim email
    // Mail::to($user->email)->send(new SendOTP($otp));
    Mail::to($user->email)->send(new SendOTP($otp));
    return view('/bukatoko');

    // return response()->json(['message' => 'OTP has been sent to your email']);
}

public function verifyOTP(Request $request)
{
    $request->validate([
        'otp' => 'required|string|size:6',
    ]);

    $user = Auth::user();

    // if (!$user || $user->role !== 'buyer') {
    //     return response()->json(['error' => 'Unauthorized or invalid role'], 403);
    // }

    if ($user->otp !== $request->otp) {
        return response()->json(['error' => 'Invalid OTP'], 400);
    }

    if (Carbon::now()->gt($user->otp_expires_at)) {
        return response()->json(['error' => 'OTP expired'], 400);
    }

    // Update role menjadi seller
    $user->role = 'seller';
    $user->otp = null; 
    $user->otp_expires_at = null;
    $user->is_verified = true;
    $user->save();
    
    $user = Auth::user(); // Mendapatkan user yang sedang login
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return view('/bukatoko');
    
}



    // public function testing(){
    //     $user = Auth::user();
        
    //     $otp = Str::random(6);
    //     $user->otp = $otp;
    //     $user->otp_expires_at = Carbon::now()->addMinutes(5); // OTP berlaku 5 menit
    //     $user->save();
    //     Mail::to("harutookira@gmail.com")->send(new Newsletter($otp));
    // }

}

