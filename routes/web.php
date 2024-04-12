<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => [RoleMiddleware::class . ':admin,management']], function () {
        Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');
    });

    Route::group(['prefix' => 'karyawan'], function () {
        Route::group(['middleware' => [RoleMiddleware::class . ':admin,management']], function () {
            Route::get('/', [UserController::class, 'index'])->name('users')->middleware(RoleMiddleware::class . ':admin,management');
            Route::get('/delete/{user_id}', [UserController::class, 'detail'])->name('users.delete');
            Route::get('export', [UserController::class, 'export'])->name('users.export');

            Route::group(['prefix' => '{user_id}/sites'], function () {
                Route::get('/', [SiteController::class, 'index'])->name('sites');
                Route::post('/store', [SiteController::class, 'store'])->name('sites.store');
            });
        });

        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/detail/{user_id}', [UserController::class, 'detail'])->name('users.detail');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::post('/update/{user_id}', [UserController::class, 'update'])->name('users.update');
        });
    });

    include 'child/web/auth.php';
});

Route::group(['middleware' => ['guest']], function () {
    include 'child/web/guest.php';
});

// Route::get('create-role', function () {
//     // Role::create([
//     //     'name' => 'user',
//     // ]);

//     $role = Role::where('name', 'user')->first();
//     $user = User::where('email', 'admin@gmail.com')->first();
//     $user->syncRoles($role);
// });

// Route::get('assign-permission', function () {
//     $role = Role::where('name', 'admin')->first();
//     $permission = Permission::where('name', 'user_create')->first();
//     $role->givePermissionTo($permission);
// });

// Route::get('assign-user', function () {
//     $user = \App\Models\User::where('email', 'admin@gmail.com')->first();
//     $role = Role::where('name', 'admin')->first();
//     $user->assignRole($role);
// });
