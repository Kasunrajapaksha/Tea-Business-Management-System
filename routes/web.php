<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Marketing\MarketingController;
use App\Http\Controllers\Production\ProductionController;
use App\Http\Controllers\Shipping\ShippingController;
use App\Http\Controllers\Tea\TeaController;

//For Auth
Route::controller(SessionController::class)->group(function () {
    Route::get('/', 'create')->name('login');
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', 'destroy')->name('logout');
        Route::post('/logout', 'destroy')->name('logout');
    });
});


//For Admin role
Route::middleware(['auth','role:Admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile/{user}/edit', 'show')->name('show');
                Route::patch('/profile/{user}', 'update')->name('update');
                Route::patch('/profile/{user}/edit/image', 'updateImage')->name('update.image');
                Route::patch('/profile/reset/password', 'resetPassword')->name('reset.password');
                Route::delete('/profile/{user}/delete/image', 'destroyImage')->name('delete.image');
            });

            Route::controller(UserController::class)->group(function () {
                Route::get('/user', 'index')->name('user.index');
                Route::get('/user/create', 'create')->name('user.create');
                Route::post('/user', 'store')->name('user.store');
                Route::get('/user/{user}/edit', 'edit')->name('user.edit');
                Route::patch('/user/{user}', 'update')->name('user.update');
            });

            Route::controller(DepartmentController::class)->group(function () {
                Route::get('/department', 'index')->name('department.index');
                Route::get('/department/create', 'create')->name('department.create');
                Route::post('/department', 'store')->name('admin.deparstore');
                Route::get('/department/{department}/edit', 'edit')->name('department.edit');
                Route::patch('/department/{department}', 'update')->name('department.update');
            });

            Route::controller(RoleController::class)->group(function () {
                Route::get('/role',  'index')->name('role.index');
                Route::get('/role/create', 'create')->name('role.create');
                Route::post('/role', 'store')->name('role.store');
                Route::get('/role/{role}/edit', 'edit')->name('role.edit');
                Route::patch('/role/{role}', 'update')->name('role.update');
            });

            Route::controller(PermissionController::class)->group(function () {
                Route::get('/permission',  'index')->name('permission.index');
                Route::get('/permission/create',  'create')->name('permission.create');
                Route::post('/permission',  'store')->name('permission.store');
                Route::get('/permission/{role}/rolePermission', 'getRolePermissions')->name('role.getRolePermissions');
                Route::post('/permission/rolePermission',  'storeRolePermission')->name('permission.storeRolePermission');
            });
        });
    });
});


//For Marketing Manager role
Route::middleware(['auth','role:Marketing Manager'])->group(function () {
    Route::prefix('marketing')->group(function () {
        Route::name('marketing.')->group(function () {
            Route::controller(MarketingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});


//For Finance Manager role
Route::middleware(['auth','role:Finance Manager'])->group(function () {
    Route::prefix('finance')->group(function () {
        Route::name('finance.')->group(function () {
            Route::controller(FinanceController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});


//For Production Manager role
Route::middleware(['auth','role:Production Manager'])->group(function () {
    Route::prefix('production')->group(function () {
        Route::name('production.')->group(function () {
            Route::controller(ProductionController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});


//For Tea Department Head & Tea Teaser role
Route::middleware(['auth','role:Tea Department Head,Tea Teaser'])->group(function () {
    Route::prefix('tea')->group(function () {
        Route::name('tea.')->group(function () {
            Route::controller(TeaController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});


//For General Manager role
Route::middleware(['auth','role:General Manager'])->group(function () {
    Route::prefix('management')->group(function () {
        Route::name('management.')->group(function () {
            Route::controller(ManagementController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});


//For Shipping role
Route::middleware(['auth','role:Shipping Manager'])->group(function () {
    Route::prefix('shipping')->group(function () {
        Route::name('shipping.')->group(function () {
            Route::controller(ShippingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});











