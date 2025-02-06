<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\CartController;
use App\Models\Product;

// use App\Http\Controllers\ProductController;

Route::get('/', [ViewsController::class, 'index'])->name('index');

Route::get('/register', [ViewsController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [ActionsController::class, 'register']);

Route::get('/login', [ViewsController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [ActionsController::class, 'login']);

Route::get('/logout', [ActionsController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/profile', [ViewsController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('/profile', [ActionsController::class, 'profile_update'])->name('profile.update')->middleware('auth');

Route::get('/category/{category}', [ViewsController::class, 'category'])->name('category.show');

Route::get('/event/{event}', [ViewsController::class, 'event'])->name('event.show');

Route::get('/cart', [ViewsController::class, 'cart'])->name('cart')->middleware('auth');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease')->middleware('auth');
Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase')->middleware('auth');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

Route::post('/orders/{id}/review', [ActionsController::class, 'create_review'])->name('orders.review')->middleware('auth');


Route::get('/search', [ViewsController::class, 'search'])->name('search');
