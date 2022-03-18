<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\HTTP\Controllers\BrandController;
use Modules\Product\app\HTTP\Controllers\CategoryController;


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

Route::get('/category', [CategoryController::class , "index"])->name('category');
Route::get('/brand', [BrandController::class , "index"])->name('brand');
