<x-app-layout>
<x-slot:title>Shipping | Shipping Schedule</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Shipping</a></li>
        <li class="breadcrumb-item active">Shipping Schedule</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">Shipping Schedule</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Vessel Name</th>
                                <th class="d-none d-xl-table-cell">Shipping Provider</th>
                                <th class="d-none d-xl-table-cell">Departure Date</th>
                                <th class="d-none d-xl-table-cell">Departure Port</th>
                                <th class="d-none d-xl-table-cell">Arrival Date</th>
                                <th class="d-none d-xl-table-cell">Arrival Port</th>
                                <th class="d-none d-xl-table-cell">Shipping Cost (USD)</th>
                                <th class="d-none d-xl-table-cell">Shipping Note</th>
                                <th class="d-none d-xl-table-cell">Order Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($schedules as $schedule )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->order->order_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->vessel_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->shippingProvider->provider_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->departure_date }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->departure_port }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->arrival_date }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->arrival_port }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->shipping_cost }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $schedule->shipping_note }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$schedule->order->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ShippingSchedule::class)
                                        <a href="{{ route('shipping.schedule.show', $schedule) }}" class="btn btn-sm btn-primary">Review</a>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 px-3">
            {{ $schedules->links() }}
    </div>

</x-app-layout>

