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
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->first_name . ' ' . $invoice->order->first()->customer->last_name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer TelePhone</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->number }}" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Email</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $invoice->order->first()->customer->email }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label" for="vessel_id">Vessel Name</label>
                            <input type="text" class="form-control"
                                value="{{ $invoice->order->first()->shippingSchedule->vessel->vessel_name }}" disabled>
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="departure_port">Departure Port</label>
                            <input type="text" class="form-control"
                                value="{{ $invoice->order->first()->shippingSchedule->departure_port }}" disabled>
                            <x-error field="departure_port" />
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="arrival_port">Arrival Port</label>
                            <input type="text" class="form-control"
                                value="{{ $invoice->order->first()->shippingSchedule->arrival_port }}" disabled>
                            <x-error field="arrival_port" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="form-label" for="shipping_provider_id">Shipping Provider</label>
                            <input type="text" class="form-control"
                                value="{{ $invoice->order->first()->shippingSchedule->shippingProvider->provider_name }}"
                                disabled>
                            <x-error field="shipping_provider_id" />
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="shipping_cost">Shipping Cost (LKR)</label>
                            <input type="text" class="form-control" name="shipping_cost"
                                value="{{ number_format($invoice->shipping_cost, 2) }}" disabled>
                            <x-error field="shipping_cost" />
                        </div>
                    </div>
                    @if($invoice->shippingDocument)
                    <hr>
                    <label class="form-label mb-3">Shipping Documents</label>
                    <div class="row mb-3">
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'bill_of_lading']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Bill of Lading</a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'shipping_receipt']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Shipping Receipt</a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'packing_list']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Packing List</a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'freight_bill']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Freight Bill</a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'export_customs_clearance']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Customs Clearance</a>
                        </div>
                    </div>
                    @if ($invoice->order->first()->status == 20)
                    <div class="row">
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'proof_of_delivery']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Proof of Delivery</a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('shipping.document.download', ['document' => $invoice->shippingDocument->id, 'file' => 'delivery_receipt']) }}" class="btn btn-sm btn-secondary">
                                <i class="align-middle me-2" data-feather="download"></i>Delivery Receipt</a>
                        </div>
                    </div>
                    @endif
                    @endif

                    <div class="col-12 my-4">
                        <table class="table table-hover table-striped my-0">
                            <tr>
                                <th class="d-none d-xl-table-cell">Order No</th>
                                <th class="d-none d-xl-table-cell">Order Item</th>
                                <th class="d-none d-xl-table-cell">Quantity (Kg)</th>
                                <th class="d-none d-xl-table-cell">Total Amount (USD)</th>
                                <th class="d-none d-xl-table-cell">Order Date</th>
                            </tr>
                            @foreach ($invoice->order as $order)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_no }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->orderItem->tea->tea_name }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ number_format($order->orderItem->quantity, 1) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $order->order_date->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('shipping.document.index') }}" class="btn btn-secondary mt-2">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
