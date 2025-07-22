<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Provider</li>
       </ol>
   </nav>

    <h1>Ports</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping.port.update',$port) }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label  class="form-label" for="port_name">Port Name</label>
                                <input type="text" class="form-control" name="port_name" value="{{ $port->port_name}}">
                                <x-error field="port_name" />
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('shipping.port.show',$port) }}" class="btn btn-secondary mt-2">Close</a>
                            @can('view',App\Models\ShippingProvider::class)
                            <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#addProvider">update Port</a>
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
                                    <h4>Are you sure you want to update this port?</h4>
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




