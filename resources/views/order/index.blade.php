<x-app-layout>
<x-slot:title>Order | Dashboard</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Order</a></li>
        <li class="breadcrumb-item active">All Orders</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="d-inline align-middle">All Orders</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Customer Name</th>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                <th class="d-none d-xl-table-cell">Total Amount (USD)</th>
                                <th class="d-none d-xl-table-cell">Order Date</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->customer->first_name . ' ' . $order->customer->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->orderItem->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($order->orderItem->quantity,1) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($order->total_amount,2) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_date->format('Y-m-d') }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$order->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', $order)
                                        <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-primary">Review</a>
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
            {{ $orders->links() }}
    </div>

</x-app-layout>

