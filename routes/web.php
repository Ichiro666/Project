<?php

use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Province;  // Add this
use App\Models\Regency;   // Add this
use App\Models\District;
use App\Models\Village;
use App\Models\Order;     // Add this

// Landing Page Route
Route::get('/', function () {
    // If user is logged in, redirect based on role
    if (Auth::check()) {
        $user = Auth::user();
        return $user->role === 'admin' 
            ? redirect()->route('dashboard')
            : redirect()->route('home');
    }
    
    return Inertia::render('Member/DashboardMember', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Auth::routes(['verify' => true]);

// Email Verification Routes (Only for new users)
Route::middleware(['auth'])->group(function () {
    Route::get('verify-email', function() {
        $user = Auth::user();
        
        // Skip verification for existing users
        if ($user->created_at < '2024-01-24') {  // Adjust this date to when you implemented verification
            return redirect()->route('home');
        }
        
        return app(EmailVerificationPromptController::class)->__invoke(request());
    })->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Member Dashboard Route
    Route::get('/home', function () {
        $user = Auth::user();
        
        // Redirect admin to admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        $userOrders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->get();

        return Inertia::render('Member/DashboardMember', [
            'products' => Product::withCount([
                'orderItems as total_sold' => function($query) {
                    $query->whereHas('order', function($q) {
                        $q->where('status', 'completed');
                    });
                }
            ])
            ->withAvg('ratings', 'rating')
            ->get(),
            'userOrders' => $userOrders
        ]);
    })->name('home');

    // Admin Dashboard Route
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->role !== 'admin') {
            return redirect()->route('home');
        }

        $orderController = new OrderController();
        $statistics = $orderController->getDashboardStats();
        
        return Inertia::render('Dashboard', [
            'statistics' => $statistics
        ]);
    })->middleware(EnsureAdmin::class)->name('dashboard');
});

//Route untuk Member 
Route::get('/catalog/{category?}', function ($category = null) {
    $query = Product::query();
    
    if ($category) {
        $query->where('category', $category);
    }
    
    return Inertia::render('Member/Catalog', [
        'products' => $query->get(),
        'activeCategory' => $category
    ]);
})->name('catalog');

Route::get('/shop', function () {
    return Inertia::render('Member/Shop', [
        'products' => Product::withCount('ratings as reviews_count')
            ->withAvg('ratings as rating', 'rating')
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'category' => $product->category,
                    'rating' => number_format($product->ratings_avg_rating ?? 0, 1), // Format rating properly
                    'reviews_count' => $product->reviews_count ?? 0
                ];
            })
    ]);
})->name('shop');

Route::get('/catalog', function () {
    return Inertia::render('Member/Catalog', [
        'products' => Product::latest()->get() // Mengambil semua produk dari database
    ]);
})->name('catalog');
Route::get('/tentang', function () {
    return Inertia::render('Member/Tentang');
})->name('tentang');
Route::get('/contact', function () {
    return Inertia::render('Member/Contact');
})->name('contact');
Route::get('/cart', function () {
    return Inertia::render('Member/Cart');
})->name('cart');

Route::get('/checkout', function () {
    return Inertia::render('Member/Checkout');
})->name('checkout');
Route::get('/checkout', function () {
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
    
    return Inertia::render('Member/Checkout', [
        'cartItems' => $cartItems
    ]);
})->name('checkout');
Route::get('/profil', function () {
    return Inertia::render('Member/Profil');
})->name('profil');
Route::get('/order', function () {
    return Inertia::render('Member/Order');
})->name('order');
Route::get('/info', function () {
    return Inertia::render('Member/Info');
})->name('info');

Route::get('/checkout', function () {
    $cart = session()->get('cart', []);
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
    
    return Inertia::render('Member/Checkout', [
        'cartItems' => $cartItems
    ]);
})->name('checkout');


Route::get('/product/{id}', function ($id) {
    return Inertia::render('Member/DetailProduct', [
        'product' => Product::with(['ratings' => function($query) {
            $query->with('user')->latest();
        }])
        ->withAvg('ratings as rating', 'rating')
        ->withCount('ratings as reviews_count')
        ->findOrFail($id)
    ]);
})->name('detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});  
Route::middleware(['auth'])->group(function () {  
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatusUser'])
        ->name('orders.update-status');
    Route::post('/products/{product}/rate', [ProductController::class, 'rate'])
        ->name('products.rate');
});

require __DIR__.'/auth.php';

//Product
Route::resource('products', ProductController::class);

Route::resource('customers', CustomerController::class);

Route::prefix('api')->group(function () {
    // Get all provinces
    Route::get('/provinces', function () {
        return Province::all();
    });

    // Get regencies by province ID 
    Route::get('/provinces/{province}/regencies', function ($province) {
        $province = Province::findOrFail($province);
        return $province->regencies;
    });

    // Get districts by regency ID
    Route::get('/regencies/{regency}/districts', function ($regency) {
        $regency = Regency::findOrFail($regency);
        return $regency->districts;
    });

    // Get villages by district ID
    Route::get('/districts/{district}/villages', function ($district) {
        $district = District::findOrFail($district);
        return $district->villages;
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{key}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/update/{key}', [CartController::class, 'updateCart'])->name('cart.update');
});

Route::middleware(['auth', EnsureAdmin::class])->group(function () {
    // ... existing routes
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])
    ->name('admin.orders.update-status');
});