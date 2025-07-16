<x-app-layout>
    <x-slot:title>Shipping | Shipping Schedule</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Shipping Schedule</li>
       </ol>
   </nav>

    <h1>Shipping Schedule</h1>
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
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label  class="form-label">Packing Instractions</label>
                            <textarea class="form-control" disabled>{{ $order->packing_instractions }}</textarea>
                        </div>
                    </div>
                     <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Production Start</label>
                            <input type="text" class="form-control" value="{{ $order->productionPlan ? $order->productionPlan->production_start : ''}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Production End</label>
                            <input type="text" class="form-control" value="{{ $order->productionPlan ? $order->productionPlan->production_end : ''}}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="departure_date">Departure Date</label>
                            <input type="date" class="form-control" name="departure_date" form="shipping-form" min="{{ $order->productionPlan->production_end }}">
                            <x-error field="departure_date" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="arrival_date">Arrival Date</label>
                            <input type="date" class="form-control" name="arrival_date" form="shipping-form" min="{{ $order->productionPlan->production_end }}">
                            <x-error field="arrival_date" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="shipping_provider_id">Shipping Provider</label>
                            <select class="form-select" name="shipping_provider_id" form="shipping-form">
                                <option value="#">Select Shipping Provider</option>
                                @foreach ($providers as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->provider_name }}</option>
                                @endforeach
                            </select>
                            <x-error field="shipping_provider_id" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="vessel_name">Vessel Name</label>
                            <input type="text" class="form-control" name="vessel_name" form="shipping-form">
                            <x-error field="vessel_name" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="departure_port">Departure Port</label>
                            <input type="text" class="form-control" name="departure_port" form="shipping-form">
                            <x-error field="departure_port" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label" for="arrival_port">Arrival Port</label>
                            <input type="text" class="form-control" name="arrival_port" form="shipping-form">
                            <x-error field="arrival_port" />
                        </div>
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id }}" form="shipping-form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="shipping-form">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('order.show', $order) }}" class="btn btn-secondary mt-2">Close</a>
                        @can('create',App\Models\ShippingSchedule::class)
                        <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateOrder">Update Order</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the order?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('shipping.schedule.store') }}" method="POST" id="shipping-form">
            @csrf
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


