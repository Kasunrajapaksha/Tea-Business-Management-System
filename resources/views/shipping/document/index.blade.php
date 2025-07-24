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
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Invoice No</th>
                                <th class="d-none d-xl-table-cell">Customer Name</th>
                                <th class="d-none d-xl-table-cell">Issued on</th>
                                <th class="d-none d-xl-table-cell">Updated by</th>
                                <th class="d-none d-xl-table-cell">Order Status</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="d-none d-xl-table-cell">{{ $invoice->invoice_no }}</td>
                                <td class="d-none d-xl-table-cell">{{ $invoice->order->first()->customer->first_name . ' ' . $invoice->order->first()->customer->last_name }}</td>
                                <td class="d-none d-xl-table-cell">{{ $invoice->issued_at }}</td>
                                <td class="d-none d-xl-table-cell">{{ $invoice->user->first_name . ' ' . $invoice->user->last_name }}</td>

                                <td><x-status :status='$invoice->order->first()->status' /></td>

                                <td class="d-none d-xl-table-cell">
                                    <a href="{{ route('shipping.document.show', $invoice) }}" class="btn btn-sm btn-primary">Review</a>
                                    <a href="{{ route('shipping.invoice.pdf', ['invoice' => $invoice->id, 'orders' => $invoice->order->pluck('id')->join(',')]) }}"
                                        class="btn btn-sm btn-info" target="_blank"><i class="align-middle" data-feather="eye"></i></a>
                                    <a href="{{ route('shipping.invoice.download', ['invoice' => $invoice->id, 'orders' => $invoice->order->pluck('id')->join(',')]) }}"
                                        class="btn btn-sm btn-secondary" target="_blank"><i class="align-middle" data-feather="download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 px-3">
        {{ $invoices->links() }}
    </div>

</x-app-layout>
