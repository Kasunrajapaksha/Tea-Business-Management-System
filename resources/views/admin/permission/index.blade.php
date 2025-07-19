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
    <x-danger-alert />

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
                                        value="{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked': '' }} @if(in_array($permission->id, [13,14, 15, 16])) disabled @endif>
                                        <span class="form-check-label">{{ $permission->permission_name }}</span>
                                </label>
                                @if($role->department->department_name == 'Admin' && in_array($permission->id, [13,14,15]))
                                    <input type="hidden" name="permissions[]" value="{{ $permission->id }}">
                                @endif
                            </div>
                            @if (($index + 1) % 4 == 0)
                    </div>

                    <div class="row">
                        @endif
                        @endforeach
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.department.index') }}" class="btn btn-secondary mt-2">Close</a>
                        @can('update', $permission)
                        <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updatePermissions">Update {{$role->role_name}} Permissions</a>
                        @endcan
                    </div>

                    <div class="modal fade" id="updatePermissions" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to update the {{$role->role_name}} Permissions?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>

</x-app-layout>
