<div class="row m-0 p-o">
    @if (session('success'))
        <div class="card-body">
            <div class="mb-3">
                <div class="alert alert-success alert-dismissible fade show fixed-top mb-0" role="alert">
                    <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" id="alert-close-btn"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
