@props(['materialStocks'])

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
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">{{ $materialStock->material_name }}</span>
            <span class="badge {{ $materialStock->stock_level < 100 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} ">{{ $materialStock->stock_level == 0 ? 'out of stock' : $materialStock->stock_level.' Units' }} </span>
        </div>
        @endforeach
    </div>
</div>
