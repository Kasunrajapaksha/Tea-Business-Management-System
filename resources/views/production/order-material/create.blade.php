<x-app-layout>
    <x-slot:title>Production | Production Plan</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Production</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Production Plan</li>
       </ol>
   </nav>

   <x-danger-alert />

    <h1>Production Materials</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3 row">
                        @foreach ($materials as $material)
                        <div class="col-6">
                            <div class="row gx-0">
                                <label for="inputPassword" class="col-3 col-form-label mt-3">{{ $material->material_name }}</label>
                                <div class="col-8 me-2">
                                    <input type="number" step="1" name="units[{{ $material->id }}]" id="units_{{ $material->id }}" value="{{ old('units.' . $material->id) }}"  class="form-control mt-3" form="production-form">
                                    <x-error field="units.{{ $material->id }}" />
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id }}" form="production-form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <a href="{{ route('production.order.material.index', [$order,$order->productionPlan]) }}" class="btn btn-secondary mt-2">Close</a>
                        @can('create', App\Models\ProductionMaterial::class)
                        <a class="btn btn-success mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateOrder">Submit</a>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to Add production materials?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.order.material.store',$order) }}" method="POST" id="production-form">
            @csrf
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


