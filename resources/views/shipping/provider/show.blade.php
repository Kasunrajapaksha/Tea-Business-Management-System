<x-app-layout>
    <x-slot:title> {{ Auth::user()->department->department_name }} | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('shipping.provider.index') }}'>All Shipping Providers</a></li>
            <li class="breadcrumb-item active">{{ $provider->provider_name}}</li>
        </ol>
    </nav>

    <x-success-alert />
    <x-danger-alert />

    <h1>Shipping Provider Details</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="provider_name">Provider No</label>
                            <input type="text" class="form-control" name="provider_name"
                                value="{{ $provider->provider_no }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="provider_name">Provider Name</label>
                            <input type="text" class="form-control" name="provider_name"
                                value="{{ $provider->provider_name }}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
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
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Updated on</label>
                            <input type="text" class="form-control"
                                value="{{ $provider->created_at->format('Y-m-d') }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Updated by</label>
                            <input type="text" class="form-control"
                                value="{{ $provider->user->first_name . ' ' . $provider->user->last_name }}" disabled>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <a href="{{ route('shipping.provider.index') }}" class="btn btn-secondary">Close</a>
                        <div class="d-flex">
                            @can('update', $provider)
                            @if ($provider->status == 'active')
                            <a class="btn btn-danger me-1" data-bs-toggle="modal" data-bs-target="#confirm">Deactivate Provider</a>
                            @else
                            <a class="btn btn-success me-1" data-bs-toggle="modal" data-bs-target="#confirm">Activate Provider</a>
                            @endif
                            @endcan
                            @can('update', App\Models\ShippingProvider::class)
                             <a href="{{ route('shipping.provider.edit', $provider) }}" type="submit" class="btn btn-primary ms-1">Edit Provider</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to update shipping provider status?</h4>
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
