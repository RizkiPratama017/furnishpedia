<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = [
            [
                'name' => 'Produk A',
                'quantity' => 2,
                'price' => 150000,
                'image' => 'img/default-picture.png',
            ],
            [
                'name' => 'Produk B',
                'quantity' => 1,
                'price' => 250000,
                'image' => 'img/default-picture.png',
            ],
            [
                'name' => 'Produk C',
                'quantity' => 3,
                'price' => 100000,
                'image' => 'img/default-picture.png',
            ],
        ];

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        // Proses penyimpanan data pembayaran (misalnya ke tabel orders)
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        // Clear cart after checkout
        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    public function notification($status)
    {
        // Pastikan status adalah 'pending', 'success', atau 'failed'
        if (!in_array($status, ['pending', 'success', 'failed'])) {
            abort(404);
        }

        return view('checkout-status', [
            'status' => $status
        ]);
    }


    public function showOrderDetails()
    {
        // Data manual untuk keperluan tampilan
        $order = (object)[
            'id' => 1,
            'payment_status' => 'Berhasil',
            'total_amount' => 500000,
            'shipping_address' => 'Jl. Merdeka No. 10, Jakarta',
            'shipment_status' => 'Pesanan Terkirim',
            'courier' => 'JNE'
        ];

        $orderItems = [
            (object)[
                'product' => (object)[
                    'name' => 'Produk A'
                ],
                'price' => 100000,
                'quantity' => 2,
                'subtotal' => 200000
            ],
            (object)[
                'product' => (object)[
                    'name' => 'Produk B'
                ],
                'price' => 150000,
                'quantity' => 2,
                'subtotal' => 300000
            ]
        ];

        // Menghitung total harga pesanan
        $total = array_sum(array_map(function ($item) {
            return $item->subtotal;
        }, $orderItems));

        return view('order-detail', compact('order', 'orderItems', 'total'));
    }
}
