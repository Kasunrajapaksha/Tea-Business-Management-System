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
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Order No</label>
                                <input type="text" class="form-control" value="{{ $schedule->order->order_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Created at</label>
                                <input type="text" class="form-control" value="{{ $schedule->created_at->format('Y-m-d')}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Updated at</label>
                                <input type="text" class="form-control" value="{{ $schedule->updated_at->format('Y-m-d')}}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Updated by</label>
                                <input type="text" class="form-control" value="{{ $schedule->user->first_name . ' ' . $schedule->user->last_name }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" >Vessel Name</label>
                                <input type="text" class="form-control" value="{{ $schedule->vessel_name}}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" >Shipping Provider</label>
                                <input type="text" class="form-control" value="{{ $schedule->shippingProvider->provider_name }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Departure Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->departure_date }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Departure Port</label>
                                <input type="text" class="form-control" value="{{ $schedule->departure_port }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Arrival Date</label>
                                <input type="text" class="form-control" value="{{ $schedule->arrival_date }}" disabled>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Arrival Port</label>
                                <input type="text" class="form-control" value="{{ $schedule->arrival_port}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label  class="form-label" >Shipping Cost (USD)</label>
                                <input type="text" class="form-control" value="{{ $schedule->shipping_cost }}" disabled>
                            </div>
                            <div class="mb-3 col-md-9">
                                <label  class="form-label" >Shipping Note</label>
                                <input type="text" class="form-control" value="{{ $schedule->shipping_note}}" disabled>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('shipping.schedule.index') }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update',$schedule)
                                <form action="{{ route('shipping.schedule.edit', $schedule) }}">
                                    <button type="submit" class="btn btn-primary mt-2 ms-1">Update Schedule</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>




