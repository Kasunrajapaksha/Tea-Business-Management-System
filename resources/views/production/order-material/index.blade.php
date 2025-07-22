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

        @can('create', App\Models\ProductionMaterial::class)
            <a href="{{ route('production.order.material.create', $order) }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i> Add Material</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">Production Materials <span class="h3 text-secondary">  for {{ $order->order_no }}</span></h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    @if ($production_materials->isEmpty())
                        <div class="mt-2">No Production Materials</div>
                    @else
                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Units</th>
                                <th class="d-none d-xl-table-cell">Cost (LKR)</th>
                                <th class="d-none d-xl-table-cell">Updated by</th>
                                <th class="d-none d-xl-table-cell">Updated on</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($production_materials as $production_material )
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $production_material->material->material_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $production_material->units .' Units'  }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($production_material->cost,2) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $production_material->user->first_name . ' ' . $production_material->user->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $production_material->updated_at->format('Y-m-d')}}</td>
                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$production_material->inventory_transaction->first()->status' />
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\ProductionPlan::class)
                                        <a href="{{ route('production.order.material.show', $production_material) }}" class="btn btn-sm btn-primary">Review</a>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <a href="{{ route('production.plan.show', $plan) }}" class="btn btn-secondary mt-2 me-1">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 px-3">
            {{ $production_materials->links() }}
    </div>

</x-app-layout>

