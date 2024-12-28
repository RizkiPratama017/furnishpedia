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



//------------------Middleware Role == all

    Route::get('/', function () {
        $products = App\Models\Product::inRandomOrder()->take(6)->get();
        return view('home', [
            'title' => 'Home Page',
            'products' => $products
        ]);
    });


    // // login
    // Route::view('/login', 'login')->name('login');
    // // Route::view('/register', 'register')->name('register');
   
    //toko
    Route::get('/toko/{id}', [TokoController::class, 'index'])->name('toko.index');

    //products
    Route::resource('products', ProductController::class)->except(['index'])->middleware('auth');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    //live search
    Route::get('/search', [CariController::class, 'search'])->name('search');
    Route::get('/search/live', [CariController::class, 'liveSearch'])->name('search.live');
    Route::get('/search/suggestions', [CariController::class, 'getSuggestions']);

    //google API
    Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('auth/google', 'redirect')->name('google-auth');
    Route::get('auth/google/callback', 'callbackGoogle')->name('google-callback');
    });

    //category
    Route::get('/categories/detail', [CategoryController::class, 'detail'])->name('categories.detail');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

    // // Dummy routes untuk login sosial
    // Route::get('/login/{provider}', function ($provider) {
    //     return "Login with $provider not implemented yet!";
    // })->name('social.login');

//------------------Middleware Role == guest
Route::middleware(['guest'])->group(function () {
    
    //login
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);

    //register
    Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'store']);

    // Form Lupa Password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
   
    
});

//------------------Middleware Role == Auth
Route::middleware(['auth'])->group(function () {
    
    //logout
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

    //order
    Route::middleware('auth')->get('/dashboard/order', [OrderController::class, 'sellerOrders'])->name('order.details');
    Route::put('/orders/{order}/update-shipping-status', [OrderController::class, 'updateShippingStatus'])->name('orders.updateShippingStatus');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    //rating
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

    //Histori
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    
    //cart
    Route::resource('/cart', CartController::class)->middleware('auth');
    Route::get('/cart', [CartController::class, 'indexCart'])->name('cart.index');
    
    //profile-title
    Route::get('/dashboard-profile', function () {
        return view('profile', ['title' => 'Profile']);
    });
    

    // //profile-title
    // Route::get('/profile', function () {
    //     return view('profile', ['title' => 'Profile']);
    // });



    // profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    //buka toko
    Route::get('/bukatoko', [BukaTokoController::class, 'index'])->name('bukatoko');

    // checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{status}', [CheckoutController::class, 'notification'])->name('checkout.status');
    // Route::middleware('auth')->get('/dashboard/order', [CheckoutController::class, 'showOrderDetails'])->name('order.details');
    Route::get('/checkout/success', function () {
        return view('checkout-success', ['title' => 'Checkout Sukses']);
    })->name('checkout.success');
});



// ----------------------Middleware Role == buyer
Route::middleware(['is_buyer'])->group(function(){

//otp - buka toko
Route::post('/send-otp', [OtpController::class, 'sendOTP'])->name('send.otp');
Route::post('/verify-otp', [OTPController::class, 'verifyOTP'])->name('verify.otp');

});


//-----------------------Middleware Role == seller
Route::middleware(['is_seller'])->group(function(){


    //dashboard-product
    Route::get('/dashboard-product', function () {
        if (Auth::user()->role == 'buyer') {
            return redirect('/');
        }
        $products = App\Models\Product::all();
        return view('dashboard-product', ['title' => 'Dashboard Produk', 'products' => $products]);
    });

    //fungsi CRUD produk
    Route::put('/dashboard/product/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
    Route::post('/dashboard/product', [ProductController::class, 'store'])->name('products.store')->middleware('auth');

     // route dashboard produk
     Route::get('/dashboard/product', [ProductController::class, 'dproduk'])->name('dashboard.product');
     Route::get('/dashboard/product/{id}', [ProductController::class, 'viewEdit'])->name('product.edit');
});

//------------------------Middleware Role == admin
Route::middleware(['is_admin'])->group(function(){


    //dashboard-category
    Route::get('/dashboard-category', function () {
        if (Auth::user()->role == 'is_seller') {
            return redirect('/');
        }
        $categories = App\Models\Category::all();
        return view('dashboard-category', ['title' => 'Dashboard Kategori', 'categories' => $categories]);
    });

    //dashboard-product
    Route::get('/dashboard-product', function () {
        if (Auth::user()->role == 'buyer') {
            return redirect('/');
        }
        $products = App\Models\Product::all();
        return view('dashboard-product', ['title' => 'Dashboard Produk', 'products' => $products]);
    });

    // fungsi CRUD Category
    Route::resource('categories', CategoryController::class)->middleware('auth')->except('show');
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::put('/dashboard/category/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth');
    

    // route dashboard kategori
    Route::middleware('auth')->get('/dashboard/category', [CategoryController::class, 'index'])->name('dashboard.category');
    Route::middleware('auth')->get('/dashboard/category/{id}', [CategoryController::class, 'viewEdit'])->name('category.edit');

});

//------------------------Middleware Role == Seller or Admin
Route::middleware(['is_seller_or_is_admin'])->group(function(){

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});