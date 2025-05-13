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


                        <a href="{{ route('tea.teaType.index' ) }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Edit Tea</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
