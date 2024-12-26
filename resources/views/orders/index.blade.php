<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <header>
        <x-navbar></x-navbar>
    </header>
    @section('content')
<div class="container">
    <h1 class="mb-4">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info">Anda belum memiliki pesanan.</div>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pesanan #{{ $order->id }}</h5>
                        </div>
                        <div class="card-body">
                            <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
                            <p>Total Harga: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
                            <p>Alamat Pengiriman: {{ $order->shipping_address }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Detail Pesanan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
</x-layout>