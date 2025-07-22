@props(['orders'])

<div class="card">
    <div class="card-body">
        <div class="row align-items-center gx-0">
            <div class="col">
                <h4 class="text-uppercase text-body-secondary mb-2">Order Status </h4>
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
            <div class="col-6">
                <div class="card bg-dark-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Pending </h6>
                            <span
                                class="display-6 mb-0 text-dark-emphasis">{{ $orders->whereIn('status', [11])->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-warning-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">processing</h6>
                            <span
                                class="display-6 mb-0 text-warning-emphasis">{{ $orders->whereIn('status', [12,13,14,15])->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-primary-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Production Started</h6>
                            <span
                                class="display-6 mb-0 text-primary-emphasis">{{ $orders->where('status', 16)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-success-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Production Completed</h6>
                            <span
                                class="display-6 mb-0 text-success-emphasis">{{ $orders->where('status', 17)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-info-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Ready to Ship</h6>
                            <span
                                class="display-6 mb-0 text-info-emphasis">{{ $orders->where('status', 18)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-info-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Shipped</h6>
                            <span
                                class="display-6 mb-0 text-info-emphasis">{{ $orders->where('status', 19)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-success-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Delivered</h6>
                            <span
                                class="display-6 mb-0 text-success-emphasis">{{ $orders->where('status', 20)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-danger-subtle">
                    <div class="card-body">
                        <div class="col d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-body-secondary mb-2">Canceled</h6>
                            <span
                                class="display-6 mb-0 text-danger-emphasis">{{ $orders->where('status', 2)->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
