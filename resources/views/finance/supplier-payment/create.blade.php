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
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Request Number</label>
                                <input type="text" class="form-control" value="{{ $request->request_no}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Supplier No</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->supplier_no}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Handle By</label>
                                <input type="text" class="form-control" value="{{ $request->handler ? $request->handler->first_name . ' ' . $request->handler->last_name : '' }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Amount (LKR)</label>
                                <input type="text" class="form-control" value="{{ $request->amount }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-5 p-2">
                            <div class="mb-3 col-md-6">
                                <div class="row mb-3">
                                    <label  class="form-label">Supplier No</label>
                                    <input type="text" class="form-control" value="{{ $request->supplier->name}}" disabled>
                                </div>
                                <div class="row">
                                    <label  class="form-label">Supplier Bank Details</label>
                                    <textarea class="form-control" rows="5" disabled>{{ $request->supplier->bank_details}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label"><sup class="text-danger">*</sup> Transaction Reference No</label>
                                <input type="text" class="form-control" name="transaction_reference">
                                <x-error field="transaction_reference" />
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('finance.request.index') }}" class="btn btn-dark mt-2">Back</a>
                            @can('update', $request)
                            <button type="submit" class="btn btn-success mt-2">Confirm Supplier Payment</button>
                            @endcan
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
