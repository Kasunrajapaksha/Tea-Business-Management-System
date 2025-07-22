@props(['title', 'numbers', 'icon', 'link', 'percentage', 'last', 'total', 'col'])


<div class="{{ $col }}">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center gx-0">
                <div class="col">
                    <h6 class="text-uppercase text-body-secondary mb-2"> {{ $title }} </h6>
                    <span class="h2 mb-0"> {{ $numbers }} </span>
                    <span class="text-danger"></span>
                </div>
                <div class="col-auto">
                    <div class="stat">
                        <i class="align-middle" data-feather="{{ $icon }}"></i>
                    </div>
                </div>
                <div class="col-auto ms-1">
                    <div class="stat bg-success-subtle text-success">
                        <a href="{{ $link }}"><i class="align-middle" data-feather="file-text"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-0 mt-3">
                <span class="badge text-muted">Last month</span>
                <span class="badge text-muted">{{ $last }}</span>
            </div>
            <div class="d-flex justify-content-between mb-0 mt-1">
                <span class="badge text-muted">Total </span>
                <span class="badge text-muted">{{ $total }}</span>
            </div>
            <div class="mb-0 mt-3 ">
                @if ($percentage <= 0)
                <span class="badge bg-danger-subtle text-danger"><i class="align-middle me-2" data-feather="trending-down"></i>{{ $percentage }} Since last month</span>
                @elseif($percentage > 0)
                <span class="badge bg-success-subtle text-success"><i class="align-middle me-2" data-feather="trending-up"></i>{{ $percentage }} Since last month</span>
                @endif
            </div>
        </div>
    </div>
</div>
