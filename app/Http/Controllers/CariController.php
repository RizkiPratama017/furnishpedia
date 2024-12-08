<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CariController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $categories = \App\Models\Category::all();
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return view('search', [
            'title' => 'Halaman Pencarian',
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $query,
        ]);
    }

    public function liveSearch(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) >= 3) {
            $products = Product::with('category')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->get();

            return response()->json($products);
        }

        return response()->json([]);
    }
}
