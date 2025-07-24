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
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" name="departure_date"
                                    value="{{ $schedule->departure_date }}" min="{{ $schedule->order->productionPlan->production_end }}">
                                <x-error field="departure_date" />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="arrival_date">Arrival Date</label>
                                <input type="date" class="form-control" name="arrival_date"
                                    value="{{ $schedule->arrival_date }}" min="{{ $schedule->order->productionPlan->production_end }}">
                                <x-error field="arrival_date" />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="departure_port">Departure Port</label>
                                <select class="form-select" name="departure_port" id="departure_port">
                                    <option value="#">Select port</option>
                                    @foreach ($departurePorts as $port)
                                        <option value="{{ $port->port_name }}" {{ $port->port_name == $schedule->departure_port ? 'selected' : '' }}>{{ $port->port_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="departure_port" />
                            </div>
                        </div>

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
