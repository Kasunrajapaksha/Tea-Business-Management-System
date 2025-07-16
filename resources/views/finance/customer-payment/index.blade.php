<x-app-layout>
    <x-slot:title>Finance | Customer Payments</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('finance.index') }}'>Finance</a></li>
            <li class="breadcrumb-item active">Customer Payments</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">Customer Payments</h1>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <table class="table table-hover table-striped my-0">

                                <thead>
                                    <tr>
                                        <th class="d-none d-xl-table-cell">Payment No</th>
                                        <th class="d-none d-xl-table-cell">Proforma invoice No</th>
                                        <th class="d-none d-xl-table-cell">Customer</th>
                                        <th class="d-none d-xl-table-cell">Transaction Reference</th>
                                        <th class="d-none d-md-table-cell">Paid at</th>
                                        <th class="d-none d-md-table-cell">Order Status</th>
                                        <th class="d-none d-md-table-cell">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($customer_payments as $payment)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $payment->customer_payment_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->proformaInvoice->invoice_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->proformaInvoice->order->customer->first_name . ' ' . $payment->proformaInvoice->order->customer->last_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->transaction_reference }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->paid_at }}</td>

                                            <td class="d-none d-xl-table-cell">
                                        <x-status :status='$payment->proformaInvoice->order->status' />
                                    </td>

                                            <td class="d-none d-xl-table-cell">
                                                @can('view', App\Models\CustomerPayment::class)
                                                <a href="{{ route('finance.customer.payment.show', $payment) }}" class="btn btn-sm btn-primary">Reviwe</a>
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
        </div>



</x-app-layout>
