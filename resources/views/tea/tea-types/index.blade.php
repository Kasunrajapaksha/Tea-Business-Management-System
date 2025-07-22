<x-app-layout>
<x-slot:title>Tea | Tea Types</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.index') }}'>Tea</a></li>
        <li class="breadcrumb-item active">All Tea Types</li>
    </ol>
</nav>

<x-success-alert />
<x-danger-alert />

<div class="container-fluid p-0">

        @can('create', App\Models\Tea::class)
            <a href="{{ route('tea.teaType.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i> Add New Tea</a>
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
                                <th class="d-none d-xl-table-cell">Stock Level (kg)</th>
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
                                    <td class="d-none d-xl-table-cell">{{ $tea->updated_at->toDateString() }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $tea->user->first_name . ' ' . $tea->user->last_name }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('update', $tea)
                                        <a class="btn btn-sm btn-success mb-1" href="{{ route('tea.teaType.edit.price.list', $tea) }}">Tea Price</a>
                                        @endcan
                                        @can('view', $tea)
                                        <a class="btn btn-sm btn-primary mb-1" href="{{ route('tea.teaType.show', $tea) }}">Review</a>
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
            {{ $teas->links() }}
    </div>
</x-app-layout>
