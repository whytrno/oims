<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [RoleController::class, 'index']);

Route::post('register', [AuthController::class, 'registerProcess']);
Route::post('login', [AuthController::class, 'loginProcess']);
