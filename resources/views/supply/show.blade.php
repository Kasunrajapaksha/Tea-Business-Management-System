<x-app-layout>
    <x-slot:title>Marketing | Customer</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Suppliers</a></li>
           <li class="breadcrumb-item active">Create Supplier</li>
       </ol>
   </nav>

    <h1>Create Supplier</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('supplier.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Supplier name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" disabled>
                            <x-error field="name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $supplier->email }}" disabled>
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ $supplier->number }}" disabled>
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
                                <textarea class="form-control" name="address" rows="5" disabled>{{ $supplier->address }}</textarea>
                                <x-error field="address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="bank_details" class="form-label">Bank Details</label>
                                <textarea class="form-control" name="bank_details" rows="5" disabled>{{ $supplier->bank_details }}</textarea>
                                <x-error field="bank_details" />
                            </div>
                        </div>
                         <div class="d-flex align-items-center justify-content-between">
                             <a href="{{ route('supplier.index') }}" class="btn btn-secondary mt-2">Close</a>
                             <div class="d-flex">
                                @can('delete', $supplier)
                                <a class="btn btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteSupplier">Delete Supplier</a>
                                @endcan
                                @can('update', $supplier)
                                <a href="{{ route('supplier.edit', $supplier) }}" class="btn btn-primary">Edit Supplier</a>
                                @endcan
                             </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deleteSupplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to delete {{ $supplier->name }}?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('supplier.destroy', $supplier) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
