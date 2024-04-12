<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [UserController::class, 'detail'])->name('profile');
Route::post('profile', [UserController::class, 'update'])->name('profile.update');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
