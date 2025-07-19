@php
    $sidebarLinks = \App\Services\SidebarService::getSidebarRoutes();
    $notifications = Auth::user()->unreadNotifications->take(6);
@endphp

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            {{-- main/navbar/notification --}}
            <li class="nav-item dropdown me-2">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        @if(!$notifications->isEmpty())
                        <span class="indicator">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                        @endif
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                    aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        @if($notifications->isEmpty())
                            No New Notifications
                        @elseif(Auth::user()->unreadNotifications->count() == 1)
                            New Notification
                        @else
                            {{ Auth::user()->unreadNotifications->count() }} New Notifications
                        @endif
                    </div>
                    @if($notifications->isEmpty())
                    <div class="ms-5">You have no new notifications</div>
                    @else
                    @foreach ($notifications as $notification)
                    <div class="list-group">
                        <a href="{{ $notification->data['route']}}" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-{{ $notification->data['color']}}" data-feather="{{ $notification->data['icon']}}"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">{{ $notification->data['title']}}</div>
                                    <div class="text-muted small mt-1">{{ $notification->data['message']}}</div>
                                    <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @endif

                    <div class="dropdown-menu-footer">
                        <a href="{{ route('notifications.index') }}" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            {{-- main/navbar/notification/ --}}




            {{-- main/navbar/profile --}}
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('admin_asset/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded-circle me-1" />
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile.index', Auth::user()->id) }}"><i class="align-middle me-1"
                            data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" class="dropdown-item" value="Log Out">
                    </form>
                </div>
            </li>
            {{-- main/navbar/profile/ --}}

        </ul>
    </div>
</nav>
