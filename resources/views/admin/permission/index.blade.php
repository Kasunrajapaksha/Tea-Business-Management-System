<x-app-layout>
    <x-slot:title>Admin | Permissions</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href='{{ route('admin.department.index') }}'>Department</a></li>
            <li class="breadcrumb-item active"><a>Permissions</a></li>
        </ol>
    </nav>

    <x-success-alert />

    @can('create', App\Models\Permission::class)
        <a href="{{ route('admin.permission.create', $role) }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add Permissions</a>
    @endcan

    <div class="mb-3">
        <h1 class="d-inline align-middle">{{$role->role_name}} Permissions</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Permission List</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.permission.update', $role)}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        @foreach ($permissions as $index => $permission)
                            <div class="col-3 mb-3">
                                <label class="form-label form-check m-0">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" data-permission-id="{{ $permission->id }}"
                                        value="{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked': ''}}>
                                        <span class="form-check-label">{{ $permission->permission_name }}</span>
                                </label>
                            </div>
                            @if (($index + 1) % 4 == 0)
                    </div>

                    <div class="row">
                        @endif
                        @endforeach
                    </div>

                    <a href="{{ route('admin.department.index') }}" class="btn btn-danger mt-2">Close</a>
                    <button class="btn btn-primary mt-2">Update {{$role->role_name}} Permissions</button>

                </form>
                </div>
            </div>
        </div>

</x-app-layout>
