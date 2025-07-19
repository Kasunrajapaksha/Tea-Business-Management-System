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

    <div class="mb-3">
        <h1 class="d-inline align-middle">Awaiting Stocks</h1>
    </div>

    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                @if ($transactions->isEmpty())
                    <div class="mt-2">No Stock</div>
                @else
                    <table class="table table-hover table-striped my-0 mt-2">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">ID</th>
                                <th class="d-none d-xl-table-cell">Supplier</th>
                                <th class="d-none d-xl-table-cell">Item name</th>
                                <th class="d-none d-xl-table-cell">Units</th>
                                <th class="d-none d-xl-table-cell">Ordered on</th>
                                <th class="d-none d-xl-table-cell">Ordered by</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($transactions as $transaction)
                                <tr>
                                    @if ($transaction->tea_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->tea_purchase->tea_purchase_no }}</td>
                                    @elseif ($transaction->material_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->material_purchase->material_purchase_no }}</td>
                                    @endif

                                    <td class="d-none d-xl-table-cell">
                                        {{ $transaction->supplier ? $transaction->supplier->name : '' }}
                                    </td>

                                    @if ($transaction->tea)
                                        <td class="d-none d-xl-table-cell">{{ $transaction->tea->tea_name }}
                                        </td>
                                    @elseif ($transaction->material)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->material->material_name }}</td>
                                    @endif

                                    @if ($transaction->tea_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->tea_purchase->quantity }} Kg</td>
                                    @elseif ($transaction->material_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->material_purchase->units }}</td>
                                    @endif

                                    <td class="d-none d-xl-table-cell">
                                        {{ $transaction->created_at->toDateString() }}</td>
                                    @if ($transaction->tea_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->tea_purchase->payment_request->requester->first_name . ' ' . $transaction->tea_purchase->payment_request->requester->last_name }}
                                        </td>
                                    @elseif ($transaction->material_purchase)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->material_purchase->payment_request->requester->first_name . ' ' . $transaction->material_purchase->payment_request->requester->last_name }}
                                        </td>
                                    @endif

                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$transaction->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        <div class="d-flex align-items-center">

                                            <form action="{{ route('warehouse.inventory.show', $transaction) }}"
                                                method="get">
                                                @csrf
                                                <button
                                                    class="btn btn-sm btn-primary">{{ $user->department->department_name == 'Warehouse' ? 'Review' : 'View' }}</button>
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

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>

</x-app-layout>
