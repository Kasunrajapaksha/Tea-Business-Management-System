<x-app-layout>
<x-slot:title>{{ Auth::user()->department->department_name }} | Supplier </x-slot:title>

<x-success-alert />

<div class="container-fluid p-0">

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item active">All Suppliers</li>
       </ol>
   </nav>

        @can('create', App\Models\Supplier::class)
            <a href="{{ route('supplier.create') }}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i> Add Supplier</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Suppliers</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Supplier No</th>
                                <th class="d-none d-xl-table-cell">Supplier Name</th>
                                <th class="d-none d-xl-table-cell">Supply Type</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Telephone</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $supplier->supplier_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $supplier->name}}</td>
                                    @if($supplier->type == 01)
                                    <td class="d-none d-xl-table-cell">Tea</td>
                                    @elseif($supplier->type == 02)
                                    <td class="d-none d-xl-table-cell">Material</td>
                                    @endif

                                    <td class="d-none d-xl-table-cell">{{ $supplier->email}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $supplier->number}}</td>

                                    <td><x-status :status='$supplier->status' /></td>

                                    <td class="d-none d-xl-table-cell">
                                        @can('view', $supplier)
                                        <a class="btn btn-sm btn-primary" href="{{ route('supplier.show', $supplier) }}">Review</a>
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
            {{ $suppliers->links() }}
    </div>

</x-app-layout>
