<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Product/Index', [
            'products' => Product::latest()->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Product/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            
            $product = Product::create([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'price' => $validated['price'],
                'description' => $validated['description'] ?? null,
                'image' => $imagePath
            ]);

            return redirect()->route('products.index')
                           ->with('success', 'Product created successfully');
        }

        return back()->with('error', 'Failed to upload image');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully');
    }

    public function show(Product $product)
    {
        return Inertia::render('Admin/Product/Show', [
            'product' => $product
        ]);
    }

    public function rate(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
            'order_id' => 'required|exists:order,id'
        ]);
    
        // Check if user has already rated this product in this order
        $existingRating = Rating::where([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $request->order_id
        ])->first();

        if ($existingRating) {
            return back()->with('error', 'You have already rated this product');
        }
    
        // Create new rating with review
        Rating::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);
    
        // Update product average rating
        $avgRating = Rating::where('product_id', $product->id)->avg('rating');
        $product->update(['rating' => $avgRating]);
    
        return back()->with('success', 'Thank you for your rating and review!');
    }

}