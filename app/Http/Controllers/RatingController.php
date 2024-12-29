<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\OrderDetail; // Import model untuk memeriksa pembelian produk
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Periksa apakah pengguna telah membeli produk tersebut
        $hasPurchased = OrderDetail::where('product_id', $request->product_id)
            ->whereHas('order', function ($query) {
                $query->where('buyer_id', auth()->id());
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->route('products.show', $request->product_id)
                ->with('error', 'You can only rate products you have purchased.');
        }

        // Periksa apakah pengguna sudah memberikan rating sebelumnya
        $existingRating = Rating::where('product_id', $request->product_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            return redirect()->route('products.show', $request->product_id)
                ->with('error', 'You have already rated this product.');
        }

        // Simpan rating baru
        Rating::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return redirect()->route('products.show', $request->product_id)
            ->with('success', 'Your rating has been submitted!');
    }
}
