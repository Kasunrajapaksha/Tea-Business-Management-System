<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Provider</li>
       </ol>
   </nav>

    <h1>Ports</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping.vessel.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="mb-3 col-md-12">
                                    <label  class="form-label" for="vessel_name">Vessel Name</label>
                                    <input type="text" class="form-control" name="vessel_name" value="{{ old('vessel_name')}}">
                                    <x-error field="vessel_name" />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="tracking_number">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" id="tracking_number" value="{{ old('tracking_number') }}" placeholder="Enter 7 digits">
                                    <x-error field="tracking_number" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="ports" class="form-label">Ports (Select Multiple)</label>
                                <select name="ports[]" id="ports" size="15" class="form-control" multiple required>
                                    @foreach ($ports as $port)
                                        <option value="{{ $port->id }}">{{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="ports" />
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('shipping.vessel.index') }}" class="btn btn-secondary mt-2">Close</a>
                            @can('view',App\Models\ShippingProvider::class)
                            <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#addProvider">Add Port</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="addProvider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to add this port?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    // Automatically add "IMO " prefix to the tracking number input field
    document.getElementById('tracking_number').addEventListener('input', function(event) {
        const value = event.target.value;

        // If the value doesn't start with "IMO ", prepend it
        if (!value.startsWith('IMO ')) {
            event.target.value = 'IMO ' + value.replace('IMO ', ''); // Replace any existing "IMO " in case they typed it manually
        }
    });
</script>



