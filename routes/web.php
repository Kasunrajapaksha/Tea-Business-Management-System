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
use App\Http\Controllers\Finance\CustomerPaymentController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Finance\PaymentRequestController;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Marketing\CustomerController;
use App\Http\Controllers\Marketing\MarketingController;
use App\Http\Controllers\Marketing\ProformaInvoiceController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Production\MaterialPurchaseController;
use App\Http\Controllers\Production\MaterialController;
use App\Http\Controllers\Production\ProductionController;
use App\Http\Controllers\Production\ProductionPlanController;
use App\Http\Controllers\Shipping\ShippingController;
use App\Http\Controllers\Shipping\ShippingProviderController;
use App\Http\Controllers\Shipping\ShippingScheduleController;
use App\Http\Controllers\Supply\SupplierPaymentController;
use App\Http\Controllers\Supply\SupplierController;
use App\Http\Controllers\Tea\TeaController;
use App\Http\Controllers\Tea\TeaPerchaseController;
use App\Http\Controllers\Warehouse\InventoryTransactionsController;
use App\Http\Controllers\Warehouse\WarehouseController;
use App\Models\ShippingProvider;

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
                Route::get('/report/customer', 'customerReport')->name('report.customer');
                Route::get('/report/order', 'orderReport')->name('report.order');
                Route::get('/report/supplier/payament', 'supplierPayament')->name('report.supplier.payament');
                Route::get('/report/tea/purchase', 'teaPurchase')->name('report.tea.purchase');

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
        Route::get('/supplier/{supplier}/edit', 'edit')->name('supplier.edit');
        Route::get('/supplier/{supplier}', 'show')->name('supplier.show');
        Route::patch('/supplier/{supplier}', 'update')->name('supplier.update');
        Route::delete('/supplier/{supplier}', 'destroy')->name('supplier.destroy');
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

            Route::controller(ProformaInvoiceController::class)->group(function () {
                Route::get('/invoice',  'index')->name('invoice.index');
                Route::get('/invoice/{invoice}/generate',  'generate')->name('invoice.generate');
                Route::get('/invoice/{order}/create',  'create')->name('invoice.create');
                Route::post('/invoice/{order}',  'store')->name('invoice.store');
                Route::get('/invoice/{invoice}',  'show')->name('invoice.show');
                Route::get('/invoice/{invoice}/edit',  'edit')->name('invoice.edit');
                Route::patch('/invoice/{invoice}',  'update')->name('invoice.update');
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
        Route::get('/order/{order}', 'edit')->name('order.edit');
        Route::patch('/order/{order}', 'update')->name('order.update');
        Route::patch('/order/{order}/{status}', 'updateStatus')->name('order.status.update');
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
                Route::get('/request/{request}/cancel', 'cancel')->name('request.cancel');
            });

            Route::controller(SupplierPaymentController::class)->group(function () {
                Route::prefix('supplier')->group(function () {
                    Route::name('supplier.')->group(function () {
                        Route::get('/payment', action: 'index')->name('payment.index');
                        Route::get('/payment/{request}/create', action: 'create')->name('payment.create');
                        Route::post('/payment/{request}', action: 'store')->name('payment.store');
                        Route::get('/payment/{payment}', action: 'show')->name('payment.show');
                        Route::get('/payment/{payment}/edit', action: 'edit')->name('payment.edit');
                        Route::patch('/payment/{payment}', action: 'update')->name('payment.update');

                    });
                });
            });

            Route::controller(CustomerPaymentController::class)->group(function () {
                Route::prefix('customer')->group(function () {
                    Route::name('customer.')->group(function () {
                        Route::get('/payment', 'index')->name('payment.index');
                        Route::get('/payment/{order}/create', 'create')->name('payment.create');
                        Route::post('/payment/store', 'store')->name('payment.store');
                        Route::get('/payment/{payment}/show', 'show')->name('payment.show');
                        Route::get('/payment/{payment}/edit', 'edit')->name('payment.edit');
                        Route::patch('/payment/{payment}/update', 'update')->name('payment.update');
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
                Route::get('/material/{material}/show', 'show')->name('material.show');
                Route::post('/material', 'store')->name('material.store');
                Route::get('/material/{material}/edit', 'edit')->name('material.edit');
                Route::patch('/material/{material}', 'update')->name('material.update');
                Route::delete('/material/{material}', 'destroy')->name('material.destroy');
            });

            Route::prefix('material')->group(function () {
                Route::name('material.')->group(function () {
                    Route::controller(MaterialPurchaseController::class)->group(function () {
                        Route::get('/purchase', 'index')->name('purchase.index');
                        Route::get('/purchase/create', 'create')->name('purchase.create');
                        Route::get('/purchase/{purchase}', 'show')->name('purchase.show');
                        Route::get('/purchase/{purchase}/edit', 'edit')->name('purchase.edit');
                        Route::post('/purchase', 'store')->name('purchase.store');
                        Route::patch('/purchase/{purchase}', 'update')->name('purchase.update');
                        Route::delete('/purchase/{purchase}', 'destroy')->name('purchase.destroy');
                    });
                });
            });

            Route::controller(ProductionPlanController::class)->group(function () {
                Route::get('/plan', 'index')->name('plan.index');
                Route::get('/plan/{order}/create', 'create')->name('plan.create');
                Route::post('/plan/store', 'store')->name('plan.store');
                Route::get('/plan/{plan}/show', 'show')->name('plan.show');
                Route::get('/plan/{plan}/edit', 'edit')->name('plan.edit');
                Route::patch('/plan/{plan}', 'update')->name('plan.update');
                Route::patch('/plan/{plan}/update/plan/dates', 'planDates')->name('plan.update.plan.dates');
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
                Route::get('/teaType/{tea}', 'show')->name('teaType.show');
                Route::patch('/teaType/{tea}/edit', 'update')->name('teaType.update');
                Route::get('/teaType/{tea}/edit/priceList', 'editPriceList')->name('teaType.edit.price.list');
                Route::patch('/teaType/{tea}/edit/priceList', 'updatePriceList')->name('teaType.update.price.list');
                Route::delete('/teaType/{tea}', 'destroy')->name('teaType.destroy');
            });

            Route::controller(TeaPerchaseController::class)->group(function () {
                Route::get('/purchase', 'index')->name('purchase.index');
                Route::get('/purchase/create', 'create')->name('purchase.create');
                Route::post('/purchase', 'store')->name('purchase.store');
                Route::get('/purchase/{purchase}', 'show')->name('purchase.show');
                Route::get('/purchase/{purchase}/edit', 'edit')->name('purchase.edit');
                Route::patch('/purchase/{purchase}', 'update')->name('purchase.update');
                Route::delete('/purchase/{purchase}', 'destroy')->name('purchase.destroy');
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
Route::middleware(['auth','department:Shipping,Admin,Management'])->group(function () {
    Route::prefix('shipping')->group(function () {
        Route::name('shipping.')->group(function () {
            Route::controller(ShippingController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('index');
                Route::get('/profile', 'show')->name('show');
            });

            Route::controller(ShippingScheduleController::class)->group(function () {
                Route::get('/schedule','index')->name('schedule.index');
                Route::get('/schedule/{order}/create', 'create')->name('schedule.create');
                Route::post('/schedule/store', 'store')->name('schedule.store');
                Route::get('/schedule/{schedule}/show', 'show')->name('schedule.show');
                Route::get('/schedule/{schedule}/edit', 'edit')->name('schedule.edit');
                Route::patch('/schedule/{schedule}', 'update')->name('schedule.update');
                Route::patch('/schedule/{schedule}/update/status', 'updateStatus')->name('schedule.update.status');
            });

            Route::controller(ShippingProviderController::class)->group(function () {
                Route::get('/provider', 'index')->name('provider.index');
                Route::get('/provider/create', 'create')->name('provider.create');
                Route::post('/provider/store', 'store')->name('provider.store');
                Route::get('/provider/{provider}/show', 'show')->name('provider.show');
                Route::get('/provider/{provider}/edit', 'edit')->name('provider.edit');
                Route::patch('/provider/{provider}', 'update')->name('provider.update');
                Route::delete('/provider/{provider}', 'destroy')->name('provider.destroy');
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
                Route::get('/inventory/{transaction}/show', 'show')->name('inventory.show');
                Route::get('/inventory/{transaction}/show/outgoing', 'showOutgoing')->name('inventory.show.outgoing');
                Route::patch('/inventory/{transaction}/update', 'update')->name('inventory.update');
            });
        });
    });
});











