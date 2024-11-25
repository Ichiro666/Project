<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route untuk Member
Route::get('/', function () {
    return Inertia::render('Member/DashboardMember', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Member/DashboardMember');
})->name('home');
Route::get('/shop', function () {
    return Inertia::render('Member/Shop');
})->name('shop');
Route::get('/catalog', function () {
    return Inertia::render('Member/Catalog');
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


//Route untuk Admin
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', EnsureAdmin::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Product
Route::resource('products', ProductController::class);

Route::resource('customers', CustomerController::class);