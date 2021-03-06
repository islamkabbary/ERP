<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Modules\Product\app\HTTP\Controllers\BrandController;
use Modules\Product\app\HTTP\Controllers\OrderController;
use Modules\Product\app\HTTP\Controllers\OptionController;
use Modules\Product\app\HTTP\Controllers\ProductController;
use Modules\Product\app\HTTP\Controllers\PurchasController;
use Modules\Product\app\HTTP\Controllers\CategoryController;
use Modules\Product\app\HTTP\Controllers\CustomerController;
use Modules\Product\app\HTTP\Controllers\SupplierController;
use Modules\Product\app\HTTP\Controllers\InventoryController;

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



Route::get('/index', function () {
    return view('Product::layouts.index');
})->name('dash');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/category', [CategoryController::class, "index"])->name('category');
    Route::get('/brand', [BrandController::class, "index"])->name('brand');
    Route::get('/customer', [CustomerController::class, "index"])->name('customer');
    Route::get('/supplier', [SupplierController::class, "index"])->name('supplier');
    Route::get('/option', [OptionController::class, "index"])->name('option');
    Route::get('/inventory', [InventoryController::class, "index"])->name('inventory');
    Route::get('/product', [ProductController::class, "index"])->name('product');
    Route::get('/order', [OrderController::class, "create"])->name('create-order');
    Route::get('/show-order-details/{id}', [OrderController::class, "show"])->name('show-order-details');
    Route::get('/add-purchases', [PurchasController::class, "create"])->name('add-purchases');
    Route::get('/show-purchases', [PurchasController::class, "index"])->name('show-purchases');
    Route::get('/edit-purchases/{id}', [PurchasController::class, "edit"])->name('edit-purchases');
});
