@extends('layouts.app')

@section('content')
<style>
    .btn-custom-pink {
        background-color: #d63384;
        color: white;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .btn-custom-pink:hover {
        background-color: #c2185b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(194, 24, 91, 0.2);
    }
    .btn-outline-wishlist {
        border: 2px solid #ced4da;
        color: #6c757d;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .btn-outline-wishlist:hover {
        border-color: #d63384;
        color: #d63384;
        background-color: #fff0f5;
        transform: translateY(-2px);
    }
    .qty-btn {
        border: 1px solid #ced4da;
        background-color: #fff;
        color: #495057;
        transition: background 0.2s;
    }
    .qty-btn:hover {
        background-color: #f8f9fa;
        color: #d63384;
    }
</style>

<div class="container mt-5">
    <div class="row g-5">
        <div class="col-md-6 text-center">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}" style="max-height: 450px; object-fit: cover; width: 100%;">
            </div>
        </div>

        <div class="col-md-6">
            <span class="text-muted small sk-category fw-bold text-uppercase d-block mb-2" style="color: #d63384 !important; letter-spacing: 1px;">
                {{ $product->category }}
            </span>
            
            <h1 class="fw-bold text-dark mb-3" style="font-family: 'Georgia', serif;">{{ $product->name }}</h1>
            
            <h3 class="fw-bold mb-4" style="color: #c2185b;">Rs. {{ number_format($product->price) }}</h3>
            
            <hr class="text-muted my-4">

            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-3">Product Details ✨</h5>
                <p class="text-muted lh-base" style="font-size: 0.95rem;">
                    @if($product->description)
                        {!! nl2br(e($product->description)) !!}
                    @else
                        This is a premium quality beautiful gift from Giftoraa.pk, perfect for making your special ones smile and creating everlasting beautiful memories.
                    @endif
                </p>
                
                <div class="mt-3">
                    @if($product->stock > 0)
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                            <strong>Available Stock:</strong> {{ $product->stock }} items left
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                            Out of Stock 🚫
                        </span>
                    @endif
                </div>
            </div>

            <hr class="text-muted my-4">

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                
                <div class="d-flex align-items-center mb-4">
                    <span class="fw-bold text-dark me-3">Quantity:</span>
                    <div class="input-group shadow-sm rounded" style="width: 140px; overflow: hidden;">
                        <button class="btn qty-btn fw-bold" type="button" onclick="decreaseQty()">-</button>
                        <input type="number" id="quantityInput" name="quantity" class="form-control text-center fw-bold border-start-0 border-end-0" value="1" min="1" max="{{ $product->stock }}" readonly style="box-shadow: none; background: #fff;">
                        <button class="btn qty-btn fw-bold" type="button" onclick="increaseQty()">+</button>
                    </div>
                </div>

                <div class="d-grid gap-3 d-md-flex">
                    <button type="submit" class="btn btn-custom-pink btn-lg px-5 fw-bold flex-grow-1" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        Add to Cart 🛒
                    </button>
            </form>

            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="flex-grow-1">
                @csrf
                <button type="submit" class="btn btn-outline-wishlist btn-lg w-100 fw-semibold">
                    Add to Wishlist 💖
                </button>
            </form>
            </div>

            <div class="mt-4 pt-2">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted fw-semibold" style="font-size: 0.95rem;">
                    ← Back to Shop Collection
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function increaseQty() {
    let input = document.getElementById('quantityInput');
    let max = parseInt(input.getAttribute('max')) || 100;
    let current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQty() {
    let input = document.getElementById('quantityInput');
    let current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
    }
}
</script>
@endsection