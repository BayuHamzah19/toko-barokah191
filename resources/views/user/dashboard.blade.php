@extends('layouts.app')

@section('title', 'Belanja')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboarduser.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<div class="container mt-4">

    <h2 class="section-title text-center mb-4">Produk Terbaru</h2>

    @php
        $latestProducts = $products->sortByDesc('created_at')->take(3)->values();
    @endphp

    @if($latestProducts->count() > 0)
        <div class="swiper latest-products-swiper mb-5">
            <div class="swiper-wrapper">
                @foreach($latestProducts as $product)
                    <div class="swiper-slide">
                        <a href="{{ route('belanja.show', $product->id) }}" 
                           class="card text-center shadow-sm"
                           style="text-decoration: none; color: inherit; cursor: pointer;">

                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="card-img-top"
                                style="height: 350px; object-fit: cover; border-radius: 8px 8px 0 0;"
                                alt="{{ $product->name }}">

                            <div class="card-body position-absolute bottom-0 start-0 p-3 text-start"
                                style="
                                    background: rgba(0,0,0,0.45);
                                    width: 100%;
                                    backdrop-filter: blur(2px);
                                    border-radius: 0 0 8px 8px;
                                ">
                                <h4 class="card-title text-white mb-1">{{ $product->name }}</h4>
                                <p class="card-text text-white mb-0">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>  
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    @endif

    {{-- SEARCH + FILTER + SORT --}}
    <form action="{{ route('belanja.index') }}" method="GET" class="row mb-4 g-2">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">Urutkan</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Paling Baru</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-success w-100">Terapkan</button>
        </div>
    </form>

    {{-- LIST PRODUK --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-5">
                <div class="card product-card">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="product-image w-100"
                         style="height: 200px; object-fit: cover;"
                         alt="{{ $product->name }}">

                    <div class="card-body">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-muted mb-1">Stok: {{ $product->stock }}</p>

                        <a href="{{ route('belanja.show', $product->id) }}"
                           class="btn btn-primary w-100 mt-2 mb-2">
                            Lihat Detail
                        </a>

                        {{-- FORM TAMBAH KE KERANJANG --}}
                        <form action="{{ route('belanja.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success w-100">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada produk yang tersedia.</p>
        @endforelse
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.latest-products-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>

@endsection
