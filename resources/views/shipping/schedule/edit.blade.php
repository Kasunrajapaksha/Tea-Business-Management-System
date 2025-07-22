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

    <h1>Shipping Schadule</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping.schedule.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="vessel_id">Vessel Name</label>
                                <select class="form-select" name="vessel_id" id="vessel_name_shedule_create">
                                    <option value="#">Select Vessel</option>
                                    @foreach ($vessels as $vessel)
                                        <option value="{{ $vessel->id }}" {{ $vessel->id == $schedule->vessel_id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="vessel_id" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="shipping_provider_id">Shipping Provider</label>
                                <select name="shipping_provider_id" class="form-select">
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}"
                                            {{ $provider->id == $schedule->shippingProvider->id ? 'selected' : '' }}>
                                            {{ $provider->provider_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="shipping_provider_id" />
                            </div>
                        </div>
                        @if ($schedule->order->status == 13)
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" name="departure_date"
                                    value="{{ $schedule->departure_date }}" min="{{ $schedule->order->productionPlan->production_end }}">
                                <x-error field="departure_date" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="departure_port">Departure Port</label>
                                <select class="form-select" name="departure_port" id="departure_port">
                                    <option value="#">Select port</option>
                                    @foreach ($departurePorts as $port)
                                        <option value="{{ $port->port_name }}" {{ $port->port_name == $schedule->departure_port ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="departure_port" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="arrival_date">Arrival Date</label>
                                <input type="date" class="form-control" name="arrival_date"
                                    value="{{ $schedule->arrival_date }}" min="{{ $schedule->order->productionPlan->production_end }}">
                                <x-error field="arrival_date" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="arrival_port">Arrival Port</label>
                                <select class="form-select" name="arrival_port" id="arrival_port_shedule_create">
                                    <option value="#">Select port</option>
                                    @foreach ($ports as $port)
                                        <option value="{{ $port->port_name }}" {{ $port->port_name == $schedule->arrival_port ? 'selected' : '' }} >{{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="arrival_port" />
                            </div>
                        </div>
                        @endif
                        @if ($schedule->order->status >= 17)
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="shipping_cost">Shipping Cost (USD)</label>
                                <input type="number" step="0.00" class="form-control" name="shipping_cost"
                                    value="{{ $schedule->shipping_cost }}">
                                <x-error field="shipping_cost" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="tracking_number">Tracking Number</label>
                                <input type="text" class="form-control" name="tracking_number"
                                    value="{{ $schedule->tracking_number }}">
                                <x-error field="tracking_number" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="shipping_note">Shipping Note</label>
                                <textarea name="shipping_note" id="shipping_note" class="form-control">{{ $schedule->shipping_note }}</textarea>
                                <x-error field="shipping_note" />
                            </div>
                        </div>
                        @endif
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('shipping.schedule.show',$schedule) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update', $schedule)
                                <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateSchedule">Update Plan</a>
                                @endcan
                            </div>

                            <div class="modal fade" id="updateSchedule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to update the schedule?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                    </div>
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
document.getElementById('vessel_name_shedule_create').addEventListener('change', function() {
    var vesselId = this.value;
    if (vesselId !== '#') {
        fetch('{{ route('shipping.getPortsByVessel') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',  // CSRF token
            },
            body: JSON.stringify({
                vessel_id: vesselId
            })
        })
        .then(response => response.json())
        .then(data => {
            var arrivalPortSelect = document.getElementById('arrival_port_shedule_create');
            arrivalPortSelect.innerHTML = '<option value="#">Select port</option>';
            data.forEach(port => {

                var optionArrival = document.createElement('option');
                optionArrival.value = port.port_name;
                optionArrival.textContent = port.port_name;
                arrivalPortSelect.appendChild(optionArrival);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>
