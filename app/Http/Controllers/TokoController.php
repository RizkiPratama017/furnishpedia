<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function index($id)
    {
        // Pastikan menggunakan lazy loading untuk menghindari N+1 query issue
        $user = User::with('products')->findOrFail($id);

        // Pastikan variabel `products` diambil dari relasi yang benar
        $products = $user->products;

        // Pastikan properti 'title' sesuai dengan tujuan halaman
        return view('toko', [
            'title' => "Toko: {$user->name}",
            'user' => $user,
            'products' => $products,
        ]);
    }
}
