<x-app-layout>
<x-slot:title>Shipping | Shipping Provider</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Shipping</a></li>
        <li class="breadcrumb-item active">All Shipping Provider</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Shipping Provider</h1>
        </div>

        <div class="row d-flex">
            <table class="table table-hover table-striped my-0">

                <thead>
                    <tr>
                        <th class="d-none d-xl-table-cell">Customer No</th>
                        <th class="d-none d-xl-table-cell">Orders</th>
                        <th class="d-none d-xl-table-cell">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($groupedOrders as $customerId => $orders)
                    @php
                        $customer = App\Models\Customer::findOrFail($customerId);
                    @endphp
                    @if ($orders->every(fn($order) => $order->status == 13))
                    <tr>
                        <td>{{ $customer->customer_no }}</td>
                        <td>{{ $orders->count() }}</td>
                        <td><x-status :status='$orders->first()->status' /></td>
                        @foreach ($orders as $order)

                        @endforeach
                        <td>
                            <a href="{{ route('marketing.invoice.show', ['customer' => $orders->first()->customer->id, 'orders' => $orders->pluck('id')->join(',')]) }}"
                                class="btn btn-sm btn-primary">Review</a>
                        </td>
                        </tr>
                    @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{-- <div class="col-12 px-3">
            {{ $groupedOrders->links() }}
    </div> --}}

</x-app-layout>


