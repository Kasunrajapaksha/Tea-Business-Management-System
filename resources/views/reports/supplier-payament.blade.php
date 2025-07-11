<x-app-layout>
    <x-slot:title>Supplier Payament Report</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=''>Report</a></li>
            <li class="breadcrumb-item active">Supplier Payments</li>
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
                                    <label for="end_date">Supplier</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select supplier</option>
                                    </select>
                                </div>
                                <div class="form-group me-3 col-3">
                                    <label for="end_date">Order Item</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select order item</option>
                                    </select>
                                </div>
                                <div class="form-group me-2 col-3">
                                    <label for="end_date">Paid by</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select user</option>
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
                                    <label for="end_date">Supplier Type</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select Type</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark align-self-end ms-auto"><i class="align-middle me-2" data-feather="filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <table class="table table-hover table-striped my-0" id="dataTable">

                                <thead>
                                    <tr>
                                        <th class="d-none d-xl-table-cell">Payment No</th>
                                        <th class="d-none d-xl-table-cell">Supplier</th>
                                        <th class="d-none d-xl-table-cell">Order Item</th>
                                        <th class="d-none d-xl-table-cell">Amount (LKR)</th>
                                        <th class="d-none d-xl-table-cell">Reference</th>
                                        {{-- <th class="d-none d-md-table-cell">Requested by</th>
                                        <th class="d-none d-md-table-cell">Requested on</th> --}}
                                        <th class="d-none d-md-table-cell">Paid by</th>
                                        <th class="d-none d-md-table-cell">Paid on</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->supplier->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_request->tea_perchese ? $payment->payment_request->tea_perchese->tea->tea_name : $payment->payment_request->material_perchese->material->material_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->amount }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->transaction_reference }}</td>
                                            {{-- <td class="d-none d-xl-table-cell">{{ $payment->payment_request->requester->first_name . ' ' . $payment->payment_request->requester->last_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->payment_request->created_at->format('Y-m-d') }}</td> --}}
                                            <td class="d-none d-xl-table-cell">{{ $payment->user->first_name . ' ' . $payment->user->last_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $payment->paid_at }}</td>
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
