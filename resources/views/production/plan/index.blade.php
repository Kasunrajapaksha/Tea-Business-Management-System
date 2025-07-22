<x-app-layout>
<x-slot:title>Production | Production Plan</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Production</a></li>
        <li class="breadcrumb-item active">Production Plan</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        @can('create', App\Models\ShippingProvider::class)
            <a href="{{ route('shipping.provider.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="user-plus"></i> Add Provider</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Production Plans</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order_no</th>
                                <th class="d-none d-xl-table-cell">Order_item</th>
                                <th class="d-none d-xl-table-cell">Production start</th>
                                <th class="d-none d-xl-table-cell">Production end</th>
                                <th class="d-none d-xl-table-cell">Updated by</th>
                                <th class="d-none d-xl-table-cell">Order status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($plans as $plan )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $plan->order->order_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $plan->order->orderItem->tea->tea_name .' '. $plan->order->orderItem->quantity .' Kg' }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $plan->production_start }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $plan->production_end }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $plan->user->first_name . ' ' . $plan->user->last_name}}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$plan->order->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ProductionPlan::class)
                                        <a href="{{ route('production.plan.show', $plan) }}" class="btn btn-sm btn-primary">Review</a>
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
            {{ $plans->links() }}
    </div>

</x-app-layout>

