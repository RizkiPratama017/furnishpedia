<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;


Route::get('/', function () {
    $products = App\Models\Product::take(6)->get();
    return view('home', [
        'title' => 'Home Page',
        'products' => $products
    ]);
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::middleware('auth')->get('/dashboard/category', function () {
    $categories = App\Models\Category::paginate(5);
    return view('dashboard-category', [
        'title' => 'Dashboard Kategori',
        'categories' => $categories
    ]);
});
Route::middleware('auth')->get('/dashboard/product', function () {
    $products = App\Models\Product::paginate(5);
    $categories = \App\Models\Category::all();
    return view('dashboard-product', [
        'title' => 'Dashboard Produk',
        'products' => $products,
        'categories' => $categories
    ]);
});

Route::middleware('auth')->get('/dashboard/profile', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});


Route::middleware('auth')->get('/dashboard/edit', function () {
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
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
//logout
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//google API
Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/callback', 'callbackGoogle');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');