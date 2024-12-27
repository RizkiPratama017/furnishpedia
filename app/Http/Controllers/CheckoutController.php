<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;

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

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        // Menghitung total dengan memanggil fungsi calculateTotal
        $totals = $this->calculateTotal($cartItems);

        return view('checkout', compact('cartItems', 'totals',), [
            'title' => 'checkout'
        ]);
    }

    // Method store untuk proses checkout
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $cartItems = Cart::where('user_id', Auth::id())->with('product.user')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Keranjang belanja kosong.');
            }

            // Kelompokkan item berdasarkan seller
            $groupedItems = $cartItems->groupBy(function ($item) {
                return $item->product->user->id; // Kelompokkan berdasarkan seller_id
            });

            // Loop untuk setiap kelompok seller dan buat pesanan
            foreach ($groupedItems as $sellerId => $items) {
                // Hitung total untuk pesanan ini
                $totals = $this->calculateTotal($items);

                // Simpan pesanan untuk seller ini
                $order = new Order();
                $order->buyer_id = Auth::id();
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

                // Tambahkan detail item pesanan ke order_details
                foreach ($items as $cartItem) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $cartItem->product_id;
                    $orderDetail->seller_id = $cartItem->product->user->id; // Seller ID dari produk
                    $orderDetail->quantity = $cartItem->quantity;
                    $orderDetail->price = $cartItem->product->price;
                    $orderDetail->subtotal = $cartItem->product->price * $cartItem->quantity;
                    $orderDetail->seller_address = $cartItem->product->user->address;
                    $orderDetail->save();
                }
            }

            // Hapus item keranjang setelah checkout selesai
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Checkout berhasil untuk semua pesanan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat proses checkout: ' . $e->getMessage());
        }
    }

    public function notification($status)
    {
        // Pastikan status adalah 'pending', 'success', atau 'failed'
        if (!in_array($status, ['pending', 'success', 'failed'])) {
            abort(404);
        }

        return view('checkout-status', [
            'status' => $status,
            'title' => 'checkout-success'
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
