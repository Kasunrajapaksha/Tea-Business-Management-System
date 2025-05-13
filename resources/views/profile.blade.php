<x-app-layout>
    <x-slot:title>Profile</x-slot:title>

    <x-success-alert />

    <h1>Profile</h1>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-3 col-xl-3" id="settings-panel">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>
                    <div class="text-center mb-5">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('admin_asset/img/avatars/avatar.jpg') }}" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                        <h3 class="mt-2 opacity-75">{{ $user->first_name . ' ' . $user->last_name }}</h3>
                        <h5 class="opacity-50">{{ $user->role->role_name }}</h5>
                    </div>
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action disabled" data-bs-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action disabled" data-bs-toggle="list" href="#image"
                            role="tab">
                            Profile image
                        </a>
                        <a class="list-group-item list-group-item-action disabled" data-bs-toggle="list" href="#password" role="tab">
                            Password
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-9">
                <div class="tab-content">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Public info</h5>

                            <form action="{{ route('profile.update', $user) }}" method="POST">
                                @csrf
                                @method('patch')

                                <div class="row">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="first_name" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                                            <x-error field="first_name" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="last_name" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                                            <x-error field="last_name" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                            <x-error field="username" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                            <x-error field="email" />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>

                            </form>

                        </div>
                    </div>
                    {{-- </div> --}}

                    {{-- <div class="tab-pane fade" id="image" role="tabpanel"> --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile image</h5>

                            <form action="{{ route('profile.update.image', $user) }}" method="POST" enctype="multipart/form-data" id="image-upload-form">
                                @csrf
                                @method('patch')

                                <div class="mb-3">
                                    <input type="file" class="form-control" name="image" id="file-upload">
                                    <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Image</button>
                                <button form="delete-image" type="submit" class="btn btn-danger">Delete Current Image</button>

                            </form>

                            <form action="{{ route('profile.update.image', $user) }}" method="POST" id="delete-image" hidden>
                                @csrf
                                @method('delete')
                            </form>

                        </div>
                    </div>
                    {{-- </div> --}}

                    {{-- <div class="tab-pane fade" id="password" role="tabpanel"> --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Password</h5>

                            <form action="{{ route('profile.reset.password') }}" method="POST">
                                @csrf
                                @method('patch')

                                <div class="mb-3 row">
                                    <label class="form-label col-md-3" for="current_password">Current password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="current_password" id="inputPasswordCurrent">
                                        <x-error field="current_password" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="form-label col-md-3" for="password">New password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password"
                                            id="inputPasswordNew">
                                        <x-error field="password" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="form-label col-md-3" for="password_confirmation">Verify
                                        password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="inputPasswordNew2">
                                        <x-error field="password_confirmation" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Change Password</button>

                            </form>
                        </div>
                    </div>
                    {{-- </div> --}}

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
