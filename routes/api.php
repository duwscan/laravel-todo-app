<?php

use App\Http\Controllers\Api\V1\TaskController;
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

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
});
Route::prefix('auth')->group(function () {
    Route::post('/login', \App\Http\Controllers\Api\Auth\LoginController::class);
    Route::post('/logout', \App\Http\Controllers\Api\Auth\LogoutController::class)->middleware('auth:sanctum');
    Route::post('/signup', \App\Http\Controllers\Api\Auth\RegisterController::class);
});
