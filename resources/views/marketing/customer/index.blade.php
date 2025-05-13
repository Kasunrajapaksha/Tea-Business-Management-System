<x-app-layout>
<x-slot:title>Customer | Dashboard</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Customer</a></li>
        <li class="breadcrumb-item active">All Customers</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\Customer::class)
            <a href="{{ route('marketing.customer.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add Customer</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Customers</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Customer No</th>
                                <th class="d-none d-xl-table-cell">Customer Name</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Telephone</th>
                                <th class="d-none d-xl-table-cell">Address</th>
                                <th>Orders</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $customer->customer_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->first_name . ' ' . $customer->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->email}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->number}}</td>
                                    <td class="d-none d-xl-table-cell" style="width: 200px">{{ $customer->address}}</td>
                                    <td></td>



                                    <td class="d-none d-xl-table-cell">
                                        @can('update', $customer)
                                            <a href="{{route('marketing.customer.edit',$customer)}}"><i class="align-middle" data-feather="edit"></i></a>
                                        @endcan



                                    <a class=" my-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#customer"
										aria-controls="offcanvasRight"><i class="align-middle ms-2" data-feather="eye"></i></a>



                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="customer" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h3 id="offcanvasRightLabel">Customer Details</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="card">

                <div class="card-header">
                    <div class="card-actions">
                        <h5 class="card-title mb-0">Name</h5>
                    </div>
                </div>

                <div class="card-body">

                    <div class="">
                        <div class="">
                            <div class="mb-2"><strong>No : </strong></div>
                            <div class="mb-2"><strong>Created : </strong></div>
                            <div class="mb-2"><strong>Email : </strong></div>
                            <div class="mb-2"><strong>Telephone : </strong></div>
                            <div class="mb-2"><strong>Address : </strong></div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


</x-app-layout>
