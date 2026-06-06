@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-dark mb-4">Your Wishlist 💖</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($wishlist) && count($wishlist) > 0)
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($wishlist as $id => $details)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden text-center p-3">
                        <img src="{{ asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}" style="height: 200px; object-fit: cover;" class="card-img-top rounded">
                        <div class="card-body d-flex flex-column justify-content-between px-1">
                            <div>
                                <h5 class="card-title fw-bold text-dark mt-2 mb-1">{{ $details['name'] }}</h5>
                                <h6 class="text-danger fw-bold mb-3">Rs. {{ number_format($details['price']) }}</h6>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <form action="{{ route('cart.add', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-custom btn-sm w-100 fw-bold">Add to Cart 🛒</button>
                                </form>

                                <form action="{{ route('wishlist.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">Remove 🗑️</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5 bg-white shadow-sm rounded-3">
            <p class="text-muted fs-4 mb-3">Your wishlist is empty! ✨</p>
            <a href="{{ url('/') }}" class="btn btn-custom px-4">Explore Products</a>
        </div>
    @endif
</div>
@endsection