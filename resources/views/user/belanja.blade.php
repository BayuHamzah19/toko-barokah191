@extends('layouts.app')

@section('title', 'Belanja Produk')

@section('content')

<style>
    /* ============================
       GRID 5 KOLOM PRODUK
       ============================ */
    @media (min-width: 1200px) {
        .product-col {
            width: 20% !important; /* 100 / 5 = 20% */
        }
    }
    /* ============================
       CARD STYLE
       ============================ */
    .product-card {
        border-radius: 12px;
        overflow: hidden;
        transition: 0.2s;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .product-card img {
        height: 150px;
        object-fit: cover;
    }
</style>

<div class="container my-4">

    <h2 class="fw-bold mb-4">Belanja Produk</h2>

    <div class="row g-3">

        @foreach ($products as $product)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 product-col">
            <div class="card h-100 shadow-sm product-card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-semibold mb-1">{{ $product->name }}</h6>
                    <p class="mt-2 mb-1"><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p class="fw-bold text-success mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- Tombol beli --}}
                    <a href="#" class="btn btn-primary btn-sm mt-auto w-100"
                    onclick="event.preventDefault(); document.getElementById('beli-form-{{ $product->id }}').submit();">
                    Beli
                    </a>

                    <form id="beli-form-{{ $product->id }}" action="{{ route('belanja.beli', $product->id) }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                    </form>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>

@endsection
