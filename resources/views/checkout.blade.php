@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1100px;">

    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="row g-5">
            
            <div class="col-lg-7">
                <h2 class="fw-bold mb-4" style="color: #c2185b; font-family: 'Georgia', serif;">Giftoraa.pk</h2>
                
                <div class="mb-4">
                    <h5 class="fw-bold mb-3 text-dark">Contact</h5>
                    <input type="text" name="contact" class="form-control py-3 rounded-3 shadow-sm @error('contact') is-invalid @enderror" placeholder="Email or mobile phone number (e.g., 03XXXXXXXXX)" value="{{ old('contact') }}" required>
                    
                    @error('contact')
                        <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                    @enderror
                    <div class="form-text text-muted small mt-1">We will use this email or mobile number to send your order updates.</div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3 text-dark">Delivery</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <select class="form-select py-3 rounded-3 bg-white border shadow-sm" name="country" required>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control py-3 rounded-3 shadow-sm @error('first_name') is-invalid @enderror" placeholder="First name" value="{{ old('first_name') }}" pattern="[A-Za-z\s]+" required>
                            @error('first_name')
                                <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control py-3 rounded-3 shadow-sm @error('last_name') is-invalid @enderror" placeholder="Last name" value="{{ old('last_name') }}" pattern="[A-Za-z\s]+" required>
                            @error('last_name')
                                <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <input type="text" name="address" class="form-control py-3 rounded-3 shadow-sm @error('address') is-invalid @enderror" placeholder="Address (House#, Street, Area)" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <input type="text" name="apartment" class="form-control py-3 rounded-3 shadow-sm" placeholder="Apartment, suite, etc. (optional)" value="{{ old('apartment') }}">
                        </div>
                        
                        <div class="col-md-6">
                            <input type="text" name="city" class="form-control py-3 rounded-3 shadow-sm @error('city') is-invalid @enderror" placeholder="City" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <input type="text" name="postal_code" class="form-control py-3 rounded-3 shadow-sm" placeholder="Postal code (optional)" value="{{ old('postal_code') }}">
                        </div>
                        
                        <div class="col-12">
                            <input type="tel" name="phone" class="form-control py-3 rounded-3 shadow-sm @error('phone') is-invalid @enderror" placeholder="Phone Number (e.g., 03XXXXXXXXX)" value="{{ old('phone') }}" pattern="[0-9]{11}" required>
                            @error('phone')
                                <div class="invalid-feedback fw-bold mt-1">❌ {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="saveInfo" name="save_info">
                        <label class="form-check-label text-muted small" for="saveInfo">
                            Save this information for next time
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3 text-dark">Shipping method</h5>
                    <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center shadow-sm">
                        <span class="text-secondary fw-semibold">Shipping Charges</span>
                        <span class="fw-bold text-dark">Rs 300.00</span>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-1 text-dark">Payment</h5>
                    <p class="text-muted small mb-3">All transactions are secure and encrypted.</p>
                    
                    <div class="border rounded-3 overflow-hidden shadow-sm">
                        <div class="p-3 bg-light border-bottom fw-bold text-dark" style="background-color: #f1f3f5 !important;">
                            Cash on Delivery (COD)
                        </div>
                        <div class="p-4 bg-white">
                            <p class="fw-bold text-dark text-center mb-3" style="letter-spacing: 0.5px;">PLEASE PLACE YOUR ORDER ONLY IF YOU ARE 100% SURE TO RECEIVE IT</p>
                            <p class="text-dark small mb-3 text-center" style="line-height: 1.6;">We offer full Cash on Delivery (COD) for your convenience. However, when an order is refused at delivery, returning shipments incur double losses for us due to return courier fees and wasted packaging materials.</p>
                            <p class="text-muted small text-center mb-0" style="line-height: 1.6; font-style: italic;">
                                Being a small business, it is highly challenging for us to absorb these return losses. Therefore, please only confirm your order if you are fully certain and available to receive it. <span class="fw-bold text-danger">YOUR HONESTY HELPS US GROW!</span> Thank you for your understanding and for supporting my small business ❤️
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3 text-dark">Billing address</h5>
                    <div class="border rounded-3 overflow-hidden shadow-sm bg-white">
                        <div class="p-3 border-bottom d-flex align-items-center">
                            <input class="form-check-input me-3" type="radio" name="billing_option" id="sameAddress" value="same" checked required>
                            <label class="form-check-label text-dark fw-semibold" for="sameAddress">Same as shipping address</label>
                        </div>
                        <div class="p-3 d-flex align-items-center">
                            <input class="form-check-input me-3" type="radio" name="billing_option" id="differentAddress" value="different" required>
                            <label class="form-check-label text-dark fw-semibold" for="differentAddress">Use a different billing address</label>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold rounded-3 shadow" style="background-color: #007bff; border: none; font-size: 1.2rem;">
                        Complete order
                    </button>
                    
                    <a href="{{ route('home', ['action' => 'cancelled']) }}" class="btn btn-outline-danger btn-lg py-3 fw-bold rounded-3 transition-all" style="font-size: 1.1rem;">
                        Cancel Order ❌
                    </a>
                </div>
                
                <hr class="mt-5">
                <div class="text-center text-md-start">
                    <a href="#" class="text-primary small text-decoration-none fw-semibold">Privacy policy</a>
                </div>
            </div>

            <div class="col-lg-5 p-4 rounded-4 shadow-sm border bg-white h-100 sticky-lg-top" style="top: 100px; background-color: #fdfdfd !important;">
                <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Order summary</h5>
                
                @php $subtotal = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $subtotal += $details['price'] * $details['quantity']; @endphp
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom border-light">
                        <div class="d-flex align-items-center gap-3">
                            <div class="position-relative">
                                <img src="{{ asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 65px; height: 65px; object-fit: cover;" class="rounded border shadow-sm">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary shadow-sm" style="font-size: 0.75rem;">
                                    {{ $details['quantity'] }}
                                </span>
                            </div>
                            <div>
                                <span class="fw-bold small text-dark d-block">{{ $details['name'] }}</span>
                            </div>
                        </div>
                        <span class="small fw-bold text-dark">Rs {{ number_format($details['price'] * $details['quantity']) }}.00</span>
                    </div>
                @endforeach

                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Subtotal</span>
                        <span class="fw-bold text-dark small">Rs {{ number_format($subtotal) }}.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">Shipping</span>
                        <span class="fw-bold text-dark small">Rs 300.00</span>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-dark mb-0">Total</h4>
                        <div class="text-end">
                            <small class="text-muted fw-semibold" style="font-size: 0.75rem;">PKR</small>
                            <h3 class="fw-bold d-inline ms-1 text-dark mb-0" style="font-size: 1.6rem;">Rs {{ number_format($subtotal + 300) }}.00</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. 🎉 SUCCESS POPUP ENGINE: Check session triggers
    @if(session('success') || session('order_success'))
        Swal.fire({
            title: 'Ordered Successfully! 🎉',
            text: 'Your beautiful gift order has been locked in. Giftoraa.pk will contact you soon!',
            icon: 'success',
            confirmButtonColor: '#d63384',
            background: '#fff0f5',
            timer: 5500
        });
    @endif

    // 2. 🚫 CANCEL POPUP ENGINE: Check url action params
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('action') === 'cancelled') {
        Swal.fire({
            title: 'Order Cancelled! 🚫',
            text: 'The checkout process was cancelled. You can continue shopping anytime!',
            icon: 'info',
            confirmButtonColor: '#6c757d',
            timer: 4500
        });
        
        // Dynamic clean up URL query string state smoothly without page reloading
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
<a href="{{ route('order.cancel') }}" class="btn btn-outline-danger">Cancel Order ❌</a>
</script>
@endsection