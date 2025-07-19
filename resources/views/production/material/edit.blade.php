<x-app-layout>
<x-slot:title>Production | Material</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('production.index') }}'>Production</a></li>
        <li class="breadcrumb-item active">Update Material</li>
    </ol>
</nav>

    <h1>Update Material</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" form="materila-form" hidden >

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="material_name" class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="material_name" name="material_name" value="{{ $material->material_name }}" form="materila-form">
                            <x-error field="material_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price (LKR)</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ $material->unit_price }}" form="materila-form">
                                <x-error field="unit_price" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('production.material.show', $material ) }}" class="btn btn-secondary mt-2">Close</a>
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateMaterial">Update Material</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateMaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the material details?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.material.update', $material) }}" method="POST" id="materila-form">
            @csrf
            @method('PATCH')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>
