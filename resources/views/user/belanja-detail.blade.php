@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Gambar Produk --}}
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid rounded" alt="No Image">
            @endif
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-7">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">Kategori: {{ $product->category->name ?? 'Tidak ada' }}</p>
            <p class="mt-3">{{ $product->description }}</p>
            <p class="fw-bold fs-4">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <form action="{{ route('belanja.beli', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control w-25" value="1" min="1" required>
                </div>
                <button type="submit" class="btn btn-success btn-lg">Beli & Checkout</button>
            </form>
        </div>
    </div>

    {{-- Info Tambahan --}}
    <div class="mt-5">
        <h5>Informasi Produk:</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Stok: {{ $product->stock ?? 'N/A' }}</li>
            <li class="list-group-item">Berat: {{ $product->weight ?? 'N/A' }} gram</li>
            <li class="list-group-item">Kode Produk: {{ $product->sku ?? '-' }}</li>
        </ul>
    </div>
</div>
@endsection
