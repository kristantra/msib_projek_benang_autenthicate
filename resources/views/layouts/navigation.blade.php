<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/7adbf01c7f.js" crossorigin="anonymous"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

         <!-- Fonts -->
         <link rel="preconnect" href="https://fonts.bunny.net">
         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 
         <style>
            html, body {
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
    
            main {
                flex-grow: 1;
            }
    
            footer {
                flex-grow: 0;
                flex-shrink: 0;
            }
        </style>
         <!-- Scripts -->
       
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Logo
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}" {{ request()->routeIs('dashboard') ? 'active' : '' }}>
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/product') }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tentang Kami</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="mt-auto py-3 border-top text-center" style="border-color: rgba(0,0,0,0.1); font-family: 'Figtree', serif;">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Menu -->
                <div class="col-md-4 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="link-secondary" href="{{ route('dashboard') }}">Beranda</a></li>
                        <li><a class="link-secondary" href="#">Produk</a></li>
                        <li><a class="link-secondary" href="#">Tentang Kami</a></li>
                    </ul>
                </div>
    
                <!-- Customer Service -->
                <div class="col-md-4 mb-4">
                    <h5>Pelayanan Pelanggan</h5>
                    <p>Senin-Jumat 08.00-16.00</p>
                    <a href="https://wa.me/your_number" class="link-secondary">
                        <i class="fab fa-whatsapp"></i> Chat Kami di WhatsApp
                    </a>
                </div>
    
                <!-- Social Media -->
                <div class="col-md-4 mb-4">
                    <h5>Media Sosial</h5>
                    <ul class="list-unstyled">
                        <li><i class="fab fa-instagram"></i> <a href="https://instagram.com/your_username" class="link-secondary">Instagram</a></li>
                        <li><i class="fas fa-store"></i> <a href="https://www.tokopedia.com/your_store" class="link-secondary">Tokopedia</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    
    
    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>
</html>
