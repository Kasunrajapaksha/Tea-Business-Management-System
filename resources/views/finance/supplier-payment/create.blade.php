<x-app-layout>
<x-slot:title>Finance | Supplier Payment</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=''>Finance</a></li>
            <li class="breadcrumb-item active">Supplier Payment</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center">
        <h1 class="me-3">Supplier Payment</h1>
        <x-status :status='$request->status' />
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('finance.supplier.payment.store',$request) }}" method="post">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                            <div class="row">
                                <div class="col-6">
                                    <label for="transaction_reference"  class="form-label"></sup> Transaction Reference No</label>
                                    <input type="text" class="form-control" name="transaction_reference">
                                    <x-error field="transaction_reference" />
                                </div>
                                <div class="col-6">
                                    <label for="paid_at" class="form-label">Select Paid Date</label>
                                    <input type="date" class="form-control" name="paid_at" max="{{ date('Y-m-d')}}">
                                    <x-error field="paid_at" />
                                </div>
                            </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('finance.request.show', $request) }}" class="btn btn-secondary mt-2">Colse</a>
                            @can('update', $request)
                            <a class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#supplierPayment">Confirm Supplier Payment</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="supplierPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update the supplier payment?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
