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
                            <input type="text" class="form-control" value="{{ number_format($order->orderItem->quantity,1) }} Kg" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Total Amount</label>
                            <input type="text" class="form-control" value="USD {{ number_format($order->total_amount,2) }}" disabled>
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
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Planned Start Date</label>
                            <input type="text" class="form-control" value="{{ $plan->production_start }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Planned End Date</label>
                            <input type="text" class="form-control" value="{{ $plan->production_end }}" disabled>
                        </div>
                    </div>
                    @if ($plan->order->status >= 16)
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            @php
                                $diffIndays = \Carbon\Carbon::parse($plan->production_start)->diffInDays(\Carbon\Carbon::parse($plan->actual_aproduction_start))
                            @endphp
                            <x-label-badge title="Actual Production Start" :diffIndays="$diffIndays" />
                            <input type="text" class="form-control" value="{{ $plan->actual_aproduction_start }}" disabled>
                        </div>
                        @if ($plan->order->status >= 17)
                        <div class="mb-3 col-md-4">
                            @php
                                $diffIndays = \Carbon\Carbon::parse($plan->production_end)->diffInDays(\Carbon\Carbon::parse($plan->actual_aproduction_end))
                            @endphp
                            <x-label-badge title="Actual Production End" :diffIndays="$diffIndays" />
                            <input type="text" class="form-control" value="{{ $plan->actual_production_end }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label  class="form-label">Production Cost (LKR)</label>
                            <input type="text" class="form-control" value="{{ number_format($plan->production_cost,2) }}" disabled>
                        </div>
                        @endif
                    </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Update on</label>
                            <input type="text" class="form-control" value="{{ $plan->updated_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label">Updated by</label>
                            <input type="text" class="form-control" value="{{ $plan->user->first_name . ' ' . $plan->user->last_name }}" disabled>
                        </div>
                    </div>


                    <input type="hidden" name="order_id" value="{{ $order->id }}" form="production-form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('production.plan.index') }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                            @can('update', $plan)
                                @if ($plan->order->status == 12)
                                <a href="{{ route('production.plan.edit', $plan) }}" class="btn btn-primary mt-2 ms-2">Edit Plan</a>
                                @endif
                                @if ($plan->order->status == 15)
                                <a class="btn btn-success mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updatePlan">Start Production</a>
                                @endif
                                @if ($plan->order->status == 16 )
                                <a href="{{ route('production.order.material.index', ['order'=>$order,'plan'=>$plan]) }}" class="btn btn-primary mt-2 ms-2">Production Material</a>
                                @endif
                                @if ($plan->order->status == 16 && $plan->inventory_transaction->where('production_plan_id', $plan->id)->every(fn($transaction) => $transaction->status == 9))
                                <a class="btn btn-danger mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updatePlan">End Production</a>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updatePlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the production plan?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.plan.update.plan.dates', $plan) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Yes</button>
            </form>
        </div>
    </div>
</div>



