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

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="material_name" class="form-label">Material No</label>
                                <input type="text" class="form-control" id="material_no" name="material_no" value="{{ $material->material_no }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="material_name" class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="material_name" name="material_name" value="{{ $material->material_name }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price (LKR)</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $material->unit_price }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Stock Level</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $material->stock_level }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Updated On</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $material->updated_at->format('Y-m-d') }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Updated by</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $material->user->first_name . ' ' . $material->user->last_name }}" disabled>
                            </div>
                        </div>
                         <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('production.material.index' ) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                @can('delete', $material)
                                <a class="btn btn-danger me-1" data-bs-toggle="modal" data-bs-target="#deleteMaterial">Delete Material</a>
                                @endcan
                                @can('update', $material)
                                <a class="btn btn-primary" href="{{ route('production.material.edit', $material) }}">Edit Material</a>
                                @endcan
                            </div>
                         </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deleteMaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to delete {{$material->material_name}}?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.material.destroy', $material) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>
