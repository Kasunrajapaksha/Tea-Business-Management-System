@props(['payment_requests'])

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center gx-0">
                <div class="col">
                    <h4 class="text-uppercase text-body-secondary mb-2">Purchase Items</h4>
                </div>
                <div class="col-auto">
                    <div class="stat">
                        <i class="align-middle" data-feather="map"></i>
                    </div>
                </div>
                <div class="col-auto ms-1">
                    <div class="stat bg-success-subtle">
                        <a href=""><i class="align-middle" data-feather="file-text"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <div class="card bg-dark-subtle">
                        <div class="card-body">
                            <div class="col d-flex flex-column align-items-center">
                                <h6 class="text-uppercase text-body-secondary mb-2">Pending</h6>
                                <span
                                    class="display-6 mb-0 text-dark-emphasis">{{ $payment_requests->where('status', 0)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-warning-subtle">
                        <div class="card-body">
                            <div class="col d-flex flex-column align-items-center">
                                <h6 class="text-uppercase text-body-secondary mb-2">Reviewing</h6>
                                <span
                                    class="display-6 mb-0 text-warning-emphasis">{{ $payment_requests->where('status', 1)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-danger-subtle">
                        <div class="card-body">
                            <div class="col d-flex flex-column align-items-center">
                                <h6 class="text-uppercase text-body-secondary mb-2">Canceled</h6>
                                <span
                                    class="display-6 mb-0 text-danger-emphasis">{{ $payment_requests->where('status', 2)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card bg-primary-subtle">
                        <div class="card-body">
                            <div class="col d-flex flex-column align-items-center">
                                <h6 class="text-uppercase text-body-secondary mb-2">Paid</h6>
                                <span
                                    class="display-6 mb-0 text-primary-emphasis">{{ $payment_requests->where('status', 5)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card bg-success-subtle">
                        <div class="card-body">
                            <div class="col d-flex flex-column align-items-center">
                                <h6 class="text-uppercase text-body-secondary mb-2">Received</h6>
                                <span
                                    class="display-6 mb-0 text-success-emphasis">{{ $payment_requests->where('status', 6)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
