<?php

use App\Http\Controllers\ProductsController;
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

Route::get('/products', [ProductsController::class, 'index']);

Route::post('/products', [ProductsController::class, 'storeProducts']);

Route::get('/products/view/{id}', [ProductsController::class, 'viewProduct']);

Route::post('/products/update/{id}', [ProductsController::class, 'updateProduct']);

Route::get('/products/delete/{id}', [ProductsController::class, 'deleteProduct']);

Route::get('/products/search/{name}', [ProductsController::class, 'searchProduct']);
