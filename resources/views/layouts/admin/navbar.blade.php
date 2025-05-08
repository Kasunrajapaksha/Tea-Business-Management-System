<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            {{-- main/navbar/notification --}}
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                    aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Restart server 12 to complete the
                                        update.</div>
                                    <div class="text-muted small mt-1">30m ago</div>
                                </div>
                            </div>
                        </a>

                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            {{-- main/navbar/notification/ --}}

            {{-- main/navbar/massages --}}
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                    data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                    aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            4 New Messages
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <img src="img/avatars/avatar-5.jpg"
                                        class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Vanessa Tucker</div>
                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                        tortor.</div>
                                    <div class="text-muted small mt-1">15m ago</div>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all messages</a>
                    </div>
                </div>
            </li>
            {{-- main/navbar/massages/ --}}


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
                    <a class="dropdown-item" href="{{ route('admin.show', Auth::user()->id) }}"><i class="align-middle me-1"
                            data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="post">
                        @csrf
                        <input type="submit" class="dropdown-item" value="Log Out">
                    </form>
                </div>
            </li>
            {{-- main/navbar/profile/ --}}

        </ul>
    </div>
</nav>
