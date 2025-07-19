<x-app-layout>
    <x-slot:title>Admin | Role</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}">Department</a></li>
            <li class="breadcrumb-item active">Create Role</li>
        </ol>
    </nav>

    <h1>Create Role</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title">
                        Add Role For {{ $department->department_name}} Department
                    </div>
                </div>
                <div class="card-body pt-0">

                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <input type="text" name="department_id" value="{{$department->id}}" hidden>
                        <div>
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name">
                            <x-error field="role_name" />
                        </div>
                        <div>
                            <a href="{{ route('admin.department.index') }}" class="btn btn-secondary mt-2">Close</a>
                            @can('create', App\Models\Role::class)
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addeRole">Add Role</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="addeRole" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to create a new role?</h4>
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
    </div>
</x-app-layout>
