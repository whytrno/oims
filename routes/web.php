<?php

use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\SiteLocationPage;
use App\Livewire\Pages\UserSiteLocationDetailPage;
use App\Livewire\Pages\UserSiteLocationPage;
use App\Livewire\Pages\UserPage;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => [RoleMiddleware::class . ':admin,manager']], function () {
        Route::get('/', DashboardPage::class)->name('dashboard');
    });

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', UserPage::class)->name('users');
        Route::get('/{userId}/detail', UserPage::class)->name('users.show');
        Route::get('/{userId}/penempatan', UserSiteLocationDetailPage::class)->name('users.sites.detail');

        Route::group(['prefix' => 'penempatan'], function () {
            Route::get('/', UserSiteLocationPage::class)->name('users.sites');
        });

        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/create', [UserPage::class, 'create'])->name('users.create');
            Route::post('/store', [UserPage::class, 'store'])->name('users.store');
            Route::post('/update/{user_id}', [UserPage::class, 'update'])->name('users.update');
        });
    });

    Route::group(['prefix' => 'penempatan'], function () {
        Route::group(['middleware' => [RoleMiddleware::class . ':admin']], function () {
            Route::get('/', SiteLocationPage::class)->name('sites');
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
