<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');

Route::get('/products/search', [App\Http\Controllers\ProductsController::class, 'search'])->name('products.search');

Route::get('/products/create', 'App\Http\Controllers\ProductsController@create')->name('products.create');

Route::post('/products/store', 'App\Http\Controllers\ProductsController@store')->name('products.store');

Route::delete('/products/{id}', 'App\Http\Controllers\ProductsController@destroy')->name('products.destroy');

Route::get('/products/{id}/show', [App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');

Route::get('/products/{id}/edit', [App\Http\Controllers\ProductsController::class, 'edit'])->name('products.edit');

Route::put('/products/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');
