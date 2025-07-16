<x-app-layout>
<x-slot:title>Finance | Supplier Payment</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=''>Finance</a></li>
            <li class="breadcrumb-item active">Supplier Payment</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="d-flex align-items-center">
        <h1 class="me-3">Supplier Payment</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Payment No</label>
                            <input type="text" class="form-control" value="{{ $payment->payment_no}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Transaction Reference</label>
                            <input type="text" class="form-control" value="{{ $payment->transaction_reference}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Amount (LKR)</label>
                            <input type="text" class="form-control" value="{{ number_format($payment->amount,2) }}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Supplier No</label>
                            <input type="text" class="form-control" value="{{ $payment->supplier->supplier_no}}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" value="{{ $payment->supplier->name}}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Supplier Telephone</label>
                            <input type="text" class="form-control" value="{{ $payment->supplier->number}}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Supplier Email</label>
                            <input type="text" class="form-control" value="{{ $payment->supplier->email}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Supply Item</label>
                            <input type="text" class="form-control" value="{{ $payment->payment_request->material_perchese ? $payment->payment_request->material_perchese->material->material_name : $payment->payment_request->tea_perchese->tea->tea_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Supply Quantity</label>
                            <input type="text" class="form-control" value="{{ $payment->payment_request->material_perchese ? $payment->payment_request->material_perchese->units : $payment->payment_request->tea_perchese->quantity}}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Paid by</label>
                            <input type="text" class="form-control" value="{{ $payment->user->first_name . ' ' . $payment->user->last_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Paid on</label>
                            <input type="text" class="form-control" value="{{ $payment->paid_at }}" disabled>
                        </div>
                    </div>


                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('finance.supplier.payment.index', ) }}" class="btn btn-secondary mt-2">Colse</a>
                        @can('update', $payment)
                        <a href="{{ route('finance.supplier.payment.edit', $payment) }}" class="btn btn-primary">Edit Payment</a>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
