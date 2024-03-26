<?php

use App\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/avatar/{slug}',[AvatarController::class,'show']);
Auth::routes();

Route::apiResource('admin', AdminController::class)->only([
    'destroy', 'show', 'store', 'update','index'
]); 

Route::Post('/login', [LoginController::class,'login']);

Route::get('/message', 'FlashMessageController@index');
Route::get('/get-message', 'FlashMessageController@message');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

