<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Marketing\CustomerController;
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

Route::middleware(['auth','department:Admin,Marketing,Finance,Production,Tea,Management,Shipping'])->group(function () {
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'index')->name('notifications.index');
        Route::patch('/notifications/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
        Route::patch('/notifications/mark-all-as-read', 'markAllAsRead')->name('notifications.markAllAsRead');
    });
});


//For Admin role
Route::middleware(['auth','department:Admin'])->group(function () {
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
                Route::get('/role/{department}/create', 'create')->name('role.create');
                Route::post('/role', 'store')->name('role.store');
                Route::get('/role/{role}/edit', 'edit')->name('role.edit');
                Route::patch('/role/{role}', 'update')->name('role.update');
            });

            Route::controller(PermissionController::class)->group(function () {
                Route::get('/permission/{role}',  'index')->name('permission.index');
                Route::get('/permission/{role}/create',  'create')->name('permission.create');
                Route::post('/permission/{role}',  'store')->name('permission.store');
                Route::patch('/permission/{role}',  'update')->name('permission.update');
            });
        });
    });
});


//For Marketing Manager role
Route::middleware(['auth','department:Marketing,Admin'])->group(function () {
    Route::prefix('marketing')->group(function () {
        Route::name('marketing.')->group(function () {
            Route::controller(MarketingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
            Route::controller(CustomerController::class)->group(function () {
                Route::get('/customer', 'index')->name('customer.index');
                Route::get('/customer/create', 'create')->name('customer.create');
                Route::post('/customer', 'store')->name('customer.store');
                Route::get('/customer/{customer}/edit', 'edit')->name('customer.edit');
                Route::patch('/customer/{customer}', 'update')->name('customer.update');
            });
        });
    });
});


//For Finance Manager role
Route::middleware(['auth','department:Finance'])->group(function () {
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
Route::middleware(['auth','department:Production'])->group(function () {
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
Route::middleware(['auth','department:Tea'])->group(function () {
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
Route::middleware(['auth','department:Management'])->group(function () {
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
Route::middleware(['auth','department:Shipping'])->group(function () {
    Route::prefix('shipping')->group(function () {
        Route::name('shipping.')->group(function () {
            Route::controller(ShippingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });
        });
    });
});











