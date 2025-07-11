<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Provider</li>
       </ol>
   </nav>

    <h1>Shipping Provider</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping.provider.store') }}" method="post">
                        @csrf

                        <input type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" for="provider_name">Provider Name</label>
                                <input type="text" class="form-control" name="provider_name">
                                <x-error field="provider_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" for="tracking_number">Tracking No</label>
                                <input type="text" class="form-control" name="tracking_number">
                                <x-error field="tracking_number" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" for="email">Provider Email</label>
                                <input type="text" class="form-control" name="email">
                                <x-error field="email" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label" for="number">Provider Telephone</label>
                                <input type="text" class="form-control" name="number">
                                <x-error field="number" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end">
                            <a href="{{ route('shipping.provider.index') }}" class="btn btn-danger mt-2">Close</a>
                            @can('view',App\Models\ShippingProvider::class)
                            <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#addProvider">Add Provider</a>
                            @endcan
                        </div>

                        <div class="modal fade" id="addProvider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to add this provider?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>




