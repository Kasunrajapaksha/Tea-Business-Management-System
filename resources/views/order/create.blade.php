<x-app-layout>
    <x-slot:title>Marketing | Order</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href='{{ route('management.index') }}'>Marketing</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Create Order</li>
       </ol>
   </nav>

    <h1>Create Order</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" name="customer_id" value="{{ $customer->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" value="{{ $customer->first_name . ' ' . $customer->last_name}}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Customer No</label>
                                <input type="text" class="form-control" value="{{ $customer->customer_no}}" readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Order Date</label>
                                <input type="text" class="form-control" value="{{ now()->format('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="order_item" class="form-label">Order Item</label>
                                <select name="tea_id" id="tea_id" class="form-control">
                                        <option value="#">Select Tea</option>
                                    @foreach ($teas as $tea )
                                        <option value="{{ $tea->id }}">{{ $tea->tea_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="tea_id" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="quantity" class="form-label">Quantity (Kg)</label>
                                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ old('quantity')}}">
                                <x-error field="quantity" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="packing_instractions" class="form-label">Packing Instructions</label>
                                <textarea name="packing_instractions" id="packing_instractions" class="form-control"></textarea>
                                <x-error field="packing_instractions" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('marketing.customer.index') }}" class="btn btn-secondary mt-2">Close</a>
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addOrder">Add Order</a>
                        </div>

                        <div class="modal fade" id="addOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to add this order?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


