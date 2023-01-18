<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionHeaderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductTypeController;

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

Route::prefix('auth')->controller(UserController::class)->group(function (){
    Route::get('register', 'index_register')->name('index_register')->middleware('guestMiddleware');
    Route::get('login', 'index_login')->name('index_login')->middleware('guestMiddleware');
    Route::post('register', 'register')->name('register')->middleware('guestMiddleware');
    Route::post('login', 'login')->name('login')->middleware('guestMiddleware');
    Route::post('logout', 'logout')->name('logout')->middleware('memberAndAdminMiddleware');
});

Route::get('/',[ProductController::class, 'index'])->name('index_home')->middleware('memberAndAdminMiddleware');
Route::prefix('products')->group(function (){
   Route::get('view', [ProductController::class, 'index_products'])->name('index_product')->middleware('memberAndAdminMiddleware');
   Route::get('add', [ProductController::class, 'index_add'])->name('index_add')->middleware('adminMiddleware');
   Route::post('add', [ProductController::class, 'add'])->name('add_product')->middleware('adminMiddleware');
   Route::get('update/{id}', [ProductController::class, 'index_update'])->name('index_update')->middleware('adminMiddleware');
   Route::post('update', [ProductController::class, 'update'])->name('update_product')->middleware('adminMiddleware');
   Route::get('search', [ProductController::class, 'search'])->name('search')->middleware('memberAndAdminMiddleware');

});

Route::prefix('product-types')->middleware('adminMiddleware')->group(function (){
   Route::post('add', [ProductTypeController::class, 'add'])->name('add_product_type');
});

Route::prefix('carts')->middleware('memberMiddleware')->group(function (){
    Route::get('view', [CartController::class, 'index'])->name('index_cart');
    Route::post('add', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::post('remove', [CartController::class, 'removeFromCart'])->name('remove_from_cart');
    Route::post('increment', [CartController::class, 'incrementQuantity'])->name('increment');
    Route::post('decrement', [CartController::class, 'decrementQuantity'])->name('decrement');
    Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
});

Route::prefix('transactions')->group(function (){
    Route::get('view-all', [TransactionHeaderController::class, 'index'])->name('index_view_transaction')->middleware('adminMiddleware');
});

Route::get('profile', [UserController::class, 'index_profile'])->name('index_profile')->middleware('memberMiddleware');
