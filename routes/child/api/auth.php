<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'registerProcess']);
Route::post('login', [AuthController::class, 'loginProcess']);
