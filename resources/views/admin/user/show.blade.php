<x-app-layout>
    <x-slot:title>Admin | User</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="d-flex align-items-center">
        <h1>{{ $user->first_name .' '. $user->last_name}}</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled>
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled>
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" disabled>
                                <x-error field="" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                                <x-error field="email" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="department_id" class="form-label">Department</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->department->department_name }}" disabled>
                                <x-error field="department_id" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="role_id" class="form-label">Role</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->role->role_name }}" disabled>
                                <x-error field="role_id" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <input class="form-control" name="status" value="{{ $user->status == 1 ? 'Activate' : 'Inactive' }}" disabled>
                                <x-error field="status" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update',$user)
                                <a href="{{ route('admin.user.edit',$user) }}" class="btn btn-primary mt-2">Edit User</a>
                                @endcan
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
