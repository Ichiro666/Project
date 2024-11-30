<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'shipping_address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.size' => 'required|string'
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . uniqid(),
            'total_amount' => 0, // Will be calculated
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->shipping_address
        ]);

        $total = 0;
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total += $product->price * $item['quantity'];
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'size' => $item['size']
            ]);
        }

        $order->update(['total_amount' => $total]);

        return redirect()->route('orders.show', $order->id);
    }

    public function index()
    {
        return Inertia::render('Member/Order', [
            'orders' => Order::with(['items.product'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get()
        ]);
    }

    public function show(Order $order)
    {
        return Inertia::render('Member/OrderDetail', [
            'order' => $order->load('items.product')
        ]);
    }
}