<x-app-layout>
    <x-slot:title>Finance | Customer Payment</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Finance</a></li>
           <li class="breadcrumb-item active">Customer Payment</li>
       </ol>
   </nav>

    <h1>Customer Payment</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="paid_at">Paid at</label>
                            <input type="date" class="form-control" name="paid_at" value="{{ $payment->paid_at }}" form="payment-form" min="{{ $payment->proformaInvoice->order->proformaInvoice->issued_at }}">
                            <x-error field="paid_at" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="transaction_reference">Transaction Reference</label>
                            <input type="text" class="form-control" name="transaction_reference" value="{{ $payment->transaction_reference }}" form="payment-form">
                            <x-error field="transaction_reference" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="payment_document">Payment Document</label>
                            <input type="file" class="form-control" name="payment_document" form="payment-form">
                            <x-error field="payment_document" />
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="payment-form">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('finance.customer.payment.show', $payment) }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                        @can('update',$payment)
                        <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateOrder">Update Customer Payment</a>
                        @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the customer payment?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('finance.customer.payment.update', $payment) }}" method="POST" id="payment-form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


