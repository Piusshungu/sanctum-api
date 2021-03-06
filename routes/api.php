<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ShopsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes 

Route::get('/products', [ProductsController::class, 'index']);

Route::get('/products/search/{name}', [ProductsController::class, 'searchProduct']);

Route::post('/register', [AuthController::class, 'userRegistration']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/shops', [ShopsController::class, 'registerShop']);

//Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function(){  

    Route::post('/products', [ProductsController::class, 'storeProducts']);

    Route::get('/products/view/{id}', [ProductsController::class, 'viewProduct']);

    Route::post('/products/update/{id}', [ProductsController::class, 'updateProduct']);

    Route::delete('/products/delete/{id}', [ProductsController::class, 'deleteProduct']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/shops', [ShopsController::class, 'index']);

    Route::post('/shop/update/{id}', [ShopsController::class, 'editShop']);

    Route::delete('/shop/delete/{id}', [ShopsController::class, 'deleteShop']);

    Route::get('/shop/view/{id}', [ShopsController::class, 'viewShop']);

    Route::get('/orders', [OrdersController::class, 'index']);
});
