<x-app-layout>
    <x-slot:title>Admin | User</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>

     <x-danger-alert />

    <h1>Edit User</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.user.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                <x-error field="" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                <x-error field="email" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="department_id" class="form-label">Department</label>
                                <select class="form-select" name="department_id" id="user_department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $user->department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-error field="department_id" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" name="role_id" id="user_role_id" data-selected-role-id="{{ $user->role->id ?? '' }}">
                                    <option value="#">Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-error field="role_id" />
                            </div>



                            <div class="mb-3 col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Activate</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <x-error field="status" />
                            </div>

                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('admin.user.show',$user) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update',$user)
                                <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateUser">Update User</a>
                                @endcan
                            </div>
                        </div>

                        <div class="modal fade" id="updateUser" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to update the User?</h4>
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

