<x-app-layout>
<x-slot:title>Shipping | Shipping Provider</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Shipping</a></li>
        <li class="breadcrumb-item active">All Shipping Provider</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\ShippingProvider::class)
            <a href="{{ route('shipping.port.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add Port</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Shipping Provider</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">ID</th>
                                <th class="d-none d-xl-table-cell">Port Name</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ( $ports as $port )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{$port->id}}</td>
                                    <td class="d-none d-xl-table-cell">{{$port->port_name}}</td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ShippingProvider::class)
                                        <a href="{{ route('shipping.port.show', $port) }}" class="btn btn-sm btn-primary">view</a>
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
            {{ $ports->links() }}
    </div>

</x-app-layout>

