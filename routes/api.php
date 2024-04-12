<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

include 'child/api/auth.php';

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'detail']);
    Route::post('profile', [UserController::class, 'update']);

    Route::group(['prefix' => 'sites'], function () {
        Route::get('/', [SiteController::class, 'index']);
        Route::post('/', [SiteController::class, 'store']);
        Route::put('{id}', [SiteController::class, 'update']);
        Route::delete('{id}', [SiteController::class, 'destroy']);
    });
});

Route::get('roles', [RoleController::class, 'index']);
