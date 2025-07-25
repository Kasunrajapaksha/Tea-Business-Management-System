<x-app-layout>
    <x-slot:title>{{ Auth::user()->department->department_name }}  | Supplier</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">All Suppliers</a></li>
           <li class="breadcrumb-item "><a href="{{ route('supplier.show',$supplier) }}">{{ $supplier->name }}</a></li>
           <li class="breadcrumb-item active">Edit</li>
       </ol>
   </nav>

   <x-success-alert />

    <h1>Edit Supplier</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('supplier.update', $supplier) }}" method="POST">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Supplier name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}">
                            <x-error field="name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $supplier->email }}">
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ $supplier->number }}">
                                <x-error field="number" />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="type" class="form-label">Supply Type</label>
                                <select class="form-control" id="type" name="type" disabled>
                                    <option>{{ $supplier->type == 01 ? 'Tea' : 'Material' }}</option>
                                </select>
                                <x-error field="type" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="5">{{ $supplier->address }}</textarea>
                                <x-error field="address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <div>
                                    <label for="bank_details" class="form-label">Account Number</label>
                                    <input type="number" class="form-control" id="bank_details" name="bank_details" value="{{ $supplier->bank_details}}">
                                    <x-error field="bank_details" />
                                </div>
                                <div class="mt-3">
                                    <label for="bank_id" class="form-label">Bank</label>
                                    <select name="bank_id" id="bank_id" class="form-select">
                                            <option value="#">Select Bank</option>
                                        @foreach ($banks as $bank )
                                            <option value="{{ $bank->id }}" {{ $supplier->bank->id == $bank->id ? 'selected' : '' }}>{{ $bank->bank_name }}</option>
                                        @endforeach
                                    </select>
                                    <x-error field="bank_id" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('supplier.show', $supplier) }}" class="btn btn-secondary mt-2">Close</a>
                            @can('update', $supplier)
                            <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateSupplier">Update Supplier</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="updateSupplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update the supplier details?</h4>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
