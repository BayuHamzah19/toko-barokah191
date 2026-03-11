@extends('layouts.app')

@section('title', 'Belanja')

@section('content')
<div class="container mt-4">
    <h1>Belanja Produk</h1>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card product-card h-100">
                    
                    {{-- Gambar Produk --}}
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="card-img-top product-image">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>

                        <p class="card-text">
                            <strong>Stok:</strong> {{ $product->stock }}
                        </p>

                        <p class="card-text fw-bold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('belanja.show', $product->id) }}" class="btn btn-primary w-100">
                            Beli
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada produk.</p>
        @endforelse
    </div>
</div>
@endsection
