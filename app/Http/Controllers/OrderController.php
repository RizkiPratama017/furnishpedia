<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function sellerOrders(Request $request)
    {
        $user = Auth::user(); // Penjual yang sedang login

        if ($user->role !== 'seller') {
            abort(403, 'Akses ditolak');
        }

        // Ambil pesanan terkait produk penjual
        $orders = Order::whereHas('orderDetails.product', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('orderDetails.product')->get();

        return view('dashboard-order', compact('orders'));
    }

    public function updateShippingStatus(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'shipping_status' => 'required|in:dipacking,dikirim,diterima,batal,gagal',
        ]);

        // Update status pengiriman
        $order->shipping_status = $request->input('shipping_status');
        $order->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}
