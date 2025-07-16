<x-app-layout>
<x-slot:title>Production | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.purchase.index') }}'>Tea Purchases</a></li>
        <li class="breadcrumb-item active">Purchase Material</li>
    </ol>
</nav>

    <h1>Purchase Material</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('production.material.purchase.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="units" class="form-label">Material Purchase No</label>
                                <input type="text" class="form-control" id="units" name="units" value="{{ $purchase->material_purchase_no }}" disabled>
                                <x-error field="units" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="units" class="form-label">Payment Request No</label>
                                <input type="text" class="form-control" id="units" name="units" value="{{ $purchase->payment_request->request_no }}" disabled>
                                <x-error field="units" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="material_id" class="form-label">Material</label>
                                <select class="form-control" id="material_id" name="material_id" disabled>
                                    <option value="">{{ $purchase->material->material_name }}</option>
                                </select>
                                <x-error field="material_id" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id" disabled>
                                    <option value="">{{ $purchase->supplier->name }}</option>
                                </select>
                                <x-error field="supplier_id" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="units" class="form-label">Units</label>
                                <input type="text" class="form-control" id="units" name="units" value="{{ $purchase->units }}" disabled>
                                <x-error field="units" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price (LKR)</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->unit_price }}" disabled>
                                <x-error field="unit_price" />
                            </div>
                        </div>
                        @if ($purchase->payment_request->handler)
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Review by</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->payment_request->handler->first_name .' '. $purchase->payment_request->handler->last_name }}" disabled>
                                <x-error field="unit_price" />
                            </div>
                            @if ($purchase->payment_request->supplier_payment)
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Paid at</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->payment_request->supplier_payment->paid_at }}" disabled>
                                <x-error field="unit_price" />
                            </div>
                            @endif
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Requested on</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->created_at->format('Y-m-d') }}" disabled>
                                <x-error field="unit_price" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Requested by</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->user->first_name .' '. $purchase->user->last_name }}" disabled>
                                <x-error field="unit_price" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('production.material.purchase.index' ) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('delete', $purchase)
                                <a class="btn btn-danger mt-2 me-1" data-bs-toggle="modal" data-bs-target="#deletePurchase">Cancel Purchase</a>
                                @endcan
                                @can('update', $purchase)
                                <a href="{{ route('production.material.purchase.edit', $purchase ) }}" class="btn btn-primary mt-2">Edit Purchase</a>
                                @endcan
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deletePurchase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to cancel the purchase?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.material.purchase.destroy', $purchase) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>
