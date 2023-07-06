<?php

use App\Http\Controllers\Auth\VerifyMobileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::view('verify-mobile', 'auth.verify-mobile')->name('verification-mobile.notice');

    Route::post('verify-mobile', [VerifyMobileController::class, '__invoke'])
        ->middleware(['throttle:6,1'])
        ->name('verification.verify-mobile');
});

Route::middleware(['auth', 'verify.mobile'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/me/invoices', [InvoiceController::class, 'getMyInvoices'])->name('me.invoices');
    Route::get('/me/invoices/{invoice}/products', [InvoiceController::class, 'getMyInvoiceProduct'])
        ->name('me.invoices.products');

    Route::middleware('can:is-admin')->group(function () {
        Route::controller(UserController::class)
            ->prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{user}/edit', 'edit')->name('edit');
                Route::put('/{user}', 'update')->name('update');
                Route::delete('/{user}', 'destroy')->name('destroy');
                Route::get('/{user}/invoices', 'showInvoices')->name('invoices');
                Route::get('/search', 'search')->name('search');
                Route::get('/{user}/invoices', 'invoices')->name('invoices');
            });

        Route::controller(InvoiceController::class)
            ->prefix('invoices')
            ->name('invoices.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{invoice}/edit', 'edit')->name('edit');
                Route::put('/{invoice}', 'update')->name('update');
                Route::delete('/{invoice}', 'destroy')->name('destroy');
                Route::get('/search', 'search')->name('search');
                Route::get('/{invoice}/products', 'products')->name('products');
            });

        Route::controller(ProductController::class)
            ->prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{product}/edit', 'edit')->name('edit');
                Route::put('/{product}', 'update')->name('update');
                Route::delete('/{product}', 'destroy')->name('destroy');
                Route::get('/search', 'search')->name('search');
            });
    });
});

Auth::routes();
