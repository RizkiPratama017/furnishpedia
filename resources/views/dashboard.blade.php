<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex flex-1 min-h-full">
        {{-- Sidebar --}}
        <x-sidebar></x-sidebar>

        {{-- Main --}}
        <main class="flex-1 m-5 overflow-y-auto">
            <!-- Grid dengan perubahan layout pada layar kecil -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                {{-- flex cards --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-gray-500">Total Revenue for This Month</h2>
                    <p class="text-2xl font-bold">Rp{{ number_format($data['revenue'], 0, ',', '.') }}</p>
                    <p class="{{ $data['revenue_change'] > 0 ? 'text-green-500' : 'text-red-500' }} text-sm mt-2">
                        @if ($data['revenue_change'] > 0)
                            ↑ {{ number_format($data['revenue_change'], 2) }}% from last month
                        @else
                            ↓ {{ number_format(abs($data['revenue_change']), 2) }}% from last month
                        @endif
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-gray-500">Total Items Sold for This Month</h2>
                    <p class="text-2xl font-bold">{{ number_format($data['items_sold'], 0, ',', '.') }}</p>
                    <p class="{{ $data['items_sold_change'] > 0 ? 'text-green-500' : 'text-red-500' }} text-sm mt-2">
                        @if ($data['items_sold_change'] > 0)
                            ↑ {{ number_format($data['items_sold_change'], 2) }}% from last month
                        @else
                            ↓ {{ number_format(abs($data['items_sold_change']), 2) }}% from last month
                        @endif
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-gray-500">Total Transactions for This Month</h2>
                    <p class="text-2xl font-bold">{{ number_format($data['transactions_count'], 0, ',', '.') }}</p>
                    <p class="{{ $data['transactions_change'] > 0 ? 'text-green-500' : 'text-red-500' }} text-sm mt-2">
                        @if ($data['transactions_change'] > 0)
                            ↑ {{ number_format($data['transactions_change'], 2) }}% from last month
                        @else
                            ↓ {{ number_format(abs($data['transactions_change']), 2) }}% from last month
                        @endif
                    </p>
                </div>

                {{-- Grafik penjualan --}}
                <div class="sm:col-span-2 md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Report Statistics</h2>
                    <div class="h-96 flex items-center justify-center rounded">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                {{-- Penjualan terakhir --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Latest Transactions</h2>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($data['transactions'] as $transaction)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                Order #{{ $transaction->id }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $transaction->payment_status }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                            Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', // Tipe chart, bisa diganti sesuai kebutuhan
            data: {
                labels: @json($data['labels']), // Label untuk sumbu X
                datasets: [{
                    label: 'Total Revenue',
                    data: @json($data['revenue_data']), // Data untuk sumbu Y
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-dashboard-layout>
