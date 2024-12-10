<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Models\Product;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\BukaTokoController;
use App\Http\Controllers\CariController;


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
    $products = App\Models\Product::where('user_id', auth()->id())->paginate(5);

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
    return view('category-edit', [
        'title' => 'Dashboard Edit',
        'categories' => $categories
    ]);
});

Route::middleware('auth')->get('/dashboard/category/{id}', function ($id) {
    // Ambil data kategori berdasarkan ID yang dikirimkan di URL
    $categories = App\Models\Category::findOrFail($id);

    return view('category-edit', [
        'title' => 'Dashboard Edit',
        'category' => $categories, // Hanya satu kategori berdasarkan ID
    ]);
});

Route::middleware('auth')->get('/dashboard/product/{id}', function ($id) {
    // Ambil data kategori berdasarkan ID yang dikirimkan di URL
    $products = App\Models\Product::findOrFail($id);
    $categories = \App\Models\Category::all();

    return view('product-edit', [
        'title' => 'Dashboard Edit',
        'product' => $products, // Hanya satu Product berdasarkan ID
        'categories' => $categories
    ]);
});


Route::middleware('auth')->get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
});

//fungsi CRUD produk
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/dashboard/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product', [ProductController::class, 'search'])->name('products.search');

// fungsi CRUD Category
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/category', [CategoryController::class, 'search'])->name('categories.search');
Route::put('/dashboard/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/dashboard/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');

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
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
//logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//google API
Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/callback', 'callbackGoogle')->name('google-callback');
});


Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Route::controller(FacebookAuthController::class)->group(function () {
//     Route::get('auth/facebook', 'redirect')->name('facebook-auth');
//     Route::get('auth/facebook/callback', 'callbackFacebook');
// });



//buka toko
Route::get('/bukatoko', [BukaTokoController::class, 'index'])->name('bukatoko')->middleware('auth');

//live search
Route::get('/search', [CariController::class, 'search'])->name('search');
Route::get('/search/live', [CariController::class, 'liveSearch'])->name('search.live');


//filter 
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');