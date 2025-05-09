<x-app-layout>
    <x-slot:title>department</x-slot:title>

    <h3>Add Department</h3>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="permission_name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" id="permission_name" name="permission_name">
                            @error('permission_name')
                                <p class="text-danger text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
