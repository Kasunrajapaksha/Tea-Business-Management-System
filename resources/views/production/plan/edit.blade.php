<x-app-layout>
    <x-slot:title>Production | Production Plan</x-slot:title>

    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href=''>Production</a></li>
           <li class="breadcrumb-item"><a href="">Order</a></li>
           <li class="breadcrumb-item active">Production Plan</li>
       </ol>
   </nav>

    <h1>Production Plan</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="production_start">Production Start</label>
                            <input type="date" class="form-control" name="production_start" value="{{ $plan->production_start }}" min="{{ date('Y-m-d') }}" form="production-form">
                            <x-error field="production_start" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label  class="form-label" for="production_end">Production End</label>
                            <input type="date" class="form-control" name="production_end" value="{{ $plan->production_end }}" min="{{ date('Y-m-d') }}" form="production-form">
                            <x-error field="production_end" />
                        </div>
                    </div>


                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" form="production-form">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('production.plan.show', $plan) }}" class="btn btn-secondary mt-2">Close</a>
                        @can('update',$plan)
                        <a class="btn btn-primary mt-2 ms-2" data-bs-toggle="modal" data-bs-target="#updateOrder">Update Plan</a>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="updateOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-3" id="staticBackdropLabel">Confirm!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Are you sure you want to update the order?</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('production.plan.update', $plan) }}" method="POST" id="production-form">
            @csrf
            @method('PATCH')
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </form>
        </div>
    </div>
</div>


