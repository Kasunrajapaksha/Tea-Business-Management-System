<x-app-layout>
<x-slot:title>Shipping | Shipping Provider</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Shipping</a></li>
        <li class="breadcrumb-item active">All Shipping Provider</li>
    </ol>
</nav>

<x-success-alert />

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="d-inline align-middle">All Shipping Provider</h1>
        </div>

        <div class="row d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <form action="{{ route('marketing.invoice.store',[$customer,'orders' => $orders->pluck('id')->join(',')]) }}" method="POST">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $customer->first_name.' '.$customer->last_name }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer TelePhone</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $customer->number }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer Email</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $customer->email }}" required readonly >
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 my-4">
                                <table class="table table-hover table-striped my-0">
                                    <tr>
                                        <th class="d-none d-xl-table-cell">Order No</th>
                                        <th class="d-none d-xl-table-cell">Order Item</th>
                                        <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                        <th class="d-none d-xl-table-cell">Total Amount (USD)</th>
                                        <th class="d-none d-xl-table-cell">Order Date</th>
                                    </tr>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td class="d-none d-xl-table-cell">{{ $order->order_no}}</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->orderItem->tea->tea_name }}</td>
                                        <td class="d-none d-xl-table-cell">{{ number_format($order->orderItem->quantity,1) }}</td>
                                        <td class="d-none d-xl-table-cell">{{ number_format($order->total_amount,2) }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $order->order_date->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('shipping.invoice.index') }}" class="btn btn-secondary mt-2">Close</a>
                                @if ($orders->first()->status == 13)
                                <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updatePlan">Create Proforma Invoice</a>
                                @endif
                            </div>

                                <div class="modal fade" id="updatePlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are you sure you want to create the proforma invoice?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>


    </div>



</x-app-layout>

<script>
document.getElementById('vessel_name_shedule_create').addEventListener('change', function() {
    var vesselId = this.value;
    if (vesselId !== '#') {
        fetch('{{ route('shipping.getPortsByVessel') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',  // CSRF token
            },
            body: JSON.stringify({
                vessel_id: vesselId
            })
        })
        .then(response => response.json())
        .then(data => {
            var arrivalPortSelect = document.getElementById('arrival_port_shedule_create');
            arrivalPortSelect.innerHTML = '<option value="#">Select port</option>';
            data.forEach(port => {

                var optionArrival = document.createElement('option');
                optionArrival.value = port.port_name;
                optionArrival.textContent = port.port_name;
                arrivalPortSelect.appendChild(optionArrival);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>

