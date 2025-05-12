<x-app-layout>
    <x-slot:title>Admin | User</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
           <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
           <li class="breadcrumb-item active">Create User</li>
       </ol>
   </nav>

    <h1>Create User</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name')}}">
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name')}}">
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username')}}">
                                <x-error field="username" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
                                <x-error field="email" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <x-error field="password" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                <x-error field="password_confirmation" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="department_id" class="form-label">Department</label>
                                <select class="form-select" name="department_id" >
                                    <option value="#">Choose a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id}}">{{ $department->department_name}}</option>
                                    @endforeach
                                </select>
                                <x-error field="department_id" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" name="role_id">
                                    <option value="#">Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id}}">{{ $role->role_name}}</option>
                                    @endforeach
                                </select>
                                <x-error field="role_id" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Add User</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
