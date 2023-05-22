<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('auth')->group(function () {
    Route::post('/login', \App\Http\Controllers\Api\V1\Auth\LoginController::class)->middleware('guest');
    Route::post('/logout', \App\Http\Controllers\Api\V1\Auth\LogoutController::class)->middleware('guest');
    Route::post('/signup', \App\Http\Controllers\Api\V1\Auth\RegisterController::class)->middleware('guest');
});
