<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
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

Route::group(['middleware' => 'locale'], function () {

    /**
     * guest routes
     */
    Route::group(['middleware' => ['guest:sanctum']], function () {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('password/email', [ForgotPasswordController::class, 'forgotPassword']);
        Route::post('password/reset/{token?}', [ForgotPasswordController::class, 'resetPassword']);

    });

    /**
     * auth routes
     */
    Route::group(['middleware' => ['auth_api:sanctum']], function () {

        Route::post('logout', [AuthController::class, 'logout']);

    });
});



