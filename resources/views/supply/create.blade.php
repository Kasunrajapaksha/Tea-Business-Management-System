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
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                            <x-error field="name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ old('number')}}">
                                <x-error field="number" />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="type" class="form-label">Supply Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">Choose a type</option>
                                    <option value="01">Tea</option>
                                    <option value="02">Material</option>
                                </select>
                                <x-error field="type" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="5">{{ old('address')}}</textarea>
                                <x-error field="address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="bank_details" class="form-label">Bank Details</label>
                                <textarea class="form-control" name="bank_details" rows="5">{{ old('bank_details')}}</textarea>
                                <x-error field="bank_details" />
                            </div>
                        </div>

                        <a href="{{ route('supplier.index') }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Add Supplier</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
