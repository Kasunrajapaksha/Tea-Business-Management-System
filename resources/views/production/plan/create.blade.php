<x-app-layout>
    <x-slot:title>Production | Production Plan</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Production</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Production Plan</li>
       </ol>
   </nav>

    <h1>Production Plan</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Order No</label>
                            <input type="text" class="form-control" value="{{ $order->order_no }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Order Date</label>
                            <input type="text" class="form-control" value="{{ $order->order_date->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Order by</label>
                            <input type="text" class="form-control" value="{{ $order->user->first_name . ' ' . $order->user->last_name }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Order Item</label>
                            <input type="text" class="form-control" value="{{ $order->orderItem->tea->tea_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Quantity</label>
                            <input type="text" class="form-control" value="{{ $order->orderItem->quantity }} Kg" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Total Amount</label>
                            <input type="text" class="form-control" value="USD {{ $order->total_amount }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label  class="form-label">Packing Instractions</label>
                            <textarea class="form-control" disabled>{{ $order->packing_instractions }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="production_start">Production Start</label>
                            <input type="date" class="form-control" name="production_start" form="production-form" 	min="{{ date('Y-m-d') }}">
                            <x-error field="production_start" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="production_end">Production End</label>
                            <input type="date" class="form-control" name="production_end" form="production-form" min="{{ date('Y-m-d') }}">
                            <x-error field="production_end" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="material_id">Material</label>
                            <select name="material_id" id="material_id" class="form-select" form="production-form">
                                <option value="#">Select materials</option>
                                @foreach ($materials as $material)
                                <option value="{{ $material->id}}">{{ $material->material_name}}</option>
                                @endforeach
                            </select>
                            <x-error field="material_id" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="units">Units</label>
                            <input type="number" step="1"  name="units" id="units" class="form-control" form="production-form">
                            <x-error field="units" />
                        </div>
                    </div>

                    <input type="hidden" name="order_id" value="{{ $order->id }}" form="production-form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('order.show', $order) }}" class="btn btn-secondary mt-2">Close</a>
                        @can('create',App\Models\ProductionPlan::class)
                        <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateOrder">Update Order</a>
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
            <h4>Are you sure you want to update the order?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.plan.store') }}" method="POST" id="production-form">
            @csrf
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


