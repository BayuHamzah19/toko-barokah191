@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
    
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white shadow p-4 rounded">Total Produk: {{ $totalProducts }}</div>
        <div class="bg-white shadow p-4 rounded">Total Pesanan: {{ $totalOrders }}</div>
        <div class="bg-white shadow p-4 rounded">Pendapatan: Rp {{ number_format($totalRevenue) }}</div>
    </div>
    
    <div class="mt-6">
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</a>
    </div>
</div>
@endsection
