@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <div class="alert alert-warning" role="alert">
            Keranjang Anda kosong. Silakan tambahkan produk.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="50">
                                {{ $item->product->name }}
                            </td>
                            <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 80px; display: inline;">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <h4>Total: Rp {{ number_format($cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            }), 0, ',', '.') }}</h4>
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
</div>
@endsection