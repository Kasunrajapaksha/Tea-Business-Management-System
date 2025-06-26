<x-app-layout>
<x-slot:title>Order | Review</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=''>Order</a></li>
        <li class="breadcrumb-item active">Order Review</li>
    </ol>
</nav>

    <div class="d-flex align-items-center">
        <h1 class="me-3">Order Review</h1>
        <x-status :status='$order->status' />
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order No</label>
                                <input type="text" class="form-control" value="{{ $order->order_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order Date</label>
                                <input type="text" class="form-control" value="{{ $order->order_date->format('Y-m-d') }}" disabled>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order by</label>
                                <input type="text" class="form-control" value="{{ $order->user->first_name . ' ' . $order->user->last_name }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order Item</label>
                                <input type="text" class="form-control" value="{{ $order->orderItem->tea->tea_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Quantity</label>
                                <input type="text" class="form-control" value="{{ $order->orderItem->quantity }} Kg" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Total Amount</label>
                                <input type="text" class="form-control" value="USD {{ $order->total_amount }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Customer No</label>
                                <input type="text" class="form-control" value="{{ $order->customer->customer_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Customer</label>
                                <input type="text" class="form-control" value="{{ $order->customer->first_name . ' ' . $order->customer->last_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Customer Payment No</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Customer Paid On</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label  class="form-label">Address</label>
                                <textarea class="form-control" disabled>{{ $order->customer->address }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Production Start</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Production End</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Shipping Date</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('order.index') }}" class="btn btn-dark mt-3">Back</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="oredrReceive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    </div> --}}

</x-app-layout>
