<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::get('/dashboard-product', function () {
    $products = App\Models\Product::paginate(5);
    return view('dashboard-product', [
        'title' => 'Dashboard Produk',
        'products' => $products
    ]);
});

Route::get('/dashboard-category', function () {
    $categories = App\Models\Category::paginate(5);
    return view('dashboard-category', [
        'title' => 'Dashboard Kategori',
        'categories' => $categories
    ]);
});
