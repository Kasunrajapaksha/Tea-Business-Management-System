<x-app-layout>
<x-slot:title>Tea | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.index') }}'>Tea</a></li>
        <li class="breadcrumb-item active">All Tea Purchases</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\TeaPurchase::class)
            <a href="{{ route('tea.purchase.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i>New Purchase</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Tea Purchases</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Tea Purchase No</th>
                                <th class="d-none d-xl-table-cell">Tea_name</th>
                                <th class="d-none d-xl-table-cell">Supplier</th>
                                <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                <th class="d-none d-xl-table-cell">Price Per Kg (LKR)</th>
                                <th class="d-none d-xl-table-cell">Requested at</th>
                                <th class="d-none d-xl-table-cell">Requested by</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->tea_purchase_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->supplier->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->quantity}}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($purchase->price_per_kg,2)}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->created_at->toDateString() }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->user->first_name . ' ' . $purchase->user->last_name}}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status=' $purchase->payment_request->handler ? $purchase->payment_request->status : 0 ' />
                                        </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', $purchase)
                                        <a class="btn btn-sm btn-primary mb-1" href="{{ route('tea.purchase.show', $purchase) }}">Review</a>
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
