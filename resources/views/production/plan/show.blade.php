<x-app-layout>
    <x-slot:title>Production | Production Plan</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Production</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Production Plan</li>
       </ol>
   </nav>

   <x-success-alert />

    <div class="d-flex align-items-center">
        <h1 class="me-3">Production Plan</h1>
        <x-status :status='$order->status' />
    </div>
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
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Production Start</label>
                            <input type="text" class="form-control" value="{{ $plan->production_start }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Production End</label>
                            <input type="text" class="form-control" value="{{ $plan->production_end }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Materials</label>
                            <input type="text" class="form-control" value="{{ $order->productionMaterial->material->material_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Units</label>
                            <input type="text" class="form-control" value="{{ $order->productionMaterial->units}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Created at</label>
                            <input type="text" class="form-control" value="{{ $plan->created_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Update at</label>
                            <input type="text" class="form-control" value="{{ $plan->updated_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $plan->user->first_name . ' ' . $plan->user->last_name }}" disabled>
                        </div>
                    </div>


                    <input type="hidden" name="order_id" value="{{ $order->id }}" form="production-form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="d-flex">
                            <a href="{{ route('production.plan.index') }}" class="btn btn-secondary mt-2">Close</a>
                            @can('update', $plan)
                            <a href="{{ route('production.plan.edit', $plan) }}" class="btn btn-primary mt-2 ms-2">Edit Plan</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>



