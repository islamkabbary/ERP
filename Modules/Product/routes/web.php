<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\Entities\Product;
use Modules\Product\app\HTTP\Controllers\BrandController;
use Modules\Product\app\HTTP\Controllers\OptionController;
use Modules\Product\app\HTTP\Controllers\CategoryController;
use Modules\Product\app\HTTP\Controllers\CustomerController;
use Modules\Product\app\HTTP\Controllers\SupplierController;

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

Route::get('/category', [CategoryController::class, "index"])->name('category');
Route::get('/brand', [BrandController::class , "index"])->name('brand');
Route::get('/customer', [CustomerController::class , "index"])->name('customer');
Route::get('/supplier', [SupplierController::class , "index"])->name('supplier');
Route::get('/option', [OptionController::class , "index"])->name('option');
