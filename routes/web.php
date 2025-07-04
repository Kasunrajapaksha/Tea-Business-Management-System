<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tea\TeaTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Finance\PaymentRequestController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Marketing\CustomerController;
use App\Http\Controllers\Marketing\MarketingController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Production\MaterialPurchaseController;
use App\Http\Controllers\Production\MaterialController;
use App\Http\Controllers\Production\ProductionController;
use App\Http\Controllers\Shipping\ShippingController;
use App\Http\Controllers\Supply\SupplierPaymentController;
use App\Http\Controllers\Supply\SupplierController;
use App\Http\Controllers\Tea\TeaController;
use App\Http\Controllers\Tea\TeaPerchaseController;
use App\Http\Controllers\Warehouse\InventoryTransactionsController;
use App\Http\Controllers\Warehouse\WarehouseController;

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
Route::middleware(['auth','department:Admin,Management'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
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
                Route::post('/department', 'store')->name('department.store');
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


//For Notifications
Route::middleware(['auth','department:Admin,Marketing,Finance,Production,Tea,Management,Shipping,Warehouse'])->group(function () {
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'index')->name('notifications.index');
        Route::patch('/notifications/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
        Route::patch('/notifications/mark-all-as-read', 'markAllAsRead')->name('notifications.markAllAsRead');
    });
});


//Fro Profile
Route::middleware(['auth','department:Admin,Marketing,Finance,Production,Tea,Management,Shipping,Warehouse'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user}/edit', 'index')->name('profile.index');
        Route::patch('/profile/{user}', 'update')->name('profile.update');
        Route::patch('/profile/{user}/edit/image', 'updateImage')->name('profile.update.image');
        Route::patch('/profile/reset/password', 'resetPassword')->name('profile.reset.password');
        Route::delete('/profile/{user}/delete/image', 'destroyImage')->name('profile.delete.image');
    });
});


//For Supply
Route::middleware(['auth','department:Admin,Production,Tea,Management'])->group(function () {
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index')->name('supplier.index');
        Route::get('/supplier/create', 'create')->name('supplier.create');
        Route::post('/supplier', 'store')->name('supplier.store');
        Route::get('/supplier/{supplier}', 'edit')->name('supplier.edit');
        Route::patch('/supplier/{supplier}', 'update')->name('supplier.update');
    });
});


//For Marketing
Route::middleware(['auth','department:Marketing,Admin,Management'])->group(function () {
    Route::prefix('marketing')->group(function () {
        Route::name('marketing.')->group(function () {

            Route::controller(MarketingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
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

//For Order
Route::middleware(['auth','department:Admin,Management,Marketing,Shipping,Production,Tea,Finance'])->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order', 'index')->name('order.index');
        Route::get('/order/{customer}/create', 'create')->name('order.create');
        Route::post('/order', 'store')->name('order.store');
        Route::get('/order/{order}/show', 'show')->name('order.show');
    });
});


//For Finance
Route::middleware(['auth','department:Finance,Admin,Management'])->group(function () {
    Route::prefix('finance')->group(function () {
        Route::name('finance.')->group(function () {
            Route::controller(FinanceController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
            });

            Route::controller(PaymentRequestController::class)->group(function () {
                Route::get('/request', action: 'index')->name('request.index');
                Route::get('/request/{request}/show', 'show')->name('request.show');
                Route::get('/request/{request}/{status}/update', 'update')->name('request.update');
            });

            Route::controller(SupplierPaymentController::class)->group(function () {
                Route::prefix('supplier')->group(function () {
                    Route::name('supplier.')->group(function () {

                        Route::get('/payment', action: 'index')->name('payment.index');
                        Route::get('/payment/{request}/create', action: 'create')->name('payment.create');
                        Route::post('/payment/{request}', action: 'store')->name('payment.store');

                    });
                });
            });

        });
    });
});


//For Production
Route::middleware(['auth','department:Production,Admin,Management'])->group(function () {
    Route::prefix('production')->group(function () {
        Route::name('production.')->group(function () {

            Route::controller(ProductionController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
            });

            Route::controller(MaterialController::class)->group(function () {
                Route::get('/material', 'index')->name('material.index');
                Route::get('/material/create', 'create')->name('material.create');
                Route::post('/material', 'store')->name('material.store');
                Route::get('/material/{material}/edit', 'edit')->name('material.edit');
                Route::patch('/material/{material}', 'update')->name('material.update');
            });

            Route::prefix('material')->group(function () {
                Route::name('material.')->group(function () {

                    Route::controller(MaterialPurchaseController::class)->group(function () {
                        Route::get('/purchase', 'index')->name('purchase.index');
                        Route::get('/purchase/create', 'create')->name('purchase.create');
                        Route::post('/purchase', 'store')->name('purchase.store');
                    });
                });
            });


        });
    });
});


//For Tea Department
Route::middleware(['auth','department:Tea,Admin,Marketing,Management'])->group(function () {
    Route::prefix('tea')->group(function () {
        Route::name('tea.')->group(function () {

            Route::controller(TeaController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
            });

            Route::controller(TeaTypeController::class)->group(function () {
                Route::get('/teaType', 'index')->name('teaType.index');
                Route::get('/teaType/create', 'create')->name('teaType.create');
                Route::post('/teaType', 'store')->name('teaType.store');
                Route::get('/teaType/{tea}/edit', 'edit')->name('teaType.edit');
                Route::patch('/teaType/{tea}/edit', 'update')->name('teaType.update');
                Route::get('/teaType/{tea}/edit/priceList', 'editPriceList')->name('teaType.edit.price.list');
                Route::patch('/teaType/{tea}/edit/priceList', 'updatePriceList')->name('teaType.update.price.list');
            });

            Route::controller(TeaPerchaseController::class)->group(function () {
                Route::get('/purchase', 'index')->name('purchase.index');
                Route::get('/purchase/create', 'create')->name('purchase.create');
                Route::post('/purchase', 'store')->name('purchase.store');
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

//For Warehouse
Route::middleware(['auth','department:Admin,Warehouse'])->group(function () {
    Route::prefix('warehouse')->group(function () {
        Route::name('warehouse.')->group(function () {
            Route::controller(WarehouseController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
            });

            Route::controller(InventoryTransactionsController::class)->group(function () {
                Route::get('/inventory', 'index')->name('inventory.index');
                Route::get('/inventory/{transactionId}/show', 'show')->name('inventory.show');
                Route::patch('/inventory/{transactionId}/update', 'update')->name('inventory.update');
            });
        });
    });
});











