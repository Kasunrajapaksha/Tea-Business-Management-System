<x-app-layout>
    <x-slot:title>Admin | Permissions</x-slot:title>

    <h1>Add Permissions</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.permission.store', $role) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="permission_name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" id="permission_name" name="permission_name">
                            <x-error field="permission_name" />
                        </div>

                        <a href="{{ route('admin.permission.index', $role) }}" class="btn btn-danger mt-3">Close</a>
                        <button type="submit" class="btn btn-primary mt-3">Add Permission</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
