@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Your Recommended Gifts</h2>
        <p class="text-muted">We've found these perfect gifts based on your selection.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col product-item">
                <div class="card h-100 product-card border-0 shadow-sm rounded-3 overflow-hidden">
                    {{-- Product Image Link --}}
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ asset('images/' . $product->image) }}" 
                             class="card-img-top" 
                             style="height: 230px; object-fit: cover;" 
                             alt="{{ $product->name }}">
                    </a>
                    
                    <div class="card-body text-center p-3">
                        <h5 class="card-title fw-bold text-dark product-title">{{ $product->name }}</h5>
                        <h6 class="text-danger fw-bold mb-3">Rs. {{ number_format($product->price) }}</h6>
                        
                        {{-- Add to Cart Form --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-100 mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">Add to Cart 🛒</button>
                        </form>

                        {{-- Add to Wishlist Form --}}
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">Add to Wishlist 💖</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-light rounded-3 shadow-sm">
                    <h4 class="text-muted">Sorry, no gifts found for this choice! 🔍</h4>
                    <p class="mb-4">Try selecting different options in the Gift Finder.</p>
                    <a href="{{ route('quiz.index') }}" class="btn btn-primary px-4">Back to Gift Finder</a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection