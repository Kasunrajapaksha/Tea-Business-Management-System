<x-app-layout>
<x-slot:title>Tea | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.purchase.index') }}'>Tea Purchases</a></li>
        <li class="breadcrumb-item active">Purchase Tea</li>
    </ol>
</nav>

    <h1>Purchase Tea</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('tea.purchase.update', $purchase) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tea_id" class="form-label">Tea</label>
                                <select class="form-control" id="tea_id" name="tea_id">
                                    @foreach ($teas as $tea)
                                    <option value="{{ $tea->id }}" {{ $tea->id == $purchase->tea->id ? 'selected' : '' }}>{{ $tea->tea_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="tea_id" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="supplier_id" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="quantity" class="form-label">Quantity (Kg)</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $purchase->quantity }}">
                                <x-error field="quantity" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="price_per_kg" class="form-label">Price Per Kg</label>
                                <input type="text" class="form-control" id="price_per_kg" name="price_per_kg" value="{{ $purchase->price_per_kg }}">
                                <x-error field="price_per_kg" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('tea.purchase.show', $purchase) }}" class="btn btn-secondary mt-2">Close</a>
                            @can('update', $purchase)
                            <a class="btn btn-primary mt-2 me-1" data-bs-toggle="modal" data-bs-target="#updateTea">Update Tea</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="updateTea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update the tea?</h4>
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
