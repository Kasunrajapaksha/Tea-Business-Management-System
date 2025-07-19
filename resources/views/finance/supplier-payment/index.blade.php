<x-app-layout>
    <x-slot:title>Finance | Supplier Payments</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('finance.index') }}'>Finance</a></li>
            <li class="breadcrumb-item active">Supplier Payments</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">Supplier Payments</h1>
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
                                        <th class="d-none d-xl-table-cell">Supplier</th>
                                        <th class="d-none d-xl-table-cell">Itam</th>
                                        <th class="d-none d-xl-table-cell">Amount (LKR)</th>
                                        <th class="d-none d-md-table-cell">Paid at</th>
                                        <th class="d-none d-md-table-cell">Paid by</th>
                                        <th class="d-none d-md-table-cell">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->supplier->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_request->material_perchese ? $payment->payment_request->material_perchese->material->material_name : $payment->payment_request->tea_perchese->tea->tea_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ number_format($payment->amount) }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->paid_at }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->user->first_name . ' ' . $payment->user->last_name }}</td>
                                            <td class="d-none d-xl-table-cell">
                                                @can('view', App\Models\SupplierPayment::class)
                                                <a href="{{ route('finance.supplier.payment.show', $payment) }}" class="btn btn-sm btn-primary">Review</a>
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

<div class="col-12 px-3">
        {{ $payments->links() }}
    </div>

</x-app-layout>
