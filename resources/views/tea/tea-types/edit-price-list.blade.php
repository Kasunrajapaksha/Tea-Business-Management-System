<x-app-layout>
    <x-slot:title>Tea | Tea Type</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('tea.teaType.index') }}">Tea Type</a></li>
           <li class="breadcrumb-item active">Create Price List</li>
       </ol>
   </nav>

    <h1>Update Price List</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('tea.teaType.update.price.list', $tea) }}" method="POST">
                        @csrf
                        @method('patch')

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tea_name" class="form-label">Tea Name</label>
                                <input type="text" class="form-control" id="tea_name" name="tea_name" value="{{ $tea->tea_name }}" disabled>
                                <x-error field="tea_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tea_standard" class="form-label">Standard</label>
                                <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->tea_standard }}" disabled>
                                <x-error field="tea_standard" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="price_per_Kg" class="form-label">Price Per Kg (USD)</label>
                            <input type="text" class="form-control" id="price_per_Kg" name="price_per_Kg" value="{{ $tea->price_per_Kg }}">
                            <x-error field="price_per_Kg" />
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('tea.teaType.index' ) }}" class="btn btn-secondary mt-2">Close</a>
                            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#updateTea">Update Price List</a>
                        </div>

                        <div class="modal fade" id="updateTea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to update the price list?</h4>
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
