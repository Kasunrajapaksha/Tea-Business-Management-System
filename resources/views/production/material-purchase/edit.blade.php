<x-app-layout>
<x-slot:title>Production | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.purchase.index') }}'>Tea Purchases</a></li>
        <li class="breadcrumb-item active">Purchase Material</li>
    </ol>
</nav>

    <h1>Purchase Material</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('production.material.purchase.update', $purchase) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="material_id" class="form-label">Material</label>
                                <select class="form-control" id="material_id" name="material_id">
                                    @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" {{ $material->id == $purchase->material->id ? 'selected' : '' }}>{{ $material->material_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="material_id" />
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
                                <label for="units" class="form-label">Units</label>
                                <input type="text" class="form-control" id="units" name="units" value="{{ $purchase->units}}">
                                <x-error field="units" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price (LKR)</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $purchase->unit_price }}">
                                <x-error field="unit_price" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('production.material.purchase.show', $purchase) }}" class="btn btn-secondary mt-2">Close</a>
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updatePurchase">Update Purchase</a>
                        </div>

                        <div class="modal fade" id="updatePurchase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update the material purchase details?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('production.material.purchase.update', $material) }}" method="POST" id="materila-form">
                                    @csrf
                                    @method('PATCH')
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


