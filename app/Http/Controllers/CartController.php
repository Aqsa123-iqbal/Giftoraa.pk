<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    // 🛒 1. Add Product to Cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $product->name . ' added to cart successfully! 🛒');
    }

    // 🛒 2. Display Shopping Cart Page
    public function cartIndex()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // 🗑️ 3. Remove Item From Cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed from cart! 🗑️');
    }

    // 🔄 4. Update Product Quantity
    public function updateCartQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $action = $request->input('action');
            if($action == 'increase') {
                $cart[$id]['quantity']++;
            } elseif($action == 'decrease') {
                if($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                } else {
                    unset($cart[$id]);
                }
            }
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cart updated successfully! 🔄');
    }

    // 💳 5. Load Checkout Page
    public function checkoutIndex()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->to('/')->with('error', 'Your cart is empty!');
        }
        return view('checkout', compact('cart'));
    }

    // 📦 6. Finalize Order Placement
    public function placeOrder(Request $request)
    {
        $request->validate([
            'contact' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required|digits:11',
            'billing_option' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->to('/')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        foreach ($cart as $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }
        $total_amount = $subtotal + 300;

        // Dynamic Order Data fix
        $orderData = [
            'total_amount' => $total_amount,
            'status' => 'pending',
            'contact' => $request->contact,
        ];

        // Sirf tabhi user_id daalein agar user login hai
        if (auth()->check()) {
            $orderData['user_id'] = auth()->id();
        }

        Order::create($orderData);

        session()->forget('cart');
        return redirect('/?status=success');
    }

    // 🚫 7. Cancel Order
    public function cancelOrder()
    {
        session()->forget('cart');
        return redirect('/?status=cancelled');
    }

    // 💖 8. Wishlist Index
    public function wishlistIndex()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist', compact('wishlist'));
    }

    // 💖 9. Add Product to Wishlist
    public function addToWishlist(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        if(!isset($wishlist[$id])) {
            $wishlist[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image
            ];
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', $product->name . ' added to wishlist! 💖');
    }

    // 🗑️ 10. Remove Item From Wishlist
    public function removeFromWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);
        if(isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }
        return redirect()->route('wishlist.index')->with('success', 'Item removed from wishlist! 🗑️');
    }
}