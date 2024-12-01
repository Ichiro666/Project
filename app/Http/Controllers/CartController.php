<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Get cart items from session
        $cart = session()->get('cart', []);
    
        // Get product details for each cart item
        $cartItems = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $cartItems[] = [
                    'key' => $key,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'size' => $item['size']
                ];
            }
        }
        
        return Inertia::render('Member/Cart', [
            'cartItems' => $cartItems
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string'
        ]);

        $cart = session()->get('cart', []);
        
        // Create unique key for cart item based on product ID and size
        $cartItemKey = $request->product_id . '-' . $request->size;
        
        if (isset($cart[$cartItemKey])) {
            // Update quantity if item exists
            $cart[$cartItemKey]['quantity'] += $request->quantity;
        } else {
            // Add new item to cart
            $cart[$cartItemKey] = [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size
            ];
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}