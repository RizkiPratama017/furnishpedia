<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CheckoutController extends Controller
{
    // Fungsi untuk menghitung total harga barang, biaya pengiriman, dan total
    private function calculateTotal($cartItems)
    {
        $totalPriceOfGoods = 0;
        $shippingCost = 0;

        foreach ($cartItems as $item) {
            $totalPriceOfGoods += $item->product->price * $item->quantity;
            $shippingCost += $item->product->weight * $item->quantity * 1000; 
        }

        $totalAmount = $totalPriceOfGoods + $shippingCost;

        return compact('totalPriceOfGoods', 'shippingCost', 'totalAmount');
    }

    // Method index untuk checkout
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        // Menghitung total dengan memanggil fungsi calculateTotal
        $totals = $this->calculateTotal($cartItems);

        return view('checkout', compact('cartItems', 'totals'));
    }

    // Method store untuk proses checkout
    public function store(Request $request)
    {
        // Validasi data checkout
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            $cartItems = Cart::where('user_id', Auth::id())->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Keranjang belanja kosong.');
            }

            // Menghitung total dengan memanggil fungsi calculateTotal
            $totals = $this->calculateTotal($cartItems);

            // Simpan data pesanan
            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = 'pending';
            $order->shipping_cost = $totals['shippingCost']; 
            $order->total_price = $totals['totalAmount'];
            $order->shipping_address = $request->shipping_address;
            $order->payment_method = $request->payment_method;
            $order->payment_status = 'pending';
            $order->shipping_status = 'dipacking';
            $order->created_at = now();
            $order->updated_at = now();
            $order->save();

            // Pindahkan item keranjang ke item pesanan
            foreach ($cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'subtotal' => $cartItem->product->price * $cartItem->quantity,
                    'seller_address' => $cartItem->product->user->address,
                ]);
            }

            // Hapus item keranjang setelah disimpan ke pesanan
            Cart::where('user_id', Auth::id())->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke halaman sukses
            return redirect()->route('checkout.success')->with('success', 'Checkout berhasil.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            dd('error', $e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat proses checkout.');
        }
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

        return view('dashboard-order', compact('order', 'orderItems', 'total'));
    }
}
