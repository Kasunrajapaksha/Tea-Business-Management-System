<x-app-layout>
    <x-slot:title>Management | Dashboard</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='#'>Management</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <h1 class="mb-4">Management Dashboard</h1>

    <div class="row">
        <x-dashboard-mini-tiles col="col-3" title="User" icon="users" :numbers="$users->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Customers" icon="users" :numbers="$customers->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Suppliers" icon="users" :numbers="$suppliers->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Ship. Providers" icon="users" :numbers="$providers->count()"
            link="" />
    </div>

    <div class="row">
        <x-dashboard-md-tiles col="col-4" title="Orders" icon="package" :numbers="$ordersThisMonth.' Orders'" link=""
            :last="$ordersLastMonth.' Orders'" :total="$totalOrders.' Orders'" :percentage="$orderPercentage.' %'" />
        <x-dashboard-md-tiles col="col-4" title="Revenue" icon="dollar-sign" :numbers="5000" link=""
            last="" total="" percentage="" />
        <x-dashboard-md-tiles col="col-4" title="Cost" icon="dollar-sign" :numbers="number_format($costThisMonth) . ' LKR'" link=""
            :last="number_format($costLastMonth) . ' LKR'" :total="number_format($totalCost) . ' LKR'" :percentage="number_format($costPercentage, 2) . ' %'" />
    </div>
    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center gx-0">
                        <div class="col">
                            <h6 class="text-uppercase text-body-secondary mb-2"> Tea Stocks </h6>
                            <span class="h2 mb-0"> {{$teaStocks->sum('stock_level')}} Kg</span>
                            <span class="text-danger"></span>
                        </div>
                        <div class="col-auto">
                            <div class="stat">
                                <i class="align-middle" data-feather="coffee"></i>
                            </div>
                        </div>
                        <div class="col-auto ms-1">
                            <div class="stat bg-success-subtle">
                                <a href=""><i class="align-middle" data-feather="file-text"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @foreach ( $teaStocks as $teaStock )
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">{{ $teaStock->tea_name }}</span>
                        <span class="badge {{ $teaStock->stock_level < 500 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} ">{{ $teaStock->stock_level == 0 ? 'out of stock' : $teaStock->stock_level.' Kg' }} </span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center gx-0">
                        <div class="col">
                            <h6 class="text-uppercase text-body-secondary mb-2"> Material Stocks</h6>
                            <span class="h2 mb-0"> {{$materialStocks->sum('stock_level')}} Units</span>
                            <span class="text-danger"></span>
                        </div>
                        <div class="col-auto">
                            <div class="stat">
                                <i class="align-middle" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                        <div class="col-auto ms-1">
                            <div class="stat bg-success-subtle">
                                <a href=""><i class="align-middle" data-feather="file-text"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @foreach ( $materialStocks as $materialStock )
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">{{ $materialStock->material_name }}</span>
                        <span class="badge {{ $materialStock->stock_level < 100 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} ">{{ $materialStock->stock_level == 0 ? 'out of stock' : $materialStock->stock_level.' Units' }} </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center gx-0">
                        <div class="col">
                            <h3 class="text-uppercase text-body-secondary mb-2">Order Status </h3>
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
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-warning">
                        <span class="h3 mb-0 text-warning d-flex align-items-center"><i class="align-middle me-3" data-feather="alert-circle"></i>Pending</span>
                        <span class="h3 mb-0 text-warning">{{ $orders->whereIn('status', [11,12,13,14,15])->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-primary">
                        <span class="h3 mb-0 text-primary d-flex align-items-center"><i class="align-middle me-3" data-feather="loader"></i>Production Started</span>
                        <span class="h3 mb-0 text-primary">{{ $orders->where('status', 16)->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-success">
                        <span class="h3 mb-0 text-success d-flex align-items-center"><i class="align-middle me-3" data-feather="check-circle"></i>Production Completed</span>
                        <span class="h3 mb-0 text-success">{{ $orders->where('status', 17)->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-success">
                        <span class="h3 mb-0 text-success d-flex align-items-center"><i class="align-middle me-3" data-feather="package"></i>Ready to Ship</span>
                        <span class="h3 mb-0 text-success">{{ $orders->where('status', 18)->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-info">
                        <span class="h3 mb-0 text-info d-flex align-items-center"><i class="align-middle me-3" data-feather="anchor"></i>Shipped to Customer</span>
                        <span class="h3 mb-0 text-info">{{ $orders->where('status', 19)->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-dark">
                        <span class="h3 mb-0 text-dark d-flex align-items-center"><i class="align-middle me-3" data-feather="user-check"></i>Delivered</span>
                        <span class="h3 mb-0 text-dark">{{ $orders->where('status', 20)->count()}} orders</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1 px-3 py-1 alert alert-danger">
                        <span class="h3 mb-0 text-danger d-flex align-items-center"><i class="align-middle me-3" data-feather="x-circle"></i>Canceled</span>
                        <span class="h3 mb-0 text-danger">{{ $orders->where('status', 2)->count()}} orders</span>
                    </div>
                </div>
            </div>
        </div>

    </div>



</x-app-layout>


