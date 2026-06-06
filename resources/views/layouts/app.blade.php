<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftoraa.pk - Online Gift Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #d63384; --secondary-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: var(--primary-color) !important; font-size: 1.5rem; }
        .nav-icon-link { font-size: 1.2rem; text-decoration: none; transition: opacity 0.2s; }
        .nav-icon-link:hover { opacity: 0.8; }
        footer { background-color: #212529; color: white; padding: 20px 0; }
        
        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                margin-top: 10px;
                max-height: 70vh;
                overflow-y: auto;
            }
            .mx-auto.w-50 { width: 100% !important; margin: 10px 0 !important; }
            .navbar-nav { align-items: flex-start !important; }
        }
  
    .btn-pink {
        background-color: #d63384; /* Aapka pink color */
        color: white;
        border-radius: 50px;      /* Fully rounded corners */
        padding: 10px 25px;
        border: none;
        transition: all 0.3s ease; /* Smooth animation */
        font-weight: bold;
    }

    .btn-pink:hover {
        background-color: #b02a66; /* Thoda dark pink on hover */
        transform: scale(1.05);    /* Button thoda bada hoga hover par */
        color: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    </style>
</head>
<body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Giftoraa.pk</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Search Bar --}}
                @if(!Request::is('login') && !Request::is('register'))
                    <form class="d-flex mx-auto w-50" action="{{ route('home') }}" method="GET">
                        <input type="hidden" name="category" value="{{ request('category', 'All') }}">
                        <input class="form-control me-2 rounded-pill" type="text" name="search" placeholder="Search perfect gifts..." value="{{ request('search') }}">
                        <button class="btn btn-outline-danger rounded-pill" type="submit">Search</button>
                    </form>
                @endif

                <ul class="navbar-nav ms-auto align-items-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ url('/') }}">Home</a></li>
                    
                    @if(!Request::is('login') && !Request::is('register'))
                        <li class="nav-item"><a class="nav-link p-1 nav-icon-link" href="{{ route('wishlist.index') }}">💖</a></li>
                        <li class="nav-item"><a class="nav-link p-1 nav-icon-link" href="{{ route('cart.index') }}">🛒</a></li>
                    @endif
                    
                    @guest
                        @if (Route::has('login')) <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('login') }}">Login</a></li> @endif
                        @if (Route::has('register')) <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('register') }}">Sign Up</a></li> @endif
                    @else
                        @if(!Request::is('login') && !Request::is('register'))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                                    👋 {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    @if(Auth::user()->is_admin == 1)
                                        <a class="dropdown-item fw-bold text-primary" href="{{ route('admin.products.index') }}">⚙️ Manage Products</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 flex-grow-1 mb-5">
        @yield('content')
    </div>

    <footer class="text-center mt-auto">
        <p class="mb-0">&copy; 2026 Giftoraa.pk - All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>