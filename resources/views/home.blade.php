@extends('layouts.app')

@section('content')
{{-- Shop Collection Navbar --}}
<div class="w-100 border-bottom mb-4 bg-white shadow-sm overflow-auto rounded-3" id="shop-collection">
    <div class="container">
        <ul class="nav d-flex justify-content-start justify-content-md-center align-items-center py-2 text-nowrap">
            <li class="nav-item"><a href="{{ route('home', ['category' => 'All']) }}" class="nav-link px-3 fw-semibold {{ $category == 'All' || !$category ? 'text-danger' : 'text-dark' }}">All Products</a></li>
            <li class="nav-item"><a href="{{ route('home', ['category' => 'Bouquets']) }}" class="nav-link px-3 fw-semibold {{ $category == 'Bouquets' ? 'text-danger' : 'text-dark' }}">Bouquets</a></li>
            <li class="nav-item"><a href="{{ route('home', ['category' => 'Perfumes']) }}" class="nav-link px-3 fw-semibold {{ $category == 'Perfumes' ? 'text-danger' : 'text-dark' }}">Perfumes</a></li>
            <li class="nav-item"><a href="{{ route('home', ['category' => 'Gift Hampers']) }}" class="nav-link px-3 fw-semibold {{ $category == 'Gift Hampers' ? 'text-danger' : 'text-dark' }}">Gift Hampers</a></li>
            <li class="nav-item"><a href="{{ route('home', ['category' => 'Accessories']) }}" class="nav-link px-3 fw-semibold {{ $category == 'Accessories' ? 'text-danger' : 'text-dark' }}">Accessories</a></li>
            <li class="nav-item"><a href="{{ route('home', ['category' => 'Teddy Bear']) }}" class="nav-link px-3 fw-semibold {{ $category == 'Teddy Bear' ? 'text-danger' : 'text-dark' }}">Teddy Bear</a></li>
        </ul>
    </div>
</div>

{{-- Hero Banner --}}
@if(request()->is('/'))
<div class="row align-items-center mb-5 rounded-3 p-4 p-md-5 mx-0" id="heroBanner" style="background-color: #ffe4e1; min-height: 350px;">
    <div class="col-md-6 text-center text-md-start ps-md-5 ms-md-4">
        <h1 class="display-4 fw-bold" style="color: #c2185b; font-family: 'Georgia', serif;">Giftoraa.pk</h1>
        <p class="fs-4 text-dark mb-1">NOW OPEN!</p>
        <p class="fs-5 text-muted italic-text" style="font-style: italic;">Pretty gifts for pretty souls</p>
    </div>
    <div class="col-md-5 text-center mt-4 mt-md-0">
        <img src="{{ asset('images/pic.png') }}" alt="Giftoraa" class="img-fluid rounded-3" style="width: auto; max-width: 70%; height: auto;">
    </div>
</div>

{{-- AI Gift Finder Banner --}}
<div class="container mb-5">
    <div class="row align-items-center p-4 rounded-3 shadow-sm" style="background-color: #c2185b; color: white;">
        <div class="col-md-8 text-center text-md-start">
            <h3 class="fw-bold">Confused about what to gift?</h3>
            <p class="mb-0">Use our AI-powered Gift Finder to find the perfect present in seconds!</p>
        </div>
        <div class="col-md-4 text-center mt-3 mt-md-0">
            <a href="{{ route('quiz.index') }}" class="btn btn-light fw-bold px-4" style="color: #c2185b;">Try Gift Finder 🎁</a>
        </div>
    </div>
</div>
@endif

{{-- Product List --}}
<div class="container px-0" id="productList">
    <h2 class="mb-4 text-center fw-bold text-dark" id="pageHeading">
        {{ $category && $category != 'All' ? $category : 'Our Featured Gifts ✨' }}
    </h2>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($products as $product)
            <div class="col product-item">
                <div class="card h-100 product-card border-0 shadow-sm rounded-3 overflow-hidden">
                    <a href="{{ route('product.show', $product->id) }}"><img src="{{ asset('images/' . $product->image) }}" class="card-img-top" style="height: 230px; object-fit: cover;"></a>
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold text-dark product-title">{{ $product->name }}</h5>
                        <h6 class="text-danger fw-bold">Rs. {{ number_format($product->price) }}</h6>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-100 mb-2">
                            @csrf
                            <button type="submit" class="btn btn-custom btn-sm w-100 fw-bold">Add to Cart 🛒</button>
                        </form>

                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm w-100">Add to Wishlist 💖</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products found!</p>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status === 'success') {
        Swal.fire({ title: 'Ordered Successfully! 🎉', icon: 'success', confirmButtonColor: '#d63384' });
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    if (status === 'cancelled') {
        Swal.fire({ title: 'Order Cancelled! 🚫', icon: 'info', confirmButtonColor: '#6c757d' });
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
</script>
@endsection