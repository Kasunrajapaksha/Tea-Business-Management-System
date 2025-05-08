<x-admin-layout>
    <x-slot:title>department</x-slot:title>

    <h3>Edit Department</h3>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.department.update', $department) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $department->department_name}}">
                            @error('department_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ $department->status == 1 ? 'selected' : '' }}>Activate</option>
                                <option value="0" {{ $department->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
