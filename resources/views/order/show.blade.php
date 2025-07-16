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
                            <input type="text" class="form-control" value="{{ $order->orderItem->quantity }} Kg" disabled>
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
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Production Start</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->production_start : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Production End</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->production_end : ''}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Materials</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionMaterial->material->material_name : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Units</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionMaterial->units : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 12 ? $order->productionPlan->user->first_name . ' '. $order->productionPlan->user->first_name : ''}}" disabled>
                        </div>
                    </div>
                    @endif
                    @if ($order->status >= 13 )
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Date of Shipping</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 13 ? 'During the month of ' . \Carbon\Carbon::parse($order->shippingSchedule->departure_date)->format('F Y') : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Shipping Provider</label>
                            <input type="text" class="form-control" value="{{ $order->status >= 13 ? $order->shippingSchedule->shippingProvider->provider_name : ''}}" disabled>
                        </div>
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
                            @can('update', $order)
                            <a href="{{ route('order.edit', $order) }}" class="btn btn-primary ms-2">Update Order</a>
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


