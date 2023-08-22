<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "dashboard" middleware group. Make something great!
|
*/


Route::prefix('dashboard')->group(function () {
    Route::get('/', HomeComponent::class)->name('home.index');
    Route::get('/shop', ShopComponent::class)->name('shop');
    Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
    Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');
    Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
    Route::get('/cart', CartComponent::class)->name('shop.cart');



    Route::get('/user', UserDashboardComponent::class)
        ->name('user.dashboard')->middleware(['auth']);
});
