<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\StockDiamondController;
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

Route::apiResource('avatars', AvatarController::class)->only([
    'destroy', 'show', 'store', 'update'
]);

Route::apiResource('diamonds', StockDiamondController::class)->only([
    'destroy', 'show', 'store', 'update'
]);