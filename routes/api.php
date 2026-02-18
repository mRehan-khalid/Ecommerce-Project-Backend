<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    });
    
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::post('/addProduct', [\App\Http\Controllers\ProductController::class, 'addProduct']);
Route::get('/productsList', [\App\Http\Controllers\ProductController::class, 'productsList']);
Route::delete('/deleteProduct/{id}', [\App\Http\Controllers\ProductController::class, 'deleteProduct']);
Route::get('/getProductById/{id}', [\App\Http\Controllers\ProductController::class, 'getProductById']);
Route::put('/updateProduct/{id}', [\App\Http\Controllers\ProductController::class, 'updateProduct']);
Route::get('searchProduct/{key}', [\App\Http\Controllers\ProductController::class, 'searchProduct']);
Route::post('/addToCart/{product_id}', [\App\Http\Controllers\CartController::class, 'addToCart']); 
Route::get('/userCart/{user_id}', [\App\Http\Controllers\CartController::class, 'userCart']);   
Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'checkout']);   