<x-app-layout>
    <x-slot:title>Marketing | Customer</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Suppliers</a></li>
           <li class="breadcrumb-item active">Update Supplier</li>
       </ol>
   </nav>

    <h1>Create Supplier</h1>
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
                                <label for="bank_details" class="form-label">Bank Details</label>
                                <textarea class="form-control" name="bank_details" rows="5">{{ $supplier->bank_details }}</textarea>
                                <x-error field="bank_details" />
                            </div>
                        </div>
                        
                        <a href="{{ route('supplier.index') }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Update Supplier</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
