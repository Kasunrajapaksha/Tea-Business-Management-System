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
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->first_name . ' ' . $invoice->order->first()->customer->last_name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer TelePhone</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->number }}" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Email</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->email }}" disabled>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 my-4">
                        <table class="table table-hover table-striped my-0">
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                <th class="d-none d-xl-table-cell">Total Amount (USD)</th>
                                <th class="d-none d-xl-table-cell">Order Date</th>
                            </tr>
                            @foreach ($invoice->order as $order)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->orderItem->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ number_format($order->orderItem->quantity, 1) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_date->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('marketing.document.index') }}" class="btn btn-secondary mt-2">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
