@php
    $user = Auth::user();
@endphp

<x-app-layout>
    <x-slot:title>Warehouse | Inventory Transactions</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('warehouse.index') }}'>Warehouse</a></li>
            <li class="breadcrumb-item active">Payment Requests</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tab">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">{{ $user->department->department_name == 'Warehouse' ? 'Awaiting Stocks' : 'All Stock' }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab" role="tab">Goods Inward</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1" role="tabpanel">
                            <div class="p-3">
                                <h1 class="d-inline align-middle">{{ $user->department->department_name == 'Warehouse' ? 'Awaiting Stocks' : 'Stocks' }}</h1>
                            </div>

                            <div class="col-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-body">
                                        @if ($transactions->isEmpty())
                                            <div>No Stock</div>
                                        @else
                                            <table class="table table-hover table-striped my-0">

                                                <thead>
                                                    <tr>
                                                        <th class="d-none d-xl-table-cell">ID</th>
                                                        <th class="d-none d-xl-table-cell">Item name</th>
                                                        <th class="d-none d-xl-table-cell">Supplier</th>
                                                        <th class="d-none d-xl-table-cell">Units</th>
                                                        <th class="d-none d-xl-table-cell">Requested at</th>
                                                        <th class="d-none d-xl-table-cell">Requested by</th>
                                                        <th class="d-none d-xl-table-cell">Status</th>
                                                        <th class="d-none d-md-table-cell">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($transactions as $transaction)
                                                        <tr>
                                                            @if ($transaction->tea_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->tea_purchase->tea_purchase_no}}</td>
                                                            @elseif ($transaction->material_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->material_purchase->material_purchase_no}}</td>
                                                            @endif

                                                            @if ($transaction->tea)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->tea->tea_name}}</td>
                                                            @elseif ($transaction->material)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->material->material_name}}</td>
                                                            @endif

                                                            <td class="d-none d-xl-table-cell">{{ $transaction->supplier->name}}</td>

                                                            @if ($transaction->tea_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->tea_purchase->quantity}} Kg</td>
                                                            @elseif ($transaction->material_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->material_purchase->units}}</td>
                                                            @endif

                                                            <td class="d-none d-xl-table-cell">{{ $transaction->created_at->toDateString()}}</td>
                                                            @if ($transaction->tea_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->tea_purchase->payment_request->requester->first_name . ' ' . $transaction->tea_purchase->payment_request->requester->last_name}}</td>
                                                            @elseif ($transaction->material_purchase)
                                                            <td class="d-none d-xl-table-cell">{{$transaction->material_purchase->payment_request->requester->first_name . ' ' . $transaction->material_purchase->payment_request->requester->last_name }}</td>
                                                            @endif

                                                            <td class="d-none d-xl-table-cell">
                                                                <x-status :status='$transaction->status' />
                                                            </td>

                                                            <td class="d-none d-xl-table-cell">
                                                                <div class="d-flex align-items-center">

                                                                    <form
                                                                        action="{{ route('warehouse.inventory.show',$transaction) }}" method="get">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-primary">{{ $user->department->department_name == 'Warehouse' ? 'Review' : 'View' }}</button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-3" role="tabpanel">
                            <div class="p-3">
                                <h1 class="d-inline align-middle">Goods Inward</h1>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>



</x-app-layout>
