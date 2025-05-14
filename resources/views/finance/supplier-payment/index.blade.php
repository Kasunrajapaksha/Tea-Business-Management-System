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
                                        <th class="d-none d-xl-table-cell">Request No</th>
                                        <th class="d-none d-xl-table-cell">Supplier</th>
                                        <th class="d-none d-xl-table-cell">Amount</th>
                                        <th class="d-none d-md-table-cell">Pain Date</th>
                                        <th class="d-none d-md-table-cell">Pain By</th>
                                        <th class="d-none d-md-table-cell">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_request->request_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->supplier->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->amount }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->created_at->toDateString() }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->user->first_name . ' ' . $payment->user->last_name }}</td>
                                            <td></td>
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
