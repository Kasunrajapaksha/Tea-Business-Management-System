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
            <a href="{{ route('shipping.provider.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add Provider</a>
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
                                <th class="d-none d-xl-table-cell">Provider No</th>
                                <th class="d-none d-xl-table-cell">Provider Name</th>
                                <th class="d-none d-xl-table-cell">Tracking No</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Telephone</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($providers as $provider )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $provider->provider_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $provider->provider_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $provider->tracking_number }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $provider->email }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $provider->number }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ShippingProvider::class)
                                        <a href="{{ route('shipping.provider.show', $provider) }}" class="btn btn-sm btn-primary">Review</a>
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
            {{ $providers->links() }}
    </div>

</x-app-layout>

