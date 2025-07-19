@php
    $user = Auth::user();
@endphp

<x-app-layout>
<x-slot:title>Wharehouse | Inventory Transactions</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=''>Finance</a></li>
        <li class="breadcrumb-item active">Payment Requests Review</li>
    </ol>
</nav>

    <div class="d-flex align-items-center">
        <h1 class="me-3">Transaction</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                @if ($transaction->tea_purchase)
                                <label  class="form-label">Tea Purchase Number</label>
                                <input type="text" class="form-control" value="{{ $transaction->tea_purchase->tea_purchase_no }}" disabled>
                                @elseif ($transaction->material_purchase)
                                <label  class="form-label">Material Purchase Number</label>
                                <input type="text" class="form-control" value="{{ $transaction->material_purchase->material_purchase_no }}" disabled>
                                @endif
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Item name</label>
                                @if ($transaction->tea)
                                <input type="text" class="form-control" value="{{$transaction->tea->tea_name}}" disabled>
                                @elseif ($transaction->material)
                                <input type="text" class="form-control" value="{{$transaction->material->material_name}}" disabled>
                                @endif
                            </div>

                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Quantity</label>
                                @if ($transaction->tea_purchase)
                                <input type="text" class="form-control" value="{{$transaction->tea_purchase->quantity}} Kg" disabled>
                                @elseif ($transaction->material_purchase)
                                <input type="text" class="form-control" value="{{$transaction->material_purchase->units}}" disabled>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier No</label>
                                <input type="text" class="form-control" value="{{$transaction->supplier ? $transaction->supplier->supplier_no : '' }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" value="{{$transaction->supplier ? $transaction->supplier->name : ''}}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Requested on</label>
                                <input type="text" class="form-control" value="{{ $transaction->created_at->toDateString()}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Requested by</label>
                                @if ($transaction->tea_purchase)
                                <input type="text" class="form-control" value="{{$transaction->tea_purchase->payment_request->requester->first_name . ' ' . $transaction->tea_purchase->payment_request->requester->last_name }}" disabled>
                                @elseif ($transaction->material_purchase)
                                <input type="text" class="form-control" value="{{$transaction->material_purchase->payment_request->requester->first_name . ' ' . $transaction->material_purchase->payment_request->requester->last_name }}" disabled>
                                @endif
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Paid on</label>
                                @if ($transaction->tea_purchase)
                                <input type="text" class="form-control" value="{{$transaction->tea_purchase->payment_request->created_at->toDateString()}}" disabled>
                                @elseif ($transaction->material_purchase)
                                <input type="text" class="form-control" value="{{$transaction->material_purchase->payment_request->created_at->toDateString()}}" disabled>
                                @endif
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label">Paid by</label>
                                @if ($transaction->tea_purchase)
                                <input type="text" class="form-control" value="{{$transaction->tea_purchase->payment_request->handler->first_name . ' ' . $transaction->tea_purchase->payment_request->handler->last_name }}" disabled>
                                @elseif ($transaction->material_purchase)
                                <input type="text" class="form-control" value="{{$transaction->material_purchase->payment_request->handler->first_name . ' ' . $transaction->material_purchase->payment_request->handler->last_name }}" disabled>
                                @endif
                            </div>
                        </div>
                        @if ($transaction->status == 6)
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Dispatch on</label>
                                <input type="text" class="form-control" value="{{ $transaction->updated_at->format('Y-m-d') }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Dispatch by</label>
                                <input type="text" class="form-control" value="{{ $transaction->user->first_name . ' ' . $transaction->user->last_name }}" disabled>
                            </div>
                        </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('warehouse.inventory.index') }}" class="btn btn-secondary mt-3">Close</a>
                            <div class="d-flex align-items-center mt-3">
                                @can('update', $transaction)
                                <a type="button" class="btn btn-lg btn-success mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#oredrReceive">Oredr Received</a>
                                @endcan
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="oredrReceive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm order received!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>
                    @if ($transaction->tea_purchase)
                    - Received <strong>{{ $transaction->tea_purchase->quantity . 'kg ' . $transaction->tea_purchase->tea->tea_name }}</strong> [{{ $transaction->tea_purchase->tea_purchase_no }}] from <strong>{{ $transaction->supplier->name }}</strong>.
                    @elseif ($transaction->material_purchase)
                    - Received <strong>{{ $transaction->material_purchase->units . ' ' . $transaction->material_purchase->material->material_name }}</strong> [{{ $transaction->material_purchase->material_purchase_no }}] from <strong>{{ $transaction->supplier->name }}</strong>.
                    @endif
                </h5>
                <h5>
                    - Updated by <strong>{{ $user->first_name . ' ' . $user->last_name }}</strong> on <strong>{{ now()->format('Y-m-d') }}</strong>.
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('warehouse.inventory.update', $transaction) }}" method="post" id="transaction-update-form">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">Confirm</button>
                    </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
