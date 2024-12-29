<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get ID login auth
        $userId = Auth::id();

        // Mengambil data transaksi berdasarkan seller_id yang login
        $transactions = Order::whereHas('orderDetails', function ($query) use ($userId) {
            $query->where('seller_id', $userId);
        })
            ->with('orderDetails.product')
            ->latest()
            ->limit(5)
            ->get();

        // Mengambil data dari bulan ini
        $currentMonthTransactions = Order::whereHas('orderDetails', function ($query) use ($userId) {
            $query->where('seller_id', $userId);
        })
            ->where('payment_status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with('orderDetails.product')
            ->get();

        $currentMonthRevenue = $currentMonthTransactions->sum('total_price');
        $currentMonthItemsSold = $currentMonthTransactions->sum(function ($order) {
            return $order->orderDetails->sum('quantity');
        });
        $currentMonthTransactionsCount = $currentMonthTransactions->count();

        // Mengambil data dari bulan lalu
        $lastMonthTransactions = Order::whereHas('orderDetails', function ($query) use ($userId) {
            $query->where('seller_id', $userId);
        })
            ->where('payment_status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->year)
            ->with('orderDetails.product')
            ->get();

        $lastMonthRevenue = $lastMonthTransactions->sum('total_price');
        $lastMonthItemsSold = $lastMonthTransactions->sum(function ($order) {
            return $order->orderDetails->sum('quantity');
        });
        $lastMonthTransactionsCount = $lastMonthTransactions->count();

        // Menghitung persentase perubahan
        $revenueChange = $this->calculatePercentageChange($lastMonthRevenue, $currentMonthRevenue);
        $itemsSoldChange = $this->calculatePercentageChange($lastMonthItemsSold, $currentMonthItemsSold);
        $transactionsChange = $this->calculatePercentageChange($lastMonthTransactionsCount, $currentMonthTransactionsCount);

        // Menyiapkan data untuk chart
        $monthlyRevenue = Order::selectRaw('SUM(total_price) as total, strftime("%Y-%m", created_at) as month') // Menggunakan strftime untuk SQLite
            ->whereHas('orderDetails', function ($query) use ($userId) {
                $query->where('seller_id', $userId);
            })
            ->where('payment_status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Menyiapkan label dan data revenue
        $labels = [];
        $revenueData = [];

        foreach ($monthlyRevenue as $revenue) {
            $labels[] = date('F Y', strtotime($revenue->month));
            $revenueData[] = $revenue->total;
        }

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'revenue' => $currentMonthRevenue,
            'items_sold' => $currentMonthItemsSold,
            'transactions_count' => $currentMonthTransactionsCount,
            'transactions' => $transactions,
            'labels' => $labels,
            'revenue_data' => $revenueData,
            'revenue_change' => $revenueChange,
            'items_sold_change' => $itemsSoldChange,
            'transactions_change' => $transactionsChange,
        ];

        return view('dashboard', [
            'title' => 'Dashboard',
            'data' => $data,
        ]);
    }

    // Fungsi untuk menghitung persentase perubahan
    private function calculatePercentageChange($lastMonthValue, $currentValue)
    {
        if ($lastMonthValue == 0) {
            return $currentValue > 0 ? 100 : 0; // Jika tidak ada data bulan lalu
        }
        return (($currentValue - $lastMonthValue) / $lastMonthValue) * 100;
    }
}
