@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Filter Produk</h1>

    <form action="{{ route('products.filter') }}" method="GET">
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
// commit bareng yang berdasarkan harga
        <div class="form-group">
            <label for="price_min">Harga Minimum</label>
            <input type="number" name="price_min" id="price_min" class="form-control" placeholder="0">
        </div>

        <div class="form-group">
            <label for="price_max">Harga Maksimum</label>
            <input type="number" name="price_max" id="price_max" class="form-control" placeholder="1000000">
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <h2>Hasil Pencarian</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Harga: Rp {{ number_format($product->price, 2) }}</p>
                        <p class="card-text">Kategori: {{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $products->links() }} <!-- Pagination links -->
</div>
@endsection