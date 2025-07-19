<x-app-layout>
<x-slot:title>Finance | Payment Requests</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=''>Finance</a></li>
        <li class="breadcrumb-item active">Payment Requests Review</li>
    </ol>
</nav>

    <div class="d-flex align-items-center">
        <h1 class="me-3">Payment Requests Review</h1>
        <x-status :status='$request->status' />
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Request Number</label>
                                <input type="text" class="form-control" value="{{ $request->request_no}}" disabled>

                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Requested on</label>
                                <input type="text" class="form-control" value="{{ $request->created_at->toDateString() }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Requested by</label>
                                <input type="text" class="form-control" value="{{ $request->requester->first_name . ' ' . $request->requester->last_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Item</label>
                                <input type="text" class="form-control" value="{{ $request->material_perchese ? $request->material_perchese->material->material_name : $request->tea_perchese->tea->tea_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Quantity</label>
                                <input type="text" class="form-control" value="{{ $request->material_perchese ? $request->material_perchese->units : $request->tea_perchese->quantity }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Amount (LKR)</label>
                                <input type="text" class="form-control" value="{{ number_format($request->amount,2) }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier No</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->supplier_no}}" disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier Type</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->type == 1 ? 'Tea' : 'Material' }}" disabled>
                            </div>

                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->name}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->email }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Telephone</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->number }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier Address</label>
                                <textarea class="form-control" rows="5" disabled>{{ $request->supplier->address}}</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier Bank Details</label>
                                <textarea class="form-control" rows="5" disabled>{{ $request->supplier->bank_details}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Updated by</label>
                                <input type="text" class="form-control" value="{{ $request->handler ? $request->handler->first_name . ' ' . $request->handler->last_name : '' }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Updated on</label>
                                <input type="text" class="form-control" value="{{ $request->updated_at->format('Y-m-d') }}" disabled>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('finance.request.index') }}" class="btn btn-secondary mt-2">Close</a>
                            @can('update', $request)
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-danger mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#canceled">Cancel Payment</button>
                                <a href="{{ route('finance.supplier.payment.create', $request) }}" class="btn btn-success mt-2 ms-1">Complete Supplier Payment</a>
                            </div>

                            @endcan

                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="canceled" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Are you sure do you want to cancel the payment request?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('finance.request.cancel', $request) }}" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>

</x-app-layout>
