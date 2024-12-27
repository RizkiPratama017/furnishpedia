<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\CariController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BukaTokoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\TokoController;

Route::get('/', function () {
    $products = App\Models\Product::inRandomOrder()->take(6)->get();
    return view('home', [
        'title' => 'Home Page',
        'products' => $products
    ]);
});

// route dashboard kategori
Route::middleware('auth')->get('/dashboard/category', [CategoryController::class, 'index'])->name('dashboard.category');
Route::middleware('auth')->get('/dashboard/category/{id}', [CategoryController::class, 'viewEdit'])->name('category.edit');

// route dashboard produk
Route::middleware('auth')->get('/dashboard/product', [ProductController::class, 'dproduk'])->name('dashboard.product');
Route::middleware('auth')->get('/dashboard/product/{id}', [ProductController::class, 'viewEdit'])->name('product.edit');

Route::middleware('auth')->get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
});

//fungsi CRUD produk
Route::resource('products', ProductController::class)->except(['index'])->middleware('auth');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::put('/dashboard/product/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::post('/dashboard/product', [ProductController::class, 'store'])->name('products.store')->middleware('auth');

// fungsi CRUD Category
Route::get('/categories/detail', [CategoryController::class, 'detail'])->name('categories.detail');
Route::resource('categories', CategoryController::class)->middleware('auth')->except('show');
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::put('/dashboard/category/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

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

Route::resource('/cart', CartController::class)->middleware('auth');
Route::get('/cart', [CartController::class, 'indexCart'])->name('cart.index');

//login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
//logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);



//Middleware Auth
Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //dashboard-product
    Route::get('/dashboard-product', function () {
        if (Auth::user()->role == 'buyer') {
            return redirect('/');
        }
        $products = App\Models\Product::all();
        return view('dashboard-product', ['title' => 'Dashboard Produk', 'products' => $products]);
    });

    //dashboard-category
    Route::get('/dashboard-category', function () {
        if (Auth::user()->role == 'buyer') {
            return redirect('/');
        }
        $categories = App\Models\Category::all();
        return view('dashboard-category', ['title' => 'Dashboard Kategori', 'categories' => $categories]);
    });

    //profile
    Route::get('/dashboard-profile', function () {
        return view('profile', ['title' => 'Profile']);
    });

    //buka toko
    Route::get('/bukatoko', [BukaTokoController::class, 'index'])->name('bukatoko');
});






//google API
Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/callback', 'callbackGoogle')->name('google-callback');
});




// Route::controller(FacebookAuthController::class)->group(function () {
//     Route::get('auth/facebook', 'redirect')->name('facebook-auth');
//     Route::get('auth/facebook/callback', 'callbackFacebook');
// });





//live search
Route::get('/search', [CariController::class, 'search'])->name('search');
Route::get('/search/live', [CariController::class, 'liveSearch'])->name('search.live');
Route::get('/search/suggestions', [CariController::class, 'getSuggestions']);


//otp
// Route::post('/send-otp', [OtpController::class, 'sendOTP'])->name('send.otp');
Route::post('/send-otp', [OtpController::class, 'sendOTP'])->name('send.otp');
Route::post('/verify-otp', [OTPController::class, 'verifyOTP'])->name('verify.otp');


// profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::patch('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

//rating
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// checkout
Route::middleware('auth')->get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::middleware('auth')->post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::middleware('auth')->get('/checkout/{status}', [CheckoutController::class, 'notification'])->name('checkout.status');
// Route::middleware('auth')->get('/dashboard/order', [CheckoutController::class, 'showOrderDetails'])->name('order.details');
Route::get('/checkout/success', function () {
    return view('checkout-success', ['title' => 'Checkout Sukses']);
})->name('checkout.success');


//order
Route::middleware('auth')->get('/dashboard/order', [OrderController::class, 'sellerOrders'])->name('order.details');
Route::put('/orders/{order}/update-shipping-status', [OrderController::class, 'updateShippingStatus'])->name('orders.updateShippingStatus');
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

//Histori
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');


//toko
Route::get('/toko/{id}', [TokoController::class, 'index'])->name('toko.index');
