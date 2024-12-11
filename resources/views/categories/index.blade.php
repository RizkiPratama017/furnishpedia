@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Kategori</h1>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection