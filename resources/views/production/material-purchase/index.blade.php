<x-app-layout>
<x-slot:title>Production | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('production.material.index') }}'>Material</a></li>
        <li class="breadcrumb-item active">All Material Purchases</li>
    </ol>
</nav>

<x-success-alert />
<x-danger-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\MaterialPurchase::class)
            <a href="{{ route('production.material.purchase.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i>New Purchase</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Material Purchases</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Material Purchase No</th>
                                <th class="d-none d-xl-table-cell">Material Name</th>
                                <th class="d-none d-xl-table-cell">Supplier</th>
                                <th class="d-none d-xl-table-cell">Units</th>
                                <th class="d-none d-xl-table-cell">Unit Price (LKR)</th>
                                <th class="d-none d-xl-table-cell">Requested on</th>
                                <th class="d-none d-xl-table-cell">Requested by</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->material_purchase_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->material->material_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->supplier->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->units}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->unit_price}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->created_at->toDateString() }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->user->first_name . ' ' . $purchase->user->last_name}}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status=' $purchase->payment_request->handler ? $purchase->payment_request->status : 0 ' />
                                        </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\MaterialPurchase::class)
                                        <a href="{{ route('production.material.purchase.show', $purchase) }}" class="btn btn-sm btn-primary">Review</a>
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
        {{ $purchases->links() }}
    </div>

</x-app-layout>
