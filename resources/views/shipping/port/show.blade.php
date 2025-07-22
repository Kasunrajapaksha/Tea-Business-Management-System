<x-app-layout>
    <x-slot:title> Shipping | Shipping Provider </x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Shipping</a></li>
           <li class="breadcrumb-item active">Shipping Provider</li>
       </ol>
   </nav>

   <x-success-alert />

    <h1>Ports</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        @csrf

                        <input type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label  class="form-label" for="port_name">Port Name</label>
                                <input type="text" class="form-control" name="port_name" value="{{ $port->port_name}}" disabled>
                                <x-error field="port_name" />
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('shipping.port.index') }}" class="btn btn-secondary mt-2">Close</a>
                            @can('view',App\Models\ShippingProvider::class)
                            <a href="{{ route('shipping.port.edit',$port) }}" class="btn btn-primary mt-2 ms-2">Edit Port</a>
                            @endcan
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>




