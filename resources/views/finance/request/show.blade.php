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

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Request Number</label>
                                <input type="text" class="form-control" value="{{ $request->request_no}}" disabled>

                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Requested Date</label>
                                <input type="text" class="form-control" value="{{ $request->created_at->toDateString() }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Requested User</label>
                                <input type="text" class="form-control" value="{{ $request->requester->first_name . ' ' . $request->requester->last_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Handle By</label>
                                <input type="text" class="form-control" value="{{ $request->handler->first_name . ' ' . $request->handler->last_name }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Supplier No</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->supplier_no}}" disabled>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Supplier Type</label>
                                <input type="text" class="form-control" value="{{ $request->supplier->type == 1 ? 'Tea' : 'Matterial' }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Amount (USD)</label>
                                <input type="text" class="form-control" value="{{ $request->amount }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier No</label>
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

                        <div class="row">

                        </div>

                        <a href="{{ route('finance.request.index') }}" class="btn btn-danger mt-2">Close</a>
                        <a href="{{ route('finance.request.edit', $request) }}" class="btn btn-primary mt-2">Pay Supplier</a>

                    </form>
                </div>
            </div>
        </div>


    </div>

</x-app-layout>
