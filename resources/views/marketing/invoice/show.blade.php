<x-app-layout>
    <x-slot:title>Marketing | Proforma Invoice</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('management.index') }}'>Marketing</a></li>
            <li class="breadcrumb-item active">Proforma Invoice</li>
        </ol>
    </nav>

    <h1>Proforma Invoice</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h1 class="display-6">PROFORMA INVOICE</h1>

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Customer : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->customer->first_name . ' ' . $invoice->order->customer->last_name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Item Name : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->orderItem->tea->tea_name . ' - ' . $invoice->order->orderItem->tea->tea_standard}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Packing Description : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->packing_instractions }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Total Kgs : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->orderItem->quantity }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Per Kg Price (USD) : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->orderItem->tea->price_per_Kg }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Packing Cost (USD) : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ number_format($invoice->order->productionMaterial->units * $invoice->order->productionMaterial->unit_price) }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Total Value (USD) : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ number_format(($invoice->order->productionMaterial->units * $invoice->order->productionMaterial->unit_price) + $invoice->order->total_amount ) }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Port of Loading : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $invoice->order->shippingSchedule->departure_port }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Date of Shipment : </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ 'During the month of ' . \Carbon\Carbon::parse($invoice->order->shippingSchedule->departure_date)->format('F Y') }}">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="" class="btn btn-secondary mt-2">Close</a>
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addOrder">Create Proforma Invoice</a>
                        </div>

                        <div class="modal fade" id="addOrder" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure you want to create the proforma invoice?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
