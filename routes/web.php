<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/orders/product/{id}', [OrderController::class, 'getProductDetails']);

Route::get('/orders/customer/{id}', [OrderController::class, 'getCustomerDetails']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
    'customers'=>\App\Http\Controllers\CustomerController::class,
    'category'=>\App\Http\Controllers\CategoryController::class,
    'orders'=>\App\Http\Controllers\OrderController::class
]);
// routes/web.php


Route::get('/orders/history/{customerId}', [OrderController::class, 'showOrderHistory'])->name('order.history');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
