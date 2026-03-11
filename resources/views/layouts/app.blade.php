<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Dashboard Toko Barokah 191</title>

    {{-- GOOGLE FONT: INTER (Modern) --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- BOOTSTRAP CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- BOOTSTRAP ICONS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Global Font */
        body, html, .navbar, .btn, .form-control, .table, .nav-link, h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif !important;
        }

        body {
            background-color: #ffffff;
        }

        .navbar-dark {
            background-color: #0d5e3a !important;
        }

        .custom-navbar {
            padding-top: 0.85rem !important;
            padding-bottom: 0.85rem !important;
        }

        .nav-link {
            font-weight: 500;
        }

        .nav-link.active {
            font-weight: 700 !important;
            color: #fff !important;
        }

        .content-wrapper {
            padding: 35px 10px;
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('guest.dashboard') }}">
                Toko Barokah 191
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    @auth
                        {{-- ADMIN --}}
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                   href="{{ route('admin.dashboard') }}">
                                   Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}"
                                   href="{{ route('products.index') }}">
                                   Produk
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}"
                                   href="{{ route('orders.index') }}">
                                   Pesanan
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif

                        {{-- USER --}}
                        @if(Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}"
                                   href="{{ route('user.dashboard') }}">
                                   Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                                   href="{{ route('cart.index') }}">
                                   <i class="bi bi-cart4"></i> Keranjang
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('belanja*') ? 'active' : '' }}"
                                   href="{{ route('belanja.index') }}">
                                   Belanja
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('orders') ? 'active' : '' }}"
                                   href="{{ route('orders.index') }}">
                                   Pesanan Saya
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}"
                                   href="{{ route('user.profile') }}">
                                   Profil
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif

                    @else
                        {{-- GUEST --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                               href="{{ route('guest.dashboard') }}">
                               Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">Pesanan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <div class="content-wrapper container">
        @yield('content')
    </div>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- EXTRA SCRIPTS --}}
    @stack('scripts')
    @yield('scripts')
</body>
</html>
