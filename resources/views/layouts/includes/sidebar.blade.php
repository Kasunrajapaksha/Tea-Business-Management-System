@php
    $sidebarLinks = \App\Services\SidebarService::getSidebarRoutes();
@endphp


<nav id="sidebar" class="sidebar js-sidebar ">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <img src="{{ asset('admin_asset/img/logo/continental_logo-2.png') }}" class="img-fluid ms-4" style="width: 150px">
        </a>

        <div class="sidebar-user my-4">
            <div class="d-flex justify-content-center px-4">
                <div class="flex-shrink-0">
                    <a href="{{ route('profile.index', Auth::user()->id) }}"><img
                            src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('admin_asset/img/avatars/avatar.jpg') }}"
                            class="avatar img-fluid rounded me-1" alt="Charles Hall" /></a>
                </div>
                <div class="flex-grow-1 ps-2 align-middle">
                    <a href="{{ route('profile.index', Auth::user()->id) }}"
                        class="sidebar-user-title text-white opacity-20 text-decoration-none">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                    <div class="sidebar-user-subtitle text-white text-sm opacity-50">{{ Auth::user()->role->role_name }}
                    </div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Main</li>


            <li class="sidebar-item {{ request()->routeIs($sidebarLinks['dashboard']) ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route($sidebarLinks['dashboard']) }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('notifications.index') }}">
                    <i class="align-middle" data-feather="bell"></i>
                    <span class="align-middle">Notifications</span>
                </a>
            </li>

            @can('view', App\Models\Department::class)
            <li class="sidebar-header">Admin</li>

                <li class="sidebar-item {{ request()->routeIs(['admin.department.index', 'admin.department.create']) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.department.index') }}">
                        <i class="align-middle" data-feather="server"></i>
                        <span class="align-middle">Departments</span>
                    </a>
                </li>
            @endcan
            @can('view', App\Models\User::class)
                <li class="sidebar-item {{ request()->routeIs(['admin.user.index', 'admin.user.edit', 'admin.user.create']) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.user.index') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">User</span>
                    </a>
                </li>
            @endcan

            @can('view', App\Models\Customer::class)
            <li class="sidebar-header">Marketing Department</li>
            <li class="sidebar-item {{ request()->routeIs('marketing.customer.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('marketing.customer.index') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Customer</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\Order::class)
            <li class="sidebar-header">Orders</li>

            <li class="sidebar-item {{ request()->routeIs('order.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('order.index') }}">
                    <i class="align-middle" data-feather="package"></i>
                    <span class="align-middle">Order</span>
                </a>
            </li>
            @endcan
            @can('view', App\Models\ProductionPlan::class)
            <li class="sidebar-item {{ request()->routeIs('production.plan.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('production.plan.index') }}">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">Production Plan</span>
                </a>
            </li>
            @endcan
            @can('view',App\Models\ShippingSchedule::class)
            <li class="sidebar-item {{ request()->routeIs('shipping.schedule.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shipping.schedule.index') }}">
                    <i class="align-middle" data-feather="calendar"></i>
                    <span class="align-middle">Shipping schedule</span>
                </a>
            </li>
            @endcan
            @can('view',App\Models\ProformaInvoice::class)
            <li class="sidebar-item {{ request()->routeIs('marketing.invoice.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('marketing.invoice.index') }}">
                    <i class="align-middle" data-feather="file"></i>
                    <span class="align-middle">Proforma Invoice</span>
                </a>
            </li>
            @endcan
            @can('view', App\Models\CustomerPayment::class)
            <li class="sidebar-item {{ request()->routeIs('finance.customer.payment.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('finance.customer.payment.index') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Customer Payments</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\PaymentRequest::class)
            <li class="sidebar-header">Finance Department</li>
            <li class="sidebar-item {{ request()->routeIs('finance.request.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('finance.request.index') }}">
                    <i class="align-middle" data-feather="dollar-sign"></i>
                    <span class="align-middle">Payment Requests</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\SupplierPayment::class)
            <li class="sidebar-item {{ request()->routeIs('finance.supplier.payment.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('finance.supplier.payment.index') }}">
                    <i class="align-middle" data-feather="truck"></i>
                    <span class="align-middle">Supplier Payments</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\Tea::class)
            <li class="sidebar-header">Tea Department</li>

            <li class="sidebar-item {{ request()->routeIs('tea.teaType.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('tea.teaType.index') }}">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Tea</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\TeaPurchase::class)
            <li class="sidebar-item {{ request()->routeIs('tea.purchase.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('tea.purchase.index') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i>
                    <span class="align-middle">Tea Purchase</span>
                </a>
            </li>
            @endcan

            @can('view', App\Models\Material::class)
            <li class="sidebar-header">Production Department</li>

            <li class="sidebar-item {{ request()->routeIs('production.material.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('production.material.index') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i>
                    <span class="align-middle">Materials</span>
                </a>
            </li>
            @endcan


            @can('view', App\Models\MaterialPurchase::class)
            <li class="sidebar-item {{ request()->routeIs('production.material.purchase.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('production.material.purchase.index') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i>
                    <span class="align-middle">Material Purchase</span>
                </a>
            </li>
            @endcan


            @can('view', App\Models\Supplier::class)
            @if(in_array(Auth::user()->department->department_name, ['Admin','Management']))
            <li class="sidebar-header">Supply</li>
            @endIf
            <li class="sidebar-item {{ request()->routeIs('supplier.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('supplier.index') }}">
                    <i class="align-middle" data-feather="truck"></i>
                    <span class="align-middle">Supplier</span>
                </a>
            </li>
            @endcan

            @can('view',App\Models\ShippingProvider::class)
            <li class="sidebar-header">Shippig</li>
            <li class="sidebar-item {{ request()->routeIs('shipping.provider.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shipping.provider.index') }}">
                    <i class="align-middle" data-feather="anchor"></i>
                    <span class="align-middle">Shipping Provider</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('shipping.port.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shipping.port.index') }}">
                    <i class="align-middle" data-feather="anchor"></i>
                    <span class="align-middle">Ports</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('shipping.vessel.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shipping.vessel.index') }}">
                    <i class="align-middle" data-feather="anchor"></i>
                    <span class="align-middle">Vessel</span>
                </a>
            </li>
            @endcan


            @can('view',App\Models\InventoryTransaction::class)
            <li class="sidebar-header">Inventory</li>
            <li class="sidebar-item {{ request()->routeIs('warehouse.inventory.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('warehouse.inventory.index') }}">
                    <i class="align-middle" data-feather="arrow-down-left"></i>
                    <span class="align-middle">Awaiting Stocks</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('warehouse.inventory.index.outgoing') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('warehouse.inventory.index.outgoing') }}">
                    <i class="align-middle" data-feather="arrow-up-right"></i>
                    <span class="align-middle">Pending Stocks</span>
                </a>
            </li>
            @endcan
        </ul>


        <div class="sidebar-cta">
            <div class="sidebar-cta-content">

            </div>
        </div>
    </div>
</nav>
