<?php

use App\Http\Controllers\Api\ShoppingController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('products', [ShoppingController::class, 'productsIndex'])->name('products.index');

Route::prefix('cart')
    ->group(function() {
        Route::get('/', [ShoppingController::class, 'getCart']);
        Route::post('/', [ShoppingController::class, 'addProductToCart']);
        Route::post('{discount_code}', [ShoppingController::class, 'addDiscountCode']);
        Route::delete('discount', [ShoppingController::class, 'deleteDiscountCode']);
        Route::put('{line_id}', [ShoppingController::class, 'updateProductInCart']);
        Route::delete('{line_id}', [ShoppingController::class, 'deleteProductInCart']);
    });

Route::prefix('checkout')
    ->group(function() {
        Route::get('/', [ShoppingController::class, 'checkout']);
        Route::post('/', [ShoppingController::class, 'doCheckout']);
    });

Route::middleware('auth:api')
    ->prefix('user')
    ->group(function() {
        Route::get('/', [UserController::class, 'profile']);
        Route::post('/', [UserController::class, 'updateProfile']);
    });
