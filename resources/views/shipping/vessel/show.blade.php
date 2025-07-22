<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Provider</li>
       </ol>
   </nav>

   <x-success-alert />

    <h1>Ports</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="mb-3 col-md-12">
                                    <label  class="form-label" for="vessel_name">Vessel Name</label>
                                    <input type="text" class="form-control" name="vessel_name" value="{{ $vessel->vessel_name}}" disabled>
                                    <x-error field="vessel_name" />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label  class="form-label" for="tracking_number">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" value="{{ $vessel->tracking_number}}" disabled>
                                    <x-error field="tracking_number" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="ports" class="form-label">Ports (Select Multiple)</label>
                                <select name="ports[]" id="ports" size="15" class="form-control" multiple required disabled>
                                    @foreach ($ports as $port)
                                        <option value="{{ $port->id }}" {{ $vessel->port->pluck('id')->contains($port->id) ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="ports" />
                            </div>
                        </div>

                        <p>{{$vessel->port->where('port_name', 'LIKE', '%Sri Lanka%')}}</p>


                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('shipping.vessel.index') }}" class="btn btn-secondary mt-2 me-2">Close</a>
                            @can('view',App\Models\ShippingProvider::class)
                            <a href="{{ route('shipping.vessel.edit',$vessel) }}" class="btn btn-primary mt-2">Edit Vessel</a>
                            @endcan
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>




