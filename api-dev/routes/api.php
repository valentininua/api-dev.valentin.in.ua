<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PingController;

Route::get('/ping', [PingController::class, 'ping']);

// Products
Route::get('/products', [PingController::class, 'getProducts']);
Route::get('/products/{id}', [PingController::class, 'getProduct']);

// Categories
Route::get('/categories', [PingController::class, 'getCategories']);

// Cart
Route::post('/cart', [PingController::class, 'cartOperations']);

// Orders
Route::post('/orders', [PingController::class, 'orderOperations']);

// User
Route::get('/user', [PingController::class, 'getUserProfile']);
Route::put('/user', [PingController::class, 'updateUserProfile']);

// Config
Route::get('/config', [PingController::class, 'getConfig']);
