<x-app-layout>
<x-slot:title>Customer Report</x-slot:title>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href='#'>Report</a></li>
        <li class="breadcrumb-item active">Customer</li>
    </ol>
</nav>

<div class="container-fluid p-0">

         <div class="card flex-fill mb-3 pb-2">
            <div class="card-body">
                <div>
                    <form method="GET" action="{{ route('admin.report.customer') }}">
                    @csrf
                        <div class="row">
                            <div class="d-flex justify-content-start col-12">
                                <div class="form-group me-3 col-3">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date') }}">
                                </div>
                                <div class="form-group me-3 col-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date') }}">
                                </div>
                                <div class="form-group me-2 col-3">
                                    <label for="end_date">Handle by</label>
                                    <select name="" id="" class="form-select">
                                        <option value="#">Select User</option>
                                        @foreach ($users as $user )
                                            <option value="{{ $user->id }}">{{ $user->first_name .' '. $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark align-self-end ms-auto"><i class="align-middle me-2" data-feather="filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">

                    <table class="table table-hover table-striped my-0" id="dataTable">

                        <thead>
                            <tr>
                                <th class="d-none d-xl-table-cell">Customer No</th>
                                <th class="d-none d-xl-table-cell">Customer Name</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Telephone</th>
                                <th class="d-none d-xl-table-cell">Address</th>
                                <th class="d-none d-xl-table-cell">Handle by</th>
                                <th class="d-none d-xl-table-cell">Added on</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="d-none d-xl-table-cell">{{ $customer->customer_no}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->first_name . ' ' . $customer->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->email}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->number}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->address}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->user->first_name . ' ' . $customer->user->last_name}}</td>
                                    <td class="d-none d-xl-table-cell">{{ $customer->created_at->format('Y-m-d')}}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
