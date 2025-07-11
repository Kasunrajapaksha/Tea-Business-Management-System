
<x-app-layout>
    <x-slot:title>Admin | Dashboard</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('admin.index') }}'>Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <h1>Admin Dashboard</h1>

    <div class="row mt-3">


        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Users</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $users->count()}}</h1>
                    <div class="mb-0">
                        <span class="text-danger">{{ $customersAddedThisMonth }}</span>
                        <span class="text-muted"> added this month</span>
                    </div>
                    <a href="" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Customers</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $customers->count()}}</h1>
                    <div class="mb-0">
                        <span class="text-danger">{{ $customersAddedThisMonth }}</span>
                        <span class="text-muted"> added this month</span>
                    </div>
                    <a href="{{ route('admin.report.customer') }}" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>



        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Orders</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="package"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $orders->count() }}</h1>
                    <div class="mb-0">
                        <span class="text-danger">5</span>
                        <span class="text-muted">orders this month</span>
                    </div>
                    <a href="{{ route('admin.report.order') }}" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Suppliers</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $suppliers->count()}}</h1>
                    <div class="mb-0">
                        <span class="text-danger">2</span>
                        <span class="text-muted"> added this month</span>
                    </div>
                    <a href="" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Income</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3"> 111,342 LKR</h1>
                    <div class="mb-0">
                        <span class="text-danger">32,178 LKR</span>
                        <span class="text-muted">This month</span>
                    </div>
                    <a href="" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Supplier Payment</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ number_format($total_supplier_payaments) }} LKR</h1>
                    <div class="mb-0">
                        <span class="text-danger">15,600</span>
                        <span class="text-muted">This month</span>
                    </div>
                    <a href="{{ route('admin.report.supplier.payament') }}" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Tea Purchases</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="coffee"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ number_format($total_tea_purchases) }} LKR</h1>
                    <div class="mb-0">
                        <span class="text-danger">10,320 LKR</span>
                        <span class="text-muted">This month</span>
                    </div>
                    <a href="{{ route('admin.report.tea.purchase') }}" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Material Purchases</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ number_format($total_material_purchases) }} LKR</h1>
                    <div class="mb-0">
                        <span class="text-danger">3,450 LKR</span>
                        <span class="text-muted">This month</span>
                    </div>
                    <a href="" class="btn btn-sm btn-success mt-2"><i class="align-middle" data-feather="file"></i> Report</a>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>

