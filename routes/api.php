<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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

// Products

// varianta 1
// Route::get('/products', [ProductController::class, 'index']); /// reprezinta ruta de getALL

// avand in vedere ca avem o structura standard putem folosi apiResource, si vor fi generate toate rutele automat
Route::apiResource('/products', ProductController::class);
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/carts', CartController::class);
// Route::get('/carts', [CartController::class, 'index']);
// Route::post('/carts', [CartController::class, 'storeCartForUser']);
// Route::get('/carts/{cart}', [CartController::class, 'show']);
// Route::put('/carts/{cart}', [CartController::class, 'update']);
// Route::post('/carts', [CartController::class, 'addProductToCart']);
// Route::put('/carts/{cart}', [CartController::class, 'updateProductInCart']);
// Route::put('/carts/{cart}', [CartController::class, 'removeProductFromCart']);
Route::apiResource('/users', UserController::class);
