<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->take(6)->get();

        return view('home', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian
        $categories = \App\Models\Category::all();
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('dashboard-product', [
            'title' => 'Dashboard Product',
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query // Kirim query untuk digunakan di tampilan
        ]);
    }
}
