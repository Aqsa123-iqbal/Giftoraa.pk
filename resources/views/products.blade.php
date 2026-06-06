@extends('layouts.app')

@section('content')
<style>
    body { background: #FFF8F6; font-family: Arial, sans-serif; margin: 0; padding-bottom: 80px; }
    .shop-container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
    .page-title { text-align: center; color: #7A1E2C; margin-bottom: 20px; font-size: 28px; font-weight: bold; }
    
    /* Search Bar */
    .search-wrapper { display: flex; justify-content: center; margin-bottom: 30px; }
    .shop-search { width: 100%; max-width: 500px; padding: 12px 20px; border: 2px solid #d63384; border-radius: 25px; outline: none; }

    /* Products Grid */
    .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; }
    .product-card { background: white; border-radius: 20px; padding: 20px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.3s; }
    .product-card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
    .product-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 15px; }
    
    /* Pink Button Style */
    .custom-pink-btn {
        background-color: #d63384 !important;
        color: #ffffff !important;
        border: 2px solid #d63384 !important;
        padding: 10px 20px !important;
        border-radius: 30px !important;
        font-weight: bold !important;
        cursor: pointer !important;
        transition: all 0.4s ease !important;
        display: block !important;
        width: 100% !important;
        text-decoration: none !important;
        text-align: center !important;
    }

    .custom-pink-btn:hover {
        background-color: #ffffff !important;
        color: #d63384 !important;
        transform: scale(1.05) !important;
        box-shadow: 0 8px 20px rgba(214, 51, 132, 0.4) !important;
    }

    .btn-wish { background: #f8f9fa; border: 1px solid #ddd; padding: 10px 15px; border-radius: 50%; transition: 0.3s; }
    .btn-wish:hover { background: #ffebee; border-color: #d63384; }

    .bottom-nav { position: fixed; bottom: 0; left: 0; width: 100%; display: flex; justify-content: space-around; background: white; padding: 15px 0; box-shadow: 0 -2px 10px rgba(0,0,0,0.1); z-index: 1000; }
</style>

<div class="shop-container">
    <h2 class="page-title">Giftoraa Shop 🎁</h2>

    <div class="search-wrapper">
        <input type="text" id="searchInput" class="shop-search" placeholder="Search products..." onkeyup="searchProducts()">
    </div>

    <div class="products-grid" id="productList">
        @forelse($products as $product)
            <div class="product-card">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="price" style="color: #7A1E2C; font-weight: bold;">Rs. {{ number_format($product->price) }}</p>
                
                <div class="btn-group" style="display: flex; gap: 10px;">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: flex; flex: 1; margin: 0;">
                        @csrf
                        <button type="submit" class="custom-pink-btn" style="background-color: #d63384 !important; color: white !important;">
                            Add to Cart 🛒
                        </button>
                    </form>
                    
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-wish">❤️</button>
                    </form>
                </div>
            </div>
        @empty
            <h3 style="text-align: center; width: 100%; color: #666;">No products found!</h3>
        @endforelse
    </div>
</div>

<div class="bottom-nav">
    <a href="{{ url('/') }}" style="text-decoration:none; color:black;">Shop</a>
    <a href="{{ url('/wishlist') }}" style="text-decoration:none; color:black;">Wishlist</a>
    <a href="{{ url('/cart') }}" style="text-decoration:none; color:black;">Cart</a>
    <a href="{{ url('/login') }}" style="text-decoration:none; color:black;">Account</a>
</div>

<script>
    function searchProducts() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.getElementsByClassName('product-card');
        for (let i = 0; i < cards.length; i++) {
            let title = cards[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
            cards[i].style.display = title.includes(input) ? "" : "none";
        }
    }
</script>
@endsection