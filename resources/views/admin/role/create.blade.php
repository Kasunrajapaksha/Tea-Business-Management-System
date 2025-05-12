<x-app-layout>
    <x-slot:title>Admin | Role</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}">Department</a></li>
            <li class="breadcrumb-item active">Create Role</li>
        </ol>
    </nav>

    <h1>Create Role</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title">
                        Add Role For {{ $department->department_name}} Department
                    </div>
                </div>
                <div class="card-body pt-0">

                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <input type="text" name="department_id" value="{{$department->id}}" hidden>
                        <div>
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name">
                            <x-error field="role_name" />
                        </div>
                        <div>
                            <a href="{{ route('admin.department.index') }}" class="btn btn-danger mt-2">cancel</a>
                            <button type="submit" class="btn btn-primary mt-2">Add Role</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
