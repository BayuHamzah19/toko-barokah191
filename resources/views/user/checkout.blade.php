@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="container py-4">

    <h2 class="fw-bold mb-4">💳 Checkout Pembayaran</h2>

    {{-- ===============================
        CEK SUMBER DATA (cart / order)
    ================================= --}}
    @php
        $productName = $cartItem->product->name ?? $order->product->name;
        $productImage = $cartItem->product->image ?? $order->product->image;
        $quantity = $cartItem->quantity ?? $order->quantity;
        $totalPrice = ($cartItem->product->price ?? $order->product->price) * $quantity;
    @endphp

    <div class="row g-4">

        {{-- ============================
             BAGIAN PRODUK
        ============================= --}}
        <div class="col-md-7">
            <div class="card shadow-sm p-4">

                <h5 class="fw-bold mb-3">Produk yang Dibeli</h5>

                <div class="d-flex align-items-center border rounded p-3 mb-2">

                    <img src="{{ asset('storage/' . $productImage) }}"
                         width="100" class="rounded me-3">

                    <div>
                        <h6 class="fw-semibold mb-1">{{ $productName }}</h6>
                        <p class="m-0 text-muted">Jumlah: {{ $quantity }}</p>
                        <p class="fw-bold mt-1">
                            Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ============================
             BAGIAN RINGKASAN
        ============================= --}}
        <div class="col-md-5">
            <div class="card shadow-sm p-4">

                <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>

                <p class="d-flex justify-content-between">
                    <span>Produk</span>
                    <span>{{ $productName }}</span>
                </p>

                <p class="d-flex justify-content-between">
                    <span>Jumlah</span>
                    <span>{{ $quantity }}</span>
                </p>

                <hr>

                <p class="d-flex justify-content-between fs-5 fw-bold">
                    <span>Total Bayar</span>
                    <span>
                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                    </span>
                </p>

                <button id="pay-button" class="btn btn-success w-100 mt-3">
                    Bayar Sekarang
                </button>

            </div>
        </div>

    </div>

</div>


{{-- MIDTRANS SNAP SCRIPT --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
    document.getElementById('pay-button').onclick = function () {

        snap.pay('{{ $snapToken }}', {

            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('orders.index') }}";
            },
            onPending: function(result){
                alert("Pembayaran sedang menunggu.");
            },
            onError: function(result){
                alert("Pembayaran gagal.");
            }

        });

    }
</script>

@endsection
