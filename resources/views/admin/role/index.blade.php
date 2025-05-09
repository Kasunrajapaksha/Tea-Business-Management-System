<x-app-layout>
    <x-slot:title>Admin | Role</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="#">Role</a></li>
            <li class="breadcrumb-item active">All Roles</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\Role::class)
            <a href="{{ route('admin.role.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center">
            <i class="align-middle me-2" data-feather="plus"></i> Add Role</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Roles</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0 ">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none d-xl-table-cell">Role Name</th>
                                <th class="d-none d-xl-table-cell">Department</th>
                                <th>Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($roles as $role)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $role->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $role->role_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $role->department->department_name }}</td>

                                    @if ($role->status === 0)
                                        <td><span class="badge bg-danger">Inactive</span></td>
                                    @elseif ($role->status === 1)
                                        <td><span class="badge bg-success">Active</span></td>
                                    @endif

                                    <td class="d-none d-xl-table-cell table-action">
                                        @can('update', $role)
                                            <a href="{{ route('admin.role.edit', $role) }}"><i class="align-middle" data-feather="edit"></i></a>
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
