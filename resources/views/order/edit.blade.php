<x-app-layout>
    <x-slot:title>Marketing | Order</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('management.index') }}'>Marketing</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Update Order</li>
       </ol>
   </nav>

    <h1>Update Order</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('order.update', $order) }}" method="POST">
                        @csrf
                        @method('patch')

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" name="order_item" value="{{ $order->orderItem->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" value="{{ $order->customer->first_name . ' ' . $order->customer->last_name}}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Customer No</label>
                                <input type="text" class="form-control" value="{{ $order->customer->customer_no}}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Order Date</label>
                                <input type="text" class="form-control" value="{{ $order->order_date->format('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="order_item" class="form-label">Order Item</label>
                                <select name="tea_id" id="tea_id" class="form-control">
                                        <option value="#">Select Tea</option>
                                    @foreach ($teas as $tea )
                                        <option value="{{ $tea->id }}" {{$tea->id == $order->orderItem->tea->id ? 'selected' : ''}}>{{ $tea->tea_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="tea_id" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="quantity" class="form-label">Quantity (Kg)</label>
                                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $order->orderItem->quantity }}">
                                <x-error field="quantity" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="packing_instractions" class="form-label">Packing Instructions</label>
                                <textarea name="packing_instractions" id="packing_instractions" class="form-control">{{ $order->packing_instractions }}</textarea>
                                <x-error field="packing_instractions" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('order.show',$order) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('update', $order)
                                <a class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#updateOrder">Update Order Details</a>
                                @endcan
                            </div>
                        </div>

                        <div class="modal fade" id="updateOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update this order?</h4>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>








