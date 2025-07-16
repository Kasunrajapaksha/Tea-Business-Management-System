<x-app-layout>
<x-slot:title>Production | Material</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('production.index') }}'>Production</a></li>
        <li class="breadcrumb-item active">Create Material</li>
    </ol>
</nav>

    <h1>Create Material</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('production.material.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="material_name" class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="material_name" name="material_name" value="{{ old('material_name')}}">
                            <x-error field="material_name" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price (USD)</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ old('unit_price')}}">
                                <x-error field="unit_price" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('production.material.index' ) }}" class="btn btn-secondary mt-2">Close</a>
                            <button type="submit" class="btn btn-primary mt-2">Add Material</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
