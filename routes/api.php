<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/products', ProductController::class);
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/order_items', OrderItemController::class);

Route::get('/send-reports-revenue', [Report::class, 'handleReport']);

Route::middleware('branch_throttle')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
});
