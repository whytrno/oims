<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [AuthController::class, 'profile'])->name('profile');
Route::put('profile', [AuthController::class, 'updateProfile']);

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
