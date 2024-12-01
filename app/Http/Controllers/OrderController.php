<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    $orders = Order::with(['items.product', 'user'])
        ->where('user_id', Auth::id()) // Filter orders for the logged-in user
        ->latest()
        ->get();

    return Inertia::render('Member/Order', [
        'orders' => $orders
    ]);
}

    public function show(Order $order)
    {
        return Inertia::render('Member/OrderDetail', [
            'order' => $order->load('items.product')
        ]);
    }

public function adminIndex()
{
    $orders = Order::with(['user', 'items.product'])
        ->latest()
        ->get();

    return Inertia::render('Admin/Order/Index', [
        'orders' => $orders
    ]);
}

public function adminShow(Order $order)
{
    return Inertia::render('Admin/Order/Show', [
        'order' => $order->load(['user', 'items.product'])
    ]);
}

public function updateStatus(Order $order, Request $request)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled'
    ]);

    $order->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Order status updated successfully');
}

public function getDashboardStats()
{
    // Get completed orders
    $completedOrders = Order::where('status', 'completed');

    // Calculate total revenue from completed orders
    $totalRevenue = $completedOrders->sum('total_amount');

    // Calculate total sales (number of completed orders)
    $totalSales = $completedOrders->count();

    // Get total products
    $totalProducts = Product::count();

    // Get total customers (users who have placed orders)
    $totalCustomers = User::whereHas('orders')->count();

    // Get recent orders
    $recentOrders = Order::with('user')
    ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->order_number,
                    'customer' => $order->user->name,
                    'amount' => $order->total_amount,
                    'status' => $order->status
                ];
            });

        // Get monthly revenue data for chart
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereYear('created_at', Carbon::now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();

            return [
                'totalRevenue' => $totalRevenue,
                'totalSales' => $totalSales,
                'totalProducts' => $totalProducts,
                'totalCustomers' => $totalCustomers,
                'recentOrders' => $recentOrders,
                'monthlyRevenue' => $monthlyRevenue
            ];
        }
}