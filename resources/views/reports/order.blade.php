<x-app-layout>
<x-slot:title>Order Report</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Report</a></li>
        <li class="breadcrumb-item active">Orders</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        <div class="card flex-fill mb-3 pb-2">
            <div class="card-body">
                <div>
                    <form method="GET" action="{{ route('admin.report.customer') }}">
                    @csrf
                        <div class="row mb-3">
                            <div class="d-flex justify-content-start col-12">
                                <div class="form-group me-3 col-3">
                                    <label for="end_date">Customer</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select customer</option>
                                    </select>
                                </div>
                                <div class="form-group me-3 col-3">
                                    <label for="end_date">Order Item</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select order item</option>
                                    </select>
                                </div>
                                <div class="form-group me-2 col-3">
                                    <label for="end_date">Status</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select status</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-start col-12">
                                <div class="form-group me-3 col-3">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date') }}">
                                </div>
                                <div class="form-group me-3 col-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date') }}">
                                </div>
                                <div class="form-group me-2 col-3">
                                    <label for="end_date">Handle by</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select User</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark align-self-end ms-auto"><i class="align-middle me-2" data-feather="filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Customer Name</th>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                <th class="d-none d-xl-table-cell">Total Amount</th>
                                <th class="d-none d-xl-table-cell">Order Date</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->customer->first_name . ' ' . $order->customer->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->orderItem->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->orderItem->quantity }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->total_amount }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_date->format('Y-m-d') }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$order->status' />
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

