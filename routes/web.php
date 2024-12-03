<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::get('/dashboard/product', function () {
    $products = App\Models\Product::paginate(5);
    $categories = \App\Models\Category::all();
    return view('dashboard-product', [
        'title' => 'Dashboard Produk',
        'products' => $products,
        'categories' => $categories
    ]);
});

Route::get('/dashboard/category', function () {
    $categories = App\Models\Category::paginate(5);
    return view('dashboard-category', [
        'title' => 'Dashboard Kategori',
        'categories' => $categories
    ]);
});

Route::get('/dashboard/edit', function () {
    $categories = App\Models\Category::paginate(5);
    return view('dashboard-edit', [
        'title' => 'Dashboard Edit',
        'categories' => $categories
    ]);
});

Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
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
