<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});


Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

// Form Lupa Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Dummy routes untuk login sosial
Route::get('/login/{provider}', function ($provider) {
    return "Login with $provider not implemented yet!";
})->name('social.login');