<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Setting\NameSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('user/login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["middleware" => 'auth:sanctum'], function () {

    Route::group(["prefix" => 'manage-user'], function () {
        Route::get('user', [\App\Http\Controllers\User\UserController::class, 'index']);
        Route::post('user', [\App\Http\Controllers\User\UserController::class, 'store']);
        Route::put('user/{id}', [\App\Http\Controllers\User\UserController::class, 'update']);
        Route::get('user/{id}/edit', [\App\Http\Controllers\User\UserController::class, 'edit']);
        Route::delete('user/{id}', [\App\Http\Controllers\User\UserController::class, 'destroy']);
    });

});

