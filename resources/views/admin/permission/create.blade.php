<x-app-layout>
    <x-slot:title>Admin | Permissions</x-slot:title>

    <h1>Add Permissions</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.permission.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="permission_name" class="form-label">Permission Name</label>
                            <input type="text" class="form-control" id="permission_name" name="permission_name">
                            <x-error field="permission_name" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Permission</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
