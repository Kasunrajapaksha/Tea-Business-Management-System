<x-app-layout>
    <x-slot:title>Tea | Tea Type</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('tea.teaType.index') }}">Tea Type</a></li>
           <li class="breadcrumb-item active">Tea Type</li>
       </ol>
   </nav>

    <h1>Tea Type</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="tea_name" class="form-label">Tea No</label>
                            <input type="text" class="form-control" id="tea_name" name="tea_name" value="{{ $tea->tea_no }}" disabled>
                            <x-error field="tea_name" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tea_name" class="form-label">Tea Name</label>
                            <input type="text" class="form-control" id="tea_name" name="tea_name" value="{{ $tea->tea_name }}" disabled>
                            <x-error field="tea_name" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="tea_standard" class="form-label">Standard</label>
                            <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->tea_standard }}" disabled>
                            <x-error field="tea_standard" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tea_standard" class="form-label">Price Per Kg (USD)</label>
                            <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->price_per_Kg }}" disabled>
                            <x-error field="tea_standard" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tea_standard" class="form-label">Stock Level (Kg)</label>
                            <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->stock_level }}" disabled>
                            <x-error field="tea_standard" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="tea_standard" class="form-label">Updated on</label>
                            <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->updated_at->toDateString() }}" disabled>
                            <x-error field="tea_standard" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tea_standard" class="form-label">Updated at</label>
                            <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->user->first_name . ' ' . $tea->user->last_name }}" disabled>
                            <x-error field="tea_standard" />
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('tea.teaType.index' ) }}" class="btn btn-secondary mt-2">Close</a>
                        <div class="d-flex">
                            @can('delete',$tea)
                            <a class="btn btn-danger mt-2 me-1" data-bs-toggle="modal" data-bs-target="#deleteTea">Delete Tea</a>
                            @endcan
                            @can('update', $tea)
                            <a href="{{ route('tea.teaType.edit' ,$tea) }}" class="btn btn-primary mt-2 ms-1">Edit Tea</a>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="deleteTea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to delete the tea?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('tea.teaType.destroy', $tea) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>
