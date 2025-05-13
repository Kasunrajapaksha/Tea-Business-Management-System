<x-app-layout>
    <x-slot:title>Tea | Tea Type</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ route('tea.teaType.index') }}">Tea Type</a></li>
           <li class="breadcrumb-item active">Create Tea Type</li>
       </ol>
   </nav>

    <h1>Update Tea Type</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('tea.teaType.update', $tea) }}" method="POST">
                        @csrf
                        @method('patch')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tea_name" class="form-label">Tea Name</label>
                                <input type="text" class="form-control" id="tea_name" name="tea_name" value="{{ $tea->tea_name }}">
                                <x-error field="tea_name" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tea_standard" class="form-label">Standard</label>
                                <input type="text" class="form-control" id="tea_standard" name="tea_standard" value="{{ $tea->tea_standard }}">
                                <x-error field="tea_standard" />
                            </div>
                        </div>

                        <a href="{{ route('tea.teaType.index' ) }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Edit Tea</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
