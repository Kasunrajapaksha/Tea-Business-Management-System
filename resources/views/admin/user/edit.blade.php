<x-app-layout>
    <x-slot:title>Admin | User</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>

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
                                <select class="form-select" name="department_id">
                                    @if ($user->department->status == 0)
                                        <option value="#">Choose a department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id}}">{{ $department->department_name}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $department->id == $user->department->id ? 'selected' : '' }}>{{ $department->department_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <x-error field="department_id" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" name="role_id">
                                    @if ($user->role->status == 0)
                                        <option value="#">Choose a role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id}}">{{ $role->role_name}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == $user->role->id ? 'selected' : '' }}>{{ $role->role_name}}</option>
                                        @endforeach
                                    @endif
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

                        <button type="submit" class="btn btn-primary mt-2">Edit User</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
