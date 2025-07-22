<x-app-layout>
    <x-slot:title>Production | Production Plan</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Production</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Production Plan</li>
       </ol>
   </nav>

   <x-danger-alert />

    <h1>Production Materials</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="row gx-0">
                        <label for="inputPassword" class="col-4 col-form-label mt-3">{{ $production_material->material->material_name}} </label>
                        <div class="col-8">
                            <input type="number" class="form-control mt-3" name="units" value="{{ $production_material->units }}" form="production-form">
                            <x-error field="units" />
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <a href="{{ route('production.order.material.show', $production_material) }}" class="btn btn-secondary mt-2 me-1">Close</a>
                        <div class="d-flex">
                            <a class="btn btn-primary mt-2 me-1" data-bs-toggle="modal" data-bs-target="#updateMaterial">Update Material</a>
                        </div>
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
            <h4>Are you sure you want to update production material?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.order.material.update',$production_material) }}" method="POST" id="production-form">
            @csrf
            @method('PATCH')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


