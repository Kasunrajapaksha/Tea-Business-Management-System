<x-app-layout>
    <x-slot:title>Admin | User</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active">All Users</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\User::class)
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add User</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Users</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none d-xl-table-cell">User No</th>
                                <th class="d-none d-xl-table-cell">Username</th>
                                <th class="d-none d-xl-table-cell">Full Name</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Department</th>
                                <th class="d-none d-xl-table-cell">Role</th>
                                <th>Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td><img src="{{ $user->image ? asset('storage/' . $user->image) : asset('admin_asset/img/avatars/avatar.jpg') }}" width="32" height="32" class="rounded-circle my-n1"></td>
                                    <td class="d-none d-xl-table-cell">{{ $user->user_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->username}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->first_name . ' ' . $user->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->email}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->department->department_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->role->role_name}}</td>

                                    @if($user->status === 0)
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                    @elseif ($user->status === 1)
                                        <td><span class="badge bg-success">Active</span></td>
                                    @endif

                                    <td class="d-none d-xl-table-cell">
                                        @can('update', $user)
                                            <a href="{{ route('admin.user.edit', $user) }}"><i class="align-middle" data-feather="edit"></i></a>
                                        @else
                                            <a href="#"><i class="align-middle me-1" data-feather="slash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
