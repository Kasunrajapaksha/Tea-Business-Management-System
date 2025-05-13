@php
    $sidebarLinks = \App\Services\SidebarService::getSidebarRoutes();
@endphp


<nav id="sidebar" class="sidebar js-sidebar ">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">TBMS</span>
        </a>

        <div class="sidebar-user">
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
            <li class="sidebar-header">
                Main
            </li>


            <li class="sidebar-item {{ request()->routeIs($sidebarLinks['dashboard']) ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route($sidebarLinks['dashboard']) }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>



            @can('view', App\Models\Department::class)
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
                        <i class="align-middle" data-feather="user"></i>
                        <span class="align-middle">User</span>
                    </a>
                </li>
            @endcan

            @can('view', App\Models\Customer::class)
                <li class="sidebar-item {{ request()->routeIs('marketing.customer.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('marketing.customer.index') }}">
                        <i class="align-middle" data-feather="user"></i>
                        <span class="align-middle">Customer</span>
                    </a>
                </li>
            @endcan

                <li class="sidebar-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('notifications.index') }}">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="align-middle">Notifications</span>
                    </a>
                </li>

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">

            </div>
        </div>
    </div>
</nav>
