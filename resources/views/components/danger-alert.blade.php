<div class="row m-0 p-o">
    @if (session('danger'))
        <div class="card-body">
            <div class="mb-3">
                <div class="alert alert-danger alert-dismissible fade show fixed-top mb-0" role="alert">
                    <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" id="alert-close-btn"></button>
                    <div class="alert-message">
                        {{ session('danger') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
