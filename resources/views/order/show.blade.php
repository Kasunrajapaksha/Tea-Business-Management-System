<x-app-layout>
<x-slot:title>Order | Review</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=''>Order</a></li>
        <li class="breadcrumb-item active">Order Review</li>
    </ol>
</nav>

<x-danger-alert />
<x-success-alert />

    <div class="d-flex align-items-center">
        <h1 class="me-3">Order Review</h1>
        <x-status :status='$order->status' />
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
                            <input type="text" class="form-control" value="{{ number_format($order->orderItem->quantity,1) }} Kg" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Total Amount</label>
                            <input type="text" class="form-control" value="USD {{ number_format($order->total_amount,2) }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label  class="form-label">Packing Instractions</label>
                            <textarea class="form-control" disabled>{{ $order->packing_instractions }}</textarea>
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
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label  class="form-label">Address</label>
                            <textarea class="form-control" disabled>{{ $order->customer->address }}</textarea>
                        </div>
                    </div>
                    @if ($order->status >= 12 )
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Planned Production Start</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->production_start : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Planned Production End</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->production_end : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->user->first_name . ' '. $order->productionPlan->user->first_name : ''}}" disabled>
                        </div>
                    </div>
                    @endif
                    @if ($order->status >= 16)
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            @php
                                $diffIndays = \Carbon\Carbon::parse($order->productionPlan->production_start)->diffInDays(\Carbon\Carbon::parse($order->productionPlan->actual_aproduction_start))
                            @endphp
                            <x-label-badge title="Actual Production Start" :diffIndays="$diffIndays" />
                            <input type="text" class="form-control" value="{{ $order->productionPlan->actual_aproduction_start }}" disabled>
                        </div>
                        @if ($order->productionPlan->order->status >= 17)
                        <div class="mb-3 col-md-4">
                            @php
                                $diffIndays = \Carbon\Carbon::parse($order->productionPlan->production_end)->diffInDays(\Carbon\Carbon::parse($order->productionPlan->actual_aproduction_end))
                            @endphp
                            <x-label-badge title="Actual Production End" :diffIndays="$diffIndays" />
                            <input type="text" class="form-control" value="{{ $order->productionPlan->actual_production_end }}" disabled>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if ($order->status >= 13 )
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Date of Shipping</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 13 ? 'During the month of ' . \Carbon\Carbon::parse($order->shippingSchedule->departure_date)->format('F Y') : ''}}" disabled>
                        </div>
                        {{-- <div class="mb-3 col-md-4">
                            <label  class="form-label">Shipping Provider</label>
                            <input type="text" class="form-control" value="{{ $order->shippingSchedule->shippingProvider  ? $order->shippingSchedule->shippingProvider->provider_name : ''}}" disabled>
                        </div> --}}
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 13 ? $order->shippingSchedule->user->first_name . ' ' . $order->shippingSchedule->user->last_name : ''}}" disabled>
                        </div>
                    </div>
                    @endif
                    @if ($order->status >= 15)
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Customer Payment No</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 15 ? $order->proformaInvoice->customerPayment->customer_payment_no : '' }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Customer Paid On</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 15 ? $order->proformaInvoice->customerPayment->paid_at : '' }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 15 ? $order->proformaInvoice->customerPayment->user->first_name . ' ' . $order->proformaInvoice->customerPayment->user->last_name : '' }}" disabled>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('order.index') }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                            @can('delete', $order)
                            <a class="btn btn-danger ms-1 mt-2" data-bs-toggle="modal" data-bs-target="#canceled">Cancel the Order</a>
                            @endcan
                            @can('update', $order)
                            <a href="{{ route('order.edit', $order) }}" class="btn btn-primary ms-2 mt-2">Update Order</a>
                            @endcan
                            @can('create', App\Models\ProductionPlan::class)
                                @if ($order->status == 11)
                                <a href="{{ route('production.plan.create', $order) }}" class="btn btn-primary mt-2 ms-2">Update Production Plan</a>
                                @endif
                            @endcan
                            @can('create', App\Models\ShippingSchedule::class)
                                @if ($order->status == 12 )
                                <a href="{{ route('shipping.schedule.create', $order) }}" class="btn btn-primary mt-2 ms-2">Update Shipping Schedule</a>
                                @endif
                            @endcan
                            @can('create', App\Models\ProformaInvoice::class)
                                @if ($order->status == 13 )
                                <a href="{{ route('marketing.invoice.create', $order) }}" class="btn btn-primary mt-2 ms-2">Create Proforma Invoice</a>
                                @endif
                            @endcan
                            @can('create', App\Models\CustomerPayment::class)
                                @if ($order->status == 14 )
                                <a href="{{ route('finance.customer.payment.create', $order) }}" class="btn btn-primary mt-2 ms-2">Update Customer Payment</a>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>


<div class="modal fade" id="canceled" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Are you sure do you want to cancel the order?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('order.cancel', $order) }}" method="post">
            @csrf
            @method('patch')
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
