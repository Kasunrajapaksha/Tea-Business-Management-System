<x-app-layout>
    <x-slot:title>Marketing | Customer</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('management.index') }}'>Marketing</a></li>
           <li class="breadcrumb-item"><a href="{{ route('marketing.customer.create') }}"></a>Customer</li>
           <li class="breadcrumb-item active">Create Customer</li>
       </ol>
   </nav>

    <h1>Create Customer</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('marketing.customer.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name')}}">
                            <x-error field="first_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name')}}">
                            <x-error field="last_name" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email')}}">
                                <x-error field="email" />
                            </div>

                            <div class="mb-3 col-md-6">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ old('number')}}">
                                    <x-error field="number" />
                                </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="5">{{ old('address')}}</textarea>
                                <x-error field="address" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Add Customer</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
