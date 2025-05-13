<x-app-layout>
<x-slot:title>Tea | Purchase</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='{{ route('tea.purchase.index') }}'>Tea Purchases</a></li>
        <li class="breadcrumb-item active">Purchase Tea</li>
    </ol>
</nav>

    <h1>Purchase Tea</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('tea.purchase.store') }}" method="POST">
                        @csrf

                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="tea_id" class="form-label">Tea</label>
                                <select class="form-control" id="tea_id" name="tea_id">
                                    <option value="">Choose a tea</option>
                                    @foreach ($teas as $tea)
                                    <option value="{{ $tea->id }}">{{ $tea->tea_name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="tea_id" />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    <option value="">Choose a supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="supplier_id" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="quantity" class="form-label">Quantity (Kg)</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity')}}">
                                <x-error field="quantity" />
                            </div>
                        </div>

                        <a href="{{ route('tea.purchase.index' ) }}" class="btn btn-danger mt-2">Close</a>
                        <button type="submit" class="btn btn-primary mt-2">Add New Tea</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
