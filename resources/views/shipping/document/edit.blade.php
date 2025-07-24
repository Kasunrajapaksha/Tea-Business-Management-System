<x-app-layout>
    <x-slot:title> Shipping | Shipping Schadule </x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=''>Shipping</a></li>
            <li class="breadcrumb-item active">Shipping Schadule</li>
        </ol>
    </nav>

    <x-success-alert />

    <h1>Shipping edit</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping.document.update',[$invoice ,'orders' => $orders->pluck('id')->join(',')]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="proof_of_delivery" class="form-label"><strong>Proof of Delivery</strong></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="proof_of_delivery" name="proof_of_delivery" accept=".pdf">
                                </div>
                                <x-error field="proof_of_delivery" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="delivery_receipt" class="form-label"><strong>Delivery Receipt</strong></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="delivery_receipt" name="delivery_receipt" accept=".pdf">
                                </div>
                                <x-error field="delivery_receipt" />
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('shipping.invoice.show', ['customer' => $orders->first()->customer->id, 'orders' => $orders->pluck('id')->join(',')]) }}" class="btn btn-secondary mt-2">Close</a>
                            <div class="d-flex">
                                <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal"
                                    data-bs-target="#updateSchedule">Submit</a>
                            </div>

                            <div class="modal fade" id="updateSchedule" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are you sure you want to update the shippment?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                            <button type="submit" class="btn btn-primary"
                                                data-bs-dismiss="modal">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
