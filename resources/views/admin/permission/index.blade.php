<x-app-layout>
    <x-slot:title>Admin | Permissions</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item active"><a>Permissions</a></li>
        </ol>
    </nav>

    <x-success-alert />

    <h1>Permissions</h1>

    <div class="row">
        <div class="col-12 col-lg-4">

            <form action="{{ route('admin.permission.storeRolePermission') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title">Select Role</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="input-group mb-3">
                            <select multiple class="form-select flex-grow-1" name="role_id" id="role_id"
                                size="12">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Permissions</button>
                    </div>
                </div>

        </div>

        <div class="col-12 col-lg-8">
                <div class="card">

                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Permission List</h5>
                    </div>

                    <div class="card-body pt-0">
                        <hr>

                        <div class="row">
                            @foreach ($permissions as $index => $Permission)
                                <div class="col-3 mb-3">
                                    <label class="form-label form-check m-0">
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            data-permission-id="{{ $Permission->id }}" value="{{ $Permission->id }}">
                                        <span class="form-check-label">{{ $Permission->permission_name }}</span>
                                    </label>
                                </div>
                                <!-- Optional: Break the loop into a new row after 3 checkboxes for each row -->
                                @if (($index + 1) % 4 == 0)
                        </div>

                        <div class="row">
                            @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
