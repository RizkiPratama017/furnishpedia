<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTP;

class OtpController extends Controller
{
    public function sendOTP(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'buyer') {
            return response()->json(['error' => 'Unauthorized or invalid role'], 403);
        }

        $otp = Str::random(6);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        try {
            Mail::to($user->email)->send(new SendOTP($otp));
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to send OTP email'], 500);
        }

        return view('bukatoko', [
            'success' => 'OTP has been sent to your email',
            'title' => 'Verifikasi Akun'
        ]);
    }


    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        if (!$user || $user->role !== 'buyer') {
            return response()->json(['error' => 'Unauthorized or invalid role'], 403);
        }

        if ($user->otp !== $request->otp) {
            return view('bukatoko', [
                'error' => 'Invalid OTP',
                'title' => 'Verifikasi Akun'
            ]);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return view('bukatoko', [
                'error' => 'OTP expired',
                'title' => 'Verifikasi Akun'
            ]);
        }

        $user->role = 'seller';
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->is_verified = true;
        $user->save();

        return redirect('/')->with('success', 'akun anda sudah bisa melakukan penjualan produk');
    }
}
