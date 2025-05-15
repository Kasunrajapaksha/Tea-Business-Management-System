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

                    <form action="{{ route('production.material.purchase.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="mb-3 col-md-12">
                            <label for="material_id" class="form-label">Material</label>
                            <select class="form-control" id="material_id" name="material_id">
                                <option value="">Choose a material</option>
                                @foreach ($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->material_name }}</option>
                                @endforeach
                            </select>
                            <x-error field="material_id" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select class="form-control" id="supplier_id" name="supplier_id">
                                <option value="">Choose a supplier</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <x-error field="supplier_id" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="units" class="form-label">Units</label>
                            <input type="text" class="form-control" id="units" name="units" value="{{ old('units')}}">
                            <x-error field="units" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="unit_price" class="form-label">Unit Price</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ old('unit_price')}}">
                            <x-error field="unit_price" />
                        </div>

                        <a href="{{ route('tea.purchase.index' ) }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Add New Material</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
