@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Pesanan Saya</h1>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center fw-semibold">
                                {{ $order->product->name }}
                            </td>

                            <td class="text-center">
                                {{ $order->quantity }}
                            </td>

                            <td class="text-center fw-bold text-success">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            <td class="text-center">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        Pending
                                    </span>
                                @elseif($order->status == 'dibayar')
                                    <span class="badge bg-info px-3 py-2 rounded-pill">
                                        Dibayar
                                    </span>
                                @elseif($order->status == 'diproses')
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        Diproses
                                    </span>
                                @elseif($order->status == 'selesai')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        Selesai
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($order->status == 'pending')
                                    <a href="{{ route('orders.checkout', $order->id) }}" 
                                        class="btn btn-success btn-sm px-3 rounded-pill">
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill" disabled>
                                        Tidak Ada Aksi
                                    </button>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
