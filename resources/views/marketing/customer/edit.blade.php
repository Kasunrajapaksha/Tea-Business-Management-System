<x-app-layout>
    <x-slot:title>{{ Auth::user()->department->department_name }} | Customer</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('marketing.customer.index') }}'>Marketing</a></li>
           <li class="breadcrumb-item"><a href="{{ route('marketing.customer.show',$customer) }}">{{$customer->first_name .' '. $customer->last_name}}</a></li>
           <li class="breadcrumb-item active">Edit</li>
       </ol>
   </nav>

    <h1>Edit Customer</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('marketing.customer.update', $customer) }}" method="POST">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}">
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}">
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}">
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-4">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ $customer->number }}">
                                    <x-error field="number" />
                                </div>
                                <div class="mb-3 col-md-4">
                                <label for="country_id" class="form-label">Country</label>
                                <select name="country_id" id="	country_id" class="form-select">
                                        <option value="">Select Country</option>
                                        @foreach ($counties as $country )
                                            <option value="{{ $country->id }}" {{ $customer->country->id == $country->id ? 'selected' : '' }}>{{ $country->name}}</option>
                                        @endforeach
                                </select>
                                <x-error field="country_id" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address">{{ $customer->address}}</textarea>
                                <x-error field="address" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('marketing.customer.show', $customer) }}" class="btn btn-secondary mt-2">Close</a>
                            @can('update', $customer)
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateCustomer">Update Customer</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="updateCustomer" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to update the customer?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
