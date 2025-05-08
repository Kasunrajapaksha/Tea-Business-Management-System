<x-admin-layout>
    <x-slot:title>user</x-slot:title>

    <h1>Create User</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Add User</h5>
                    {{-- <h6 class="card-subtitle text-muted">Bootstrap column layout.</h6> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            @error('first_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            @error('last_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                                @error('username')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                                @error('email')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="department_id" class="form-label">Department</label>
                                <select class="form-select" name="department_id">
                                    <option value="#">Choose a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id}}">{{ $department->department_name}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" name="role_id">
                                    <option value="#">Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id}}">{{ $role->role_name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
