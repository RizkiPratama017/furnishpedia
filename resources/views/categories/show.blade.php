@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{ $category->name }}</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Harga: Rp {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection