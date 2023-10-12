<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
#Route::apiResource('users', UserController::class);
Route::controller(OrderController::class)->prefix('orders')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');

    
});
Route::controller(OrderProductController::class)->prefix('order_product')->group(function () {
    Route::get('/', 'index');
    Route::get('/{order_pro}', 'parcial')->name('parcial');

    Route::post('/', 'store');
    Route::delete('/{id}', 'delete');
    Route::delete('/', 'delete_all');

    
});
Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index');
    //Route::get('/{id}', 'parcial')->name('parcial');

    Route::post('/', 'store');   
});