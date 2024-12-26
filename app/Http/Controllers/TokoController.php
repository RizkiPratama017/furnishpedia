<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Ambil semua produk dari database
        return view('toko', compact('products'));
    }
}