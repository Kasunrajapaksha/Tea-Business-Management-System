<x-app-layout>
    <x-slot:title>Management | Dashboard</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='#'>Management</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <h1 class="mb-4">Management Dashboard</h1>
    {{-- top row --}}
    <div class="row">
        <x-dashboard-mini-tiles col="col-3" title="User" icon="users" :numbers="$users->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Customers" icon="users" :numbers="$customers->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Suppliers" icon="users" :numbers="$suppliers->count()" link="" />
        <x-dashboard-mini-tiles col="col-3" title="Ship. Providers" icon="users" :numbers="$providers->count()"
            link="" />

    </div>

    {{-- second row --}}
    <div class="row">

        {{-- left col --}}
        <div class="col-6">

            <div class="row">
                <x-dashboard-md-tiles col="col-12" title="Orders" icon="package" :numbers="$ordersThisMonth . ' Orders'" link=""
                    :last="$ordersLastMonth . ' Orders'" :total="$totalOrders . ' Orders'" :percentage="$orderPercentage . ' %'" />
            </div>
            <div class="row">
                <x-dashboard-md-tiles col="col-12" title="Revenue" icon="dollar-sign" :numbers="$revenueThisMonth" link=""
                    :last="$revenueLastMonth" :total="$totalRevenue" :percentage="$revenuePercentage" />
            </div>
            <div class="row">
                <x-dashboard-md-tiles col="col-12" title="Cost" icon="dollar-sign" :numbers="number_format($costThisMonth) . ' LKR'" link=""
                    :last="number_format($costLastMonth) . ' LKR'" :total="number_format($totalCost) . ' LKR'" :percentage="number_format($costPercentage, 2) . ' %'" />
            </div>
            <div class="row">
                <x-dashboard-purchase-items :payment_requests="$payment_requests" />
            </div>

        </div>

        {{-- right col --}}
        <div class="col-6">
            <x-dashboard-order-status :orders="$orders" />
            <x-dashboard-tea-stock :teaStocks="$teaStocks" />
            <x-dashboard-material-stock :materialStocks="$materialStocks" />
        </div>
    </div>

</x-app-layout>
