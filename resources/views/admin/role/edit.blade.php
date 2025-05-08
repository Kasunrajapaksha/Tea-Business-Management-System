<x-admin-layout>
    <x-slot:title>role</x-slot:title>

    <h3>Edit Role</h3>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.role.update', $role) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->role_name }}">
                            @error('role_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" name="department_id">
                                @if ($role->department->status == 0)
                                    <option value="#">Choose a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id}}">{{ $department->department_name}}</option>
                                    @endforeach
                                @else
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id}}" {{ $department->id == $role->department->id ? 'selected' : '' }}>{{ $department->department_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('department_id')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ $role->status == 1 ? 'selected' : '' }}>Activate</option>
                                <option value="0" {{ $role->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
