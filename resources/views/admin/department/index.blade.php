<x-app-layout>
    <x-slot:title>Admin | Role</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Departments</a></li>
            <li class="breadcrumb-item active">All Departments</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Departments</h1>
        </div>

        @foreach ($departments as $department)
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <div class="row">
                        <div class="d-flex align-items-center">

                            <h3 class="mb-0">{{ $department->department_name . ' Department' }}</h3>

                            <div class="d-flex ms-auto align-items-center">
                                <p class="py-0 px-1 float-end d-flex align-items-center mb-0"><i class="align-middle me-2" data-feather="user"></i> {{ $users->where('department_id', $department->id)->count() }}</p>
                                @can('create', App\Models\Role::class)
                                <a href="{{ route('admin.role.create', $department) }}" class="btn btn-sm btn-primary py-1 px-2 float-end d-flex align-items-center ms-2"><i class="align-middle me-2" data-feather="plus"></i> Add Role</a>
                                @endcan
                            </div>

                        </div>
                        <hr class="mt-2">
                    </div>

                    <div class="row">

                        <div class="card-title">Roles</div>
                        <ul class="list-group list-group-flush px-2 ">
                            @foreach ($department->role as $role )
                            <li class="list-group-item d-flex justify-content-between align-items-center mb-2">

                                <strong class="w-25">{{ $role->role_name }}</strong>
                                @if ($role->status === 1)
                                    <div class="w-25"><span class="badge bg-success ms-auto">Active</span></div>
                                @elseif ($role->status === 0)
                                    <div class="w-25"><span class="badge bg-danger ms-auto">Inactive</span></div>
                                @endif

                                <div class=" d-flex align-items-center w-25">
                                    <ul class="navbar-nav d-none d-lg-flex">
                                        <li class="nav-item dropdown">
                                            @php
                                                $roleUsers = $users->where('role_id', $role->id);
                                            @endphp
                                            @if($roleUsers->count() > 0)
                                            <a class="nav-link dropdown-toggle" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Users
                                            </a>
                                            <div class="dropdown-menu" id="dropdown" aria-labelledby="resourcesDropdown">
                                                <div class="dropdown-item">

                                                    @foreach ($users->where('role_id', $role->id) as $user)
                                                        <div class="d-flex justify-content-between align-items-center mb-1">

                                                            <a href="{{ route('admin.user.edit', $user) }}" class="text-decoration-none text-black me-3">{{ $user->first_name . ' ' . $user->last_name}}</a>

                                                            @if ($user->status === 1)
                                                                <a href="{{ route('admin.user.edit', $user) }}"  class=""><span class="badge bg-success ms-auto">Active</span></a>
                                                            @elseif ($user->status === 0)
                                                                <a href="{{ route('admin.user.edit', $user) }}"  class=""><span class="badge bg-danger ms-auto">Inactive</span></a>
                                                            @endif

                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            @else
                                                <a >
                                                No Users
                                            </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-flex align-items-center w-25">
                                    @can('update',$role)
                                    <a href="{{ route('admin.role.edit', $role) }}" class="btn btn-sm btn-info float-end  d-flex align-items-center ms-auto"><i class="align-middle me-2" data-feather="edit-2"></i>Edit</a>
                                    @endcan
                                    @can('update', App\Models\Permission::class)
                                    <a href="{{ route('admin.permission.index', $role) }}" class="btn btn-sm btn-dark float-end d-flex align-items-center ms-2"><i class="align-middle me-2" data-feather="eye"></i>Permissions</a>
                                    @endcan
                                </div>

                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>
