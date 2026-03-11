@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 700px;">

        {{-- Header Banner --}}
        <div class="bg-primary" style="height: 140px; position: relative;">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.2);"></div>
        </div>

        {{-- Foto & Info User --}}
        <div class="text-center p-4 position-relative" style="margin-top: -80px;">

            {{-- Foto Profil --}}
            <img 
                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
                class="rounded-circle border border-3 border-white shadow"
                width="130"
                height="130"
                style="object-fit: cover;"
                alt="Foto Profil">

            {{-- Nama --}}
            <h3 class="fw-bold mt-3">{{ Auth::user()->name }}</h3>

            {{-- Email --}}
            <p class="text-muted small">{{ Auth::user()->email }}</p>

            {{-- Tombol Edit --}}
            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-2 px-4">
                Edit Profil
            </a>
        </div>

        {{-- Informasi Akun --}}
        <div class="p-4 border-top">

            <h5 class="fw-bold text-center mb-4">Informasi Akun</h5>

            <div class="row g-3">

                {{-- Nama --}}
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border d-flex align-items-start">
                        <i class="bi bi-person-fill text-primary fs-4 me-3"></i>
                        <div>
                            <p class="text-muted small mb-0">Nama</p>
                            <p class="fw-semibold mb-0">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border d-flex align-items-start">
                        <i class="bi bi-envelope-fill text-success fs-4 me-3"></i>
                        <div>
                            <p class="text-muted small mb-0">Email</p>
                            <p class="fw-semibold mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Bergabung --}}
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border d-flex align-items-start">
                        <i class="bi bi-clock-history text-warning fs-4 me-3"></i>
                        <div>
                            <p class="text-muted small mb-0">Bergabung</p>
                            <p class="fw-semibold mb-0">{{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Status Akun --}}
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-danger fs-4 me-3"></i>
                        <div>
                            <p class="text-muted small mb-0">Status Akun</p>
                            <p class="fw-semibold mb-0">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
