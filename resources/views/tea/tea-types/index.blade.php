<x-app-layout>
<x-slot:title>Tea | Tea Types</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.index') }}'>Tea</a></li>
        <li class="breadcrumb-item active">All Tea Types</li>
    </ol>
</nav>

<x-success-alert />

<div class="container-fluid p-0">

        @can('create', App\Models\Tea::class)
            <a href="{{ route('tea.teaType.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i> Add Tea</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Tea Types</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Tea No</th>
                                <th class="d-none d-xl-table-cell">Tea Name</th>
                                <th class="d-none d-xl-table-cell">Standard</th>
                                <th class="d-none d-xl-table-cell">Price Per Kg (USD)</th>
                                <th class="d-none d-xl-table-cell">Stock Level</th>
                                <th class="d-none d-xl-table-cell">Last Update</th>
                                <th class="d-none d-xl-table-cell">Updated By</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($teas as $tea)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $tea->tea_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $tea->tea_name }}</td>

                                    <td class="d-none d-xl-table-cell">{{ $tea->tea_standard }}</td>


                                    <td class="d-none d-xl-table-cell">{{ $tea->price_per_Kg}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $tea->stock_level}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $tea->updated_at->diffForHumans() }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $tea->user->first_name . ' ' . $tea->user->last_name }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('update', $tea)
                                            <a href="{{ route('tea.teaType.edit.price.list', $tea) }}"><i class="align-middle" data-feather="dollar-sign"></i></a>
                                            <a href="{{ route('tea.teaType.edit', $tea) }}"><i class="align-middle ms-2" data-feather="edit"></i></a>
                                        @endcan



                                    <a class=" my-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#tea"
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


    <div class="offcanvas offcanvas-end" tabindex="-1" id="tea" aria-labelledby="offcanvasRightLabel">
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
