<x-app-layout>
<x-slot:title>Production | Material</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('production.index') }}'>Production</a></li>
        <li class="breadcrumb-item active">All Materials</li>
    </ol>
</nav>

<x-success-alert />
<x-danger-alert />

<div class="container-fluid p-0">

        @can('create', App\Models\Material::class)
            <a href="{{ route('production.material.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i> Add Material</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Materials</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Material No</th>
                                <th class="d-none d-xl-table-cell">Material Name</th>
                                <th class="d-none d-xl-table-cell">Unit price (LKR)</th>
                                <th class="d-none d-xl-table-cell">Stock Level</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($materials as $material)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $material->material_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $material->material_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $material->unit_price }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $material->stock_level}}</td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', App\Models\Material::class)
                                        <a class="btn btn-sm btn-primary" href="{{ route('production.material.show', $material) }}">Review</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 px-3">
            {{ $materials->links() }}
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
            <h4 id="modal-message">Are you sure you want to delete this material?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="" method="POST" id="materila-form">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


