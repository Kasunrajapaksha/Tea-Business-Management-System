<x-app-layout>
    <x-slot:title>role</x-slot:title>

    <h3>Create Role</h3>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name">
                            @error('role_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
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
                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
