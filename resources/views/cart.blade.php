@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-dark mb-4">Your Shopping Cart 🛒</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded border">
                                                <span class="fw-bold text-dark">{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Rs. {{ number_format($details['price']) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="action" value="decrease">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary px-2">-</button>
                                                </form>
                                                <span class="badge bg-light text-dark border px-3 py-2 fs-6">{{ $details['quantity'] }}</span>
                                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="action" value="increase">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary px-2">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-danger fw-bold">Rs. {{ number_format($details['price'] * $details['quantity']) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove 🗑️</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-end mb-4">
                <h3 class="fw-bold">Grand Total: <span class="text-danger">Rs. {{ number_format($total) }}</span></h3>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('checkout.index') }}" 
                       class="btn btn-lg px-5 py-3 shadow text-white fw-bold" 
                       style="background-color: #d63384; border-radius: 30px; border: none; text-decoration: none;">
                       Proceed to Checkout 🚀
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5 bg-white shadow-sm rounded-3">
            <p class="text-muted fs-4 mb-3">Your cart is empty! 🎁</p>
            <a href="{{ url('/') }}" class="btn text-white px-4 py-2" style="background-color: #d63384; border-radius: 30px; text-decoration: none;">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection