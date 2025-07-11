<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=''>Shipping</a></li>
            <li class="breadcrumb-item active">Shipping Provider</li>
        </ol>
    </nav>

    <x-success-alert />
    <x-danger-alert />

    <h1>Shipping Provider</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Created at</label>
                            <input type="text" class="form-control"
                                value="{{ $provider->created_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Updated at</label>
                            <input type="text" class="form-control"
                                value="{{ $provider->created_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Created by</label>
                            <input type="text" class="form-control"
                                value="{{ $provider->user->first_name . ' ' . $provider->user->last_name }}" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="provider_name">Provider Name</label>
                            <input type="text" class="form-control" name="provider_name"
                                value="{{ $provider->provider_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="tracking_number">Tracking No</label>
                            <input type="text" class="form-control" name="tracking_number"
                                value="{{ $provider->tracking_number }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Provider Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $provider->email }}"
                                disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="number">Provider Telephone</label>
                            <input type="text" class="form-control" name="number" value="{{ $provider->number }}"
                                disabled>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('shipping.provider.index') }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                            @can('delete', $provider)
                                <a class="btn btn-danger mt-2 ms-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteProvider">Delete Provider</a>
                            @endcan
                            @can('update', App\Models\ShippingProvider::class)
                                <form action="{{ route('shipping.provider.edit', $provider) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-2 ms-1">Edit Provider</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deleteProvider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to delete {{ $provider->provider_name }}?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('shipping.provider.destroy', $provider) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
