<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CariController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categories = Category::all();
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->paginate(10);

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
        if (strlen($query) >= 2) {
            $products = Product::with('category')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->get();

            return response()->json([
                'products' => $products,
            ]);
        }

        return response()->json([
            'products' => [],
        ]);
    }

    public function getSuggestions(Request $request)
    {
        $query = $request->get('q');
        if (empty($query)) {
            return response()->json([]);
        }

        $suggestions = Product::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'name']);

        return response()->json($suggestions);
    }
}
