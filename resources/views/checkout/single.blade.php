@extends('layouts.app')

@section('title', 'Checkout Produk')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-4">Checkout Produk</h2>

    <div class="row g-4">

        <!-- Detail Produk -->
        <div class="col-md-7">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Produk yang Dibeli</h5>

                <div class="d-flex align-items-center border rounded p-3">
                    <img src="{{ asset('storage/' . $cartItem->product->image) }}" 
                         width="90" class="rounded me-3">

                    <div>
                        <h6 class="fw-semibold">{{ $cartItem->product->name }}</h6>
                        <p class="text-muted m-0">Jumlah: {{ $cartItem->quantity }}</p>
                        <p class="fw-bold text-dark mt-1">
                            Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="col-md-5">
            <div class="card shadow-sm p-4">

                <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>

                <p class="d-flex justify-content-between">
                    <span>Harga Satuan</span>
                    <span>Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}</span>
                </p>

                <p class="d-flex justify-content-between">
                    <span>Jumlah</span>
                    <span>{{ $cartItem->quantity }}</span>
                </p>

                <hr>

                <p class="d-flex justify-content-between fs-5 fw-bold">
                    <span>Total Bayar</span>
                    <span>
                        Rp {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                    </span>
                </p>

                <button class="btn btn-success w-100 mt-3">
                    Bayar Sekarang
                </button>
            </div>
        </div>

    </div>

</div>
@endsection
