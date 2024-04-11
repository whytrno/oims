<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\RoleMiddleware;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');

    Route::group(['middleware' => [RoleMiddleware::class . ':1,2']], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users');
            Route::get('/detail/{id}', [UserController::class, 'detail'])->name('users.detail');
            Route::get('/delete/{id}', [UserController::class, 'detail'])->name('users.delete');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('export', [UserController::class, 'export'])->name('users.export');
        });
        Route::group(['prefix' => 'sites'], function () {
            Route::get('/{id}', [SiteController::class, 'index'])->name('sites');
        });
    });

    include 'child/web/auth.php';
});

include 'child/web/guest.php';
