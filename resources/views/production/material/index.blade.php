<x-app-layout>
<x-slot:title>Production | Material</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('production.index') }}'>Production</a></li>
        <li class="breadcrumb-item active">All Materials</li>
    </ol>
</nav>

<x-success-alert />

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
                                        @can('update', $material)
                                            <a href="{{ route('production.material.edit', $material) }}"><i class="align-middle ms-2" data-feather="edit"></i></a>
                                        @endcan



                                    <a class=" my-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#material"
										aria-controls="offcanvasRight"><i class="align-middle ms-2" data-feather="eye"></i></a>



                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="material" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h3 id="offcanvasRightLabel">Customer Details</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="card">

                <div class="card-header">
                    <div class="card-actions">
                        <h5 class="card-title mb-0">Name</h5>
                    </div>
                </div>

                <div class="card-body">

                    <div class="">
                        <div class="">
                            <div class="mb-2"><strong>No : </strong></div>
                            <div class="mb-2"><strong>Created : </strong></div>
                            <div class="mb-2"><strong>Email : </strong></div>
                            <div class="mb-2"><strong>Telephone : </strong></div>
                            <div class="mb-2"><strong>Address : </strong></div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>



</x-app-layout>
