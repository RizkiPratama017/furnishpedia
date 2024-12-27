<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Pesanan Saya</h1>

        @if ($orders->isEmpty())
            <div class="bg-blue-100 text-blue-800 p-4 rounded-lg text-center">
                Anda belum memiliki pesanan.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($orders as $order)
                    <div class="bg-white border rounded-lg shadow-md">
                        <div class="bg-gray-100 px-4 py-2 rounded-t-lg">
                            <h5 class="font-semibold">Pesanan #{{ $order->id }}</h5>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-2">Status: <span
                                    class="font-medium">{{ ucfirst($order->shipping_status) }}</span></p>
                            <p class="text-gray-700 mb-2">Total Harga: <span class="font-medium">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p class="text-gray-700 mb-4">Alamat Pengiriman: {{ $order->shipping_address }}</p>
                            <a href="{{ route('orders.show', $order->id) }}"
                                class="w-full inline-block bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                Detail Pesanan
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
