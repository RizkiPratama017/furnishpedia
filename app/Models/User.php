<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\OtpMail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'google_id',
        'remember_token',
        'password',
        'image',
        'address',
        'otp',
        'otp_expires_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function generateOtp()
{
    $this->otp = Str::random(6); // OTP 6 karakter
    $this->otp_expires_at = now()->addMinutes(10); // Berlaku 10 menit
    $this->save();
}

public function generateOtpAndSendEmail(Request $request)
{
    $user = User::find($request->user_id);
    $this->otp = rand(100000, 999999); // Generate OTP 6 digit angka
    $this->otp_expires_at = now()->addMinutes(10); // Berlaku selama 10 menit
    $this->save();

    // Kirim OTP ke email pengguna
    Mail::to($this->email)->send(new SendOTP($this->otp));
}



}
