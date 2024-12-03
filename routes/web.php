<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::get('/dashboard-product', function () {
    $products = App\Models\Product::all();
    return view('dashboard-product', [
        'title' => 'Dashboard Produk',
        'products' => $products
    ]);
});

Route::get('/dashboard-category', function () {
    $categories = App\Models\Category::all();
    return view('dashboard-category', [
        'title' => 'Dashboard Kategori',
        'categories' => $categories
    ]);
});

Route::get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
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

Route::resource('/cart', CartController::class);

//login
Route::get('/login', [LoginController::class, 'index'])->name('login')-> middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
//logout
Route::post('/logout', [LoginController::class, 'logout']);


//Middleware Auth
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']); 
});

Route::middleware('auth')->get('/dashboard-category', function () {
    return view('dashboard', ['title' => 'Dashboard']); 
});

Route::middleware('auth')->get('/dashboard-product', function () {
    return view('dashboard', ['title' => 'Dashboard']); 
});

Route::middleware('auth')->get('/dashboard-profile', function () {
    return view('dashboard', ['title' => 'Dashboard']); 
});
