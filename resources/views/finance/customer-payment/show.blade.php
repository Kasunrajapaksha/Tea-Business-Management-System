<x-app-layout>
    <x-slot:title>Finance | Customer Payment</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Finance</a></li>
           <li class="breadcrumb-item active">Customer Payment</li>
       </ol>
   </nav>

   <x-success-alert />

    <h1>Customer Payment</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Invoice No</label>
                            <input type="text" class="form-control" value="{{ $payment->proformaInvoice->invoice_no }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Customer</label>
                            <input type="text" class="form-control" value="{{ $payment->proformaInvoice->order->customer->first_name .' '. $payment->proformaInvoice->order->customer->last_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Total Amount (USD)</label>
                            <input type="text" class="form-control" value="{{ number_format($payment->proformaInvoice->order->total_amount,2)  }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Issued at</label>
                            <input type="text" class="form-control" value="{{ $payment->proformaInvoice->issued_at }}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="paid_at">Paid at</label>
                            <input type="date" class="form-control" name="paid_at" value="{{ $payment->paid_at }}" form="payment-form" disabled>
                            <x-error field="paid_at" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="transaction_reference">Transaction Reference</label>
                            <input type="text" class="form-control" name="transaction_reference" value="{{ $payment->transaction_reference }}" form="payment-form" disabled>
                            <x-error field="transaction_reference" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" >Updated On</label>
                            <input type="text" class="form-control" value="{{ $payment->updated_at->format('Y-m-d') }}" form="payment-form" disabled>
                            <x-error field="transaction_reference" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" >Updated by</label>
                            <input type="text" class="form-control" value="{{ $payment->user->first_name . ' ' . $payment->user->last_name }}" form="payment-form" disabled>
                            <x-error field="transaction_reference" />
                        </div>
                    </div>


                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('finance.customer.payment.index') }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                        @can('update',$payment)
                        <a href="{{ route('finance.customer.payment.edit', $payment) }}" class="btn btn-primary mt-2 ms-2">Edit Customer Payment</a>
                        @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


