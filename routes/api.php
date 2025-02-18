<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\TelegramAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/telegram/register', [TelegramAuthController::class, 'register']);
Route::post('/telegram/authenticate', [TelegramAuthController::class, 'authenticate']);

Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook']);



Route::get('/products', [ProductController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
});

Route::middleware(['auth:sanctum', 'is_admin'])->patch('/admin/order/{orderId}/update-status', [OrderController::class, 'updateStatus']);

Route::middleware('auth:sanctum')->post('/checkout', [OrderController::class, 'checkout']);

Route::post('/apply-discount', [DiscountController::class, 'applyDiscount']);

Route::post('/checkout', function (Request $request) {
    $order = Order::create([
        'user_id' => $request->user()->id,
        'total' => $request->input('total'),
        'status' => 'pending',
    ]);

    return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
});

Route::middleware('auth:sanctum')->get('/order/{orderId}/track', [OrderController::class, 'trackOrder']);
