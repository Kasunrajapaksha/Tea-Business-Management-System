<x-app-layout>
    <x-slot:title>Marketing | Customer</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('management.index') }}'>Marketing</a></li>
           <li class="breadcrumb-item"><a href="{{ route('marketing.customer.create') }}"></a>Customer</li>
           <li class="breadcrumb-item active">Update Customer</li>
       </ol>
   </nav>

   <x-success-alert />

    <h1>Update Customer</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" disabled>
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}" disabled>
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}" disabled>
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-6">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ $customer->number }}" disabled>
                                    <x-error field="number" />
                                </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" disabled>{{ $customer->address}}</textarea>
                                <x-error field="address" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('marketing.customer.index') }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('delete', $customer)
                                <a class="btn btn-danger mt-2 me-1" data-bs-toggle="modal" data-bs-target="#deleteCustomer">Delete Customer</a>
                                @endcan
                                @can('update', $customer)
                                <a href="{{ route('marketing.customer.edit', $customer) }}" class="btn btn-primary mt-2">Edit Customer</a>
                                @endcan
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deleteCustomer" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to delete {{$customer->first_name .' '. $customer->last_name}}?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <form action="{{ route('marketing.customer.destroy', $customer) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>
