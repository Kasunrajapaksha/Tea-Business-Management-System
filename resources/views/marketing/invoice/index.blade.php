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
                                <th class="d-none d-xl-table-cell">Invoice No</th>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Customer</th>
                                <th class="d-none d-xl-table-cell">Total Value (USD)</th>
                                <th class="d-none d-xl-table-cell">Issued Date</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($invoices as $invoice )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $invoice->invoice_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $invoice->order->order_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $invoice->order->orderItem->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $invoice->order->customer->first_name . ' ' . $invoice->order->customer->first_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format(($invoice->order->productionMaterial->units * $invoice->order->productionMaterial->unit_price) + $invoice->order->total_amount ) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $invoice->issued_at }}</td>


                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$invoice->order->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ProformaInvoice::class)
                                        <a href="{{ route('marketing.invoice.show', $invoice) }}" class="btn btn-sm btn-primary">Review</a>
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

</x-app-layout>

