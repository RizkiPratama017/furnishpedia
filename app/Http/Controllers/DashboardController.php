<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // get ID login auth
        $userId = Auth::id();

        // Mengambil data transaksi berdasarkan id yang login
        $transactions = Order::where('user_id', $userId)
            ->with('orderDetails.product')
            ->latest()
            ->limit(5)
            ->get();

        // Data untuk statistik dashboard
        $totalRevenue = $transactions->sum('total_price');
        $totalItemsSold = $transactions->sum(fn($order) => $order->orderDetails->sum('quantity'));
        $totalTransactions = $transactions->count();

        // Menyiapkan data untuk chart
        $monthlyRevenue = Order::selectRaw('SUM(total_price) as total, strftime("%Y-%m", created_at) as month')
            ->where('user_id', $userId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Menyiapkan label dan data revenue
        $labels = [];
        $revenueData = [];

        foreach ($monthlyRevenue as $revenue) {
            $labels[] = date('F Y', strtotime($revenue->month)); // Mengubah format bulan
            $revenueData[] = $revenue->total; // Total revenue per bulan
        }

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'revenue' => $totalRevenue,
            'items_sold' => $totalItemsSold,
            'transactions_count' => $totalTransactions,
            'transactions' => $transactions,
            'labels' => $labels,
            'revenue_data' => $revenueData,
        ];

        return view('dashboard', [
            'title' => 'Dashboard',
            'data' => $data,
        ]);
    }
}
