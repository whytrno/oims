<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

include 'child/api/auth.php';

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('profile', [UserController::class, 'updateProfile']);
});
