<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])
    ->name('index');
Route::get('/details/{slug}', [FrontendController::class, 'detail'])
    ->name('details');
Route::get('/cart', [FrontendController::class, 'cart'])
    ->name('cart');
Route::get('/checkout/success', [FrontendController::class, 'success'])
    ->name('checkout.success');

Route::middleware(['auth:sanctum', 'is_admin', config('jetstream.auth_session'), 'verified'])
    ->name('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('index');

        Route::resource('product', ProductController::class);
        Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
            'index', 'create', 'store', 'destroy'
        ]);
        Route::resource('transaction', TransactionController::class);
    });

