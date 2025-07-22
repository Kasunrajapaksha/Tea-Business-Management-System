@props(['teaStocks'])

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
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">{{ $teaStock->tea_name }}</span>
            <span class="badge {{ $teaStock->stock_level < 1000 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} ">{{ $teaStock->stock_level == 0 ? 'out of stock' : $teaStock->stock_level.' Kg' }} </span>
        </div>
        @endforeach
    </div>
</div>
