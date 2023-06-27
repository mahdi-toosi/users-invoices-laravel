<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
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

