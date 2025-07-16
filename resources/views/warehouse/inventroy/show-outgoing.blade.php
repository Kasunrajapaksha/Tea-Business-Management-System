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
                                <label  class="form-label">Order No</label>
                                <input type="text" class="form-control" value="{{ $transaction->production_plan->order->order_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Item</label>
                                @if ($transaction->tea_id)
                                <input type="text" class="form-control" value="{{ $transaction->production_plan->order->orderItem->tea->tea_name }}" disabled>
                                @elseif ($transaction->material_id)
                                <input type="text" class="form-control" value="{{ $transaction->production_plan->order->productionMaterial->material->material_name }}" disabled>
                                @endif
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Quantity</label>
                                @if ($transaction->tea_id)
                                <input type="text" class="form-control" value="{{ number_format($transaction->production_plan->order->orderItem->quantity).' Kg' }}" disabled>
                                @elseif ($transaction->material_id)
                                <input type="text" class="form-control" value="{{ number_format($transaction->production_plan->order->productionMaterial->units). ' Units' }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Requested on</label>
                                <input type="text" class="form-control" value="{{ $transaction->created_at->format('Y-m-d')}}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Requested by</label>
                                <input type="text" class="form-control" value="{{ $transaction->production_plan->user->first_name . ' ' . $transaction->production_plan->user->last_name }}" disabled>
                            </div>
                        </div>
                        @if ($transaction->status == 9)
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
                                <a type="button" class="btn btn-lg btn-success mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#itemDispatch">Item Dispatch</a>
                                @endcan
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="itemDispatch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirmation!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>
                    @if ($transaction->tea_id)
                    - <strong>{{ $transaction->production_plan->order->orderItem->tea->tea_name }} - {{ number_format($transaction->production_plan->order->orderItem->quantity).' Kg' }}</strong> has been released for production.
                    @elseif ($transaction->material_id)
                    - <strong>{{ $transaction->production_plan->order->productionMaterial->material->material_name }} - {{ number_format($transaction->production_plan->order->productionMaterial->units). ' Units' }}</strong> Black Tea has been released for production.
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
