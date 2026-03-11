@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-2">Nama Produk</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Harga</label>
            <input type="number" name="price" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok Produk</label>
            <input type="number" name="stock" id="stock" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="border p-2 w-full"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Gambar Produk</label>
            <input type="file" name="image" class="border p-2 w-full" accept="image/*" required>
        </div>

       <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
