<x-app-layout>
    <x-slot:title> Shipping | Shipping Schadule </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Schadule</li>
       </ol>
   </nav>

   <x-success-alert />
   <x-danger-alert />

   <div class="d-flex align-items-center">
        <h1 class="me-3">Shipping Schadule</h1>
        <x-status :status='$schedule->order->status' />
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order No</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->order_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->order_date->format('Y-m-d') }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order by</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->user->first_name . ' ' . $schedule->order->user->last_name }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Order Item</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->orderItem->tea->tea_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Quantity</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->orderItem->quantity }} Kg" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label">Total Amount</label>
                                <input type="text" class="form-control" value="USD {{ number_format($schedule->order->total_amount,2) }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label  class="form-label">Packing Instractions</label>
                                <textarea class="form-control" disabled>{{ $schedule->order->packing_instractions }}</textarea>
                            </div>
                        </div>
                        <hr>
                        @if ($schedule->order->status >= 19 )
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label  class="form-label" >Shipping Provider</label>
                                <input type="text" class="form-control" value="{{ $schedule->shippingProvider ? $schedule->shippingProvider->provider_name : '' }}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label" >Vessel Name</label>
                                <input type="text" class="form-control" value="{{ $schedule->vessel ? $schedule->vessel->vessel_name : ''}}" disabled>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label  class="form-label" >Vessel No</label>
                                <input type="text" class="form-control" value="{{ $schedule->vessel ? $schedule->vessel->tracking_number : '' }}" disabled>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Planned Departure Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->departure_date }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Planned Arrival Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->arrival_date }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Departure Port</label>
                                <input type="text" class="form-control" value="{{ $schedule->departure_port }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Arrival Port</label>
                                <input type="text" class="form-control" value="{{ $schedule->arrival_port}}" disabled>
                            </div>
                        </div>
                        @if ($schedule->order->status >= 19 )
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Actual Departure Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->actual_departure_date }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Actual Arrival Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->actual_arrival_date }}" disabled>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" >Updated at</label>
                                <input type="text" class="form-control" value="{{ $schedule->updated_at->format('Y-m-d')}}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" >Updated by</label>
                                <input type="text" class="form-control" value="{{ $schedule->user->first_name . ' ' . $schedule->user->last_name }}" disabled>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('shipping.schedule.index') }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update',$schedule)
                                <form action="{{ route('shipping.schedule.edit', $schedule) }}">
                                    <button type="submit" class="btn btn-primary mt-2 ms-2">Update Schedule</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateSchadule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the shipping schedule?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('shipping.schedule.update.status', $schedule) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Yes</button>
            </form>
        </div>
    </div>
</div>




