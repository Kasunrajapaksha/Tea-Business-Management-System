<x-app-layout>
    <x-slot:title>Admin | Role</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
            <li class="breadcrumb-item active">Edit Role</li>
        </ol>
    </nav>

    <h1>Edit Role</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.role.update', $role) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name"
                                value="{{ $role->role_name }}">
                            <x-error field="role_name" />
                        </div>

                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" name="department_id">
                                @if ($role->department->status == 0)
                                    <option value="#">Choose a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $department->id == $role->department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-error field="department_id" />
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ $role->status == 1 ? 'selected' : '' }}>Activate</option>
                                <option value="0" {{ $role->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <x-error field="status" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Role</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
