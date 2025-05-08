<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;



Route::controller(SessionController::class)->group(function () {
    Route::get('/', 'create')->name('login');
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store');
    Route::get('/logout', 'destroy')->middleware('auth');
    Route::post('/logout', 'destroy')->middleware('auth');

});

Route::middleware(['auth'])->group(function () {
    //For Admin role
    Route::middleware(['role:Admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('admin.index');
                Route::get('/profile/{user}', 'show')->name('admin.show');
                Route::patch('/profile/{user}/update', 'update')->name('admin.update');
                Route::patch('/profile/{user}/update/image', 'updateImage')->name('admin.update.image');
                Route::patch('/profile/reset/password', 'resetPassword')->name('admin.reset.password');
                Route::delete('/profile/destroy/{user}/image', 'destroyImage')->name('admin.destroy.image');
            });

            Route::controller(UserController::class)->group(function () {
                Route::get('/user', 'index')->name('admin.user.index');
                Route::get('/user/create', 'create')->name('admin.user.create');
                Route::post('/user', 'store')->name('admin.user.store');
                Route::get('/user/{user}', 'edit')->name('admin.user.edit');
                Route::patch('/user/{user}', 'update')->name('admin.user.update');
            });

            Route::controller(DepartmentController::class)->group(function () {
                Route::get('/department', 'index')->name('admin.department.index');
                Route::get('/department/create', 'create')->name('admin.department.create');
                Route::post('/department', 'store')->name('admin.department.store');
                Route::get('/department/{department}', 'edit')->name('admin.department.edit');
                Route::patch('/department/{department}', 'update')->name('admin.department.update');
                Route::delete('/department/{department}', 'destroy')->name('admin.department.destroy');
            });

            Route::controller(RoleController::class)->group(function () {
                Route::get('/role',  'index')->name('admin.role.index');
                Route::get('/role/create', 'create')->name('admin.role.create');
                Route::post('/role', 'store')->name('admin.role.store');
                Route::get('/role/{role}', 'edit')->name('admin.role.edit');
                Route::patch('/role/{role}', 'update')->name('admin.role.update');
            });

            Route::controller(PermissionController::class)->group(function () {
                Route::get('/permission',  'index')->name('admin.permission.index');
                Route::get('/permission/create',  'create')->name('admin.permission.create');
                Route::post('/permission',  'store')->name('admin.permission.store');
                Route::get('/permission/{role}/rolePermission', 'getRolePermissions')->name('admin.role.getRolePermissions');
                Route::post('/permission/rolePermission',  'storeRolePermission')->name('admin.permission.storeRolePermission');
            });
        });
    });

    //For Marketer role
    Route::middleware(['role:Marketing Manager'])->group(function () {
        Route::prefix('marketing')->group(function () {
            Route::controller(ClientController::class)->group(function () {
                Route::get('/client', 'index')->name('marketing.client.index');
            });
        });
    });

});







