<x-app-layout>
<x-slot:title>Tea | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.index') }}'>Tea</a></li>
        <li class="breadcrumb-item active">All Tea Purchases</li>
    </ol>
</nav>

<x-success-alert />

<div class="container-fluid p-0">

        @can('create', App\Models\TeaPurchase::class)
            <a href="{{ route('tea.purchase.create' )}}" class="btn btn-primary float-end mt-n1 d-flex align-items-center"><i class="align-middle me-2" data-feather="plus"></i>New Purchase</a>
        @endcan

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Tea Purchases</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Tea Purchase No</th>
                                <th class="d-none d-xl-table-cell">Tea_name</th>
                                <th class="d-none d-xl-table-cell">Supplier</th>
                                <th class="d-none d-xl-table-cell">Quantity</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-xl-table-cell">Requested Date</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->tea_purchase_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->supplier->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $purchase->quantity}}</td>
                                    @if($purchase->status == 0)
                                        <td class="d-none d-xl-table-cell"><span class="badge bg-secondary">Pending</span></td>
                                    @elseif($purchase->status == 1)
                                        <td class="d-none d-xl-table-cell"><span class="badge bg-warning">Reviewing</span></td>
                                    @elseif($purchase->status == 3)
                                        <td class="d-none d-xl-table-cell"><span class="badge bg-success">Paid</span></td>
                                    @elseif($purchase->status == 4)
                                        <td class="d-none d-xl-table-cell"><span class="badge bg-danger">Rejected</span></td>
                                    @endif
                                    <td class="d-none d-xl-table-cell">{{ $purchase->created_at->diffForHumans() }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        
                                        {{-- @can('update', $purchase) --}}
                                        {{-- @endcan --}}



                                    <a class=" my-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#purchase"
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


    <div class="offcanvas offcanvas-end" tabindex="-1" id="purchase" aria-labelledby="offcanvasRightLabel">
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
