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
        <h1 class="d-inline align-middle">Pending Dispatch</h1>
    </div>

    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                @if ($outgoingTransactions->isEmpty())
                    <div class="mt-2">No Stock</div>
                @else
                    <table class="table table-hover table-striped my-0">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Item name</th>
                                <th class="d-none d-xl-table-cell">Quantity</th>
                                <th class="d-none d-xl-table-cell">Requested on</th>
                                <th class="d-none d-xl-table-cell">Requested by</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($outgoingTransactions as $transaction)
                                <tr>

                                    <td class="d-none d-xl-table-cell">
                                        {{ $transaction->production_plan->order->order_no }}</td>
                                    @if ($transaction->tea_id)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->production_plan->order->orderItem->tea->tea_name }}
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ number_format($transaction->production_plan->order->orderItem->quantity) . ' Kg' }}
                                        </td>
                                    @elseif ($transaction->material_id)
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->material->material_name }}
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            {{ $transaction->units . ' Units' }}
                                        </td>
                                    @endif
                                    <td class="d-none d-xl-table-cell">
                                        {{ $transaction->created_at->format('Y-m-d') }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $transaction->production_plan->user->first_name . ' ' . $transaction->production_plan->user->last_name }}
                                    </td>


                                    <td class="d-none d-xl-table-cell">
                                        <x-status :status='$transaction->status' />
                                    </td>

                                    <td class="d-none d-xl-table-cell">
                                        <div class="d-flex align-items-center">

                                            <form
                                                action="{{ route('warehouse.inventory.show.outgoing', $transaction) }}"
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
        {{ $outgoingTransactions->links() }}
    </div>

</x-app-layout>
