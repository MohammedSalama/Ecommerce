<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware(['auth', 'authadmin'])->group(function () {
    Route::get('/', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');
    Route::get('/products', AdminProductComponent::class)->name('admin.products');

});
