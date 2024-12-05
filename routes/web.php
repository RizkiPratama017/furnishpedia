<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;


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

// VIEW
Route::view('/login', 'login')->name('login');
// Route::view('/register', 'register')->name('register');

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

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


//Middleware Auth
Route::middleware('auth')->group(function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    //dashboard-product
    Route::get('/dashboard-product', function () {
        $products = App\Models\Product::all();
        return view('dashboard-product', ['title' => 'Dashboard Produk', 'products' => $products]);
    });

    //dashboard-category
    Route::get('/dashboard-category', function () {
        $categories = App\Models\Category::all();
        return view('dashboard-category', ['title' => 'Dashboard Kategori', 'categories' => $categories]);
    });

    //profile
    Route::get('/dashboard-profile', function () {
        return view('profile', ['title' => 'Profile']);
    });
});



//google API
Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/callback', 'callbackGoogle')->name('google-callback');
});
