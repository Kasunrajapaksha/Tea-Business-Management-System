<x-app-layout>
<x-slot:title>Finance | Payment Requests</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('finance.index') }}'>Finance</a></li>
        <li class="breadcrumb-item active">Payment Requests</li>
    </ol>
</nav>

<x-success-alert />

<div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">Payment Requests</h1>
        </div>

        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Request No</th>
                                <th class="d-none d-xl-table-cell">Supplier</th>
                                <th class="d-none d-xl-table-cell">Amount</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-xl-table-cell">Requested By</th>
                                <th class="d-none d-xl-table-cell">Requested Date</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($requests as $request)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $request->request_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $request->supplier->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $request->amount }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $request->requester->first_name . ' ' . $request->requester->last_name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $request->created_at->diffForHumans() }}</td>

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$request->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">

                                        {{-- @can('update', $purchase) --}}
                                        {{-- @endcan --}}



                                    <a class=" my-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#request"
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


    <div class="offcanvas offcanvas-end" tabindex="-1" id="request" aria-labelledby="offcanvasRightLabel">
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
