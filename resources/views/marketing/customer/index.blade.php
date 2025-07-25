<x-app-layout>
<x-slot:title>{{ Auth::user()->department->department_name }} | Customer</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
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
                                <th class="d-none d-xl-table-cell">Orders</th>
                                <th class="d-none d-xl-table-cell">Status</th>
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
                                    <td class="d-none d-xl-table-cell"><span class="badge bg-info">{{ $customer->order->count()}} Orders</span></td>

                                    <td><x-status :status='$customer->status' /></td>
                                        
                                    <td class="d-none d-xl-table-cell" style="width: 150px">
                                        @can('create', App\Models\Order::class)
                                        <a href="{{route('order.create',$customer)}}" class="btn btn-sm btn-secondary mt-1">New Order</a>
                                        @endcan
                                        @can('view', $customer)
                                        <a href="{{route('marketing.customer.show',$customer)}}" class="btn btn-sm btn-primary mt-1">Review</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 px-3">
            {{ $customers->links() }}
    </div>

</x-app-layout>
