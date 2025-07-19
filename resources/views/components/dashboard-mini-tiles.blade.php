@props(['title', 'numbers', 'icon', 'link', 'col'])

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
                    <div class="stat bg-success-subtle">
                        <a href="{{ $link }}"><i class="align-middle" data-feather="file-text"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
