<?php

use App\Http\Middleware\RoleMiddleware;
use App\Livewire\DashboardController;
use App\Livewire\SiteController;
use App\Livewire\UserSiteLocationController;
use App\Livewire\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => [RoleMiddleware::class . ':admin,manager']], function () {
        Route::get('/', DashboardController::class)->name('dashboard');
    });

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', UserController::class)->name('users');
        Route::get('/{userId}/detail', UserController::class)->name('users.show');

        Route::group(['prefix' => '{userId}/penempatan'], function () {
            Route::get('/', UserSiteLocationController::class)->name('users.sites');
        });

        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::post('/update/{user_id}', [UserController::class, 'update'])->name('users.update');
        });
    });

    Route::group(['prefix' => 'penempatan'], function () {
        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/', SiteController::class)->name('sites');
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
