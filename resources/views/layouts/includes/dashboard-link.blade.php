@if (Auth::user()->role->role_name == 'Admin')
    
@else
    <li class="sidebar-item {{ request()->routeIs('marketing.index') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('marketing.index') }}">
            <i class="align-middle" data-feather="sliders"></i>
            <span class="align-middle">Dashboard</span>
        </a>
    </li>
@endif
