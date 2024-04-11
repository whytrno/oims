<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [AuthController::class, 'profile'])->name('profile');
Route::post('profile', [AuthController::class, 'updateProfile'])->name('profile.update');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
