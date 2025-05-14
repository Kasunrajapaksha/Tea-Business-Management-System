@php
    $user = Auth::user();
@endphp

<x-app-layout>
    <x-slot:title>Finance | Payment Requests</x-slot:title>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href='{{ route('finance.index') }}'>Finance</a></li>
            <li class="breadcrumb-item active">Payment Requests</li>
        </ol>
    </nav>

    <x-success-alert />

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">{{ $user->department->department_name == 'Finance' ? 'Pending Payment Requests' : 'All Payment Requests' }}</a></li>
                        @if ($user->department->department_name == 'Finance')
                            <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab" role="tab"> Payment Requests</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1" role="tabpanel">
                            <div class="p-3">
                                <h1 class="d-inline align-middle">{{ $user->department->department_name == 'Finance' ? 'Pending Payment Requests' : 'All Payment Requests' }}</h1>
                            </div>

                            <div class="col-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-body">
                                        @if ($requests->isEmpty())
                                            <div>No Payment Requests</div>
                                        @else
                                            <table class="table table-hover table-striped my-0">

                                                <thead>
                                                    <tr>
                                                        <th class="d-none d-xl-table-cell">Request No</th>
                                                        <th class="d-none d-xl-table-cell">Requested By</th>
                                                        <th class="d-none d-xl-table-cell">Requested Date</th>
                                                        <th class="d-none d-xl-table-cell">Status</th>
                                                        <th class="d-none d-md-table-cell">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($requests as $request)
                                                        <tr>
                                                            <td class="d-none d-xl-table-cell">
                                                                {{ $request->request_no }}</td>
                                                            <td class="d-none d-xl-table-cell">
                                                                {{ $request->requester->first_name . ' ' . $request->requester->last_name }}
                                                            </td>
                                                            <td class="d-none d-xl-table-cell">
                                                                {{ $request->created_at->diffForHumans() }}</td>

                                                            <td class="d-none d-xl-table-cell">
                                                                <x-status :status='$request->status' />
                                                            </td>

                                                            <td class="d-none d-xl-table-cell">


                                                                <div class="d-flex align-items-center">
                                                                    <form
                                                                        action="{{ route('finance.request.show', $request) }}"
                                                                        method="get">
                                                                        @csrf
                                                                        <button
                                                                            class="btn btn-sm btn-primary">{{ $user->department->department_name == 'Finance' ? 'Review' : 'View' }}</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if ($user->department->department_name == 'Finance')
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <div class="p-3">
                                    <h1 class="d-inline align-middle">My Payment Requests</h1>
                                </div>

                                <div class="col-12 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            @if ($myRequests->isEmpty())
                                                <div>No Payment Requests</div>
                                            @else
                                                <table class="table table-hover table-striped my-0">

                                                    <thead>
                                                        <tr>
                                                            <th class="d-none d-xl-table-cell">Request No</th>
                                                            <th class="d-none d-xl-table-cell">Requested By</th>
                                                            <th class="d-none d-xl-table-cell">Requested Date</th>
                                                            <th class="d-none d-xl-table-cell">Status</th>
                                                            <th class="d-none d-md-table-cell">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @foreach ($myRequests as $myRequest)
                                                            <tr>
                                                                <td class="d-none d-xl-table-cell">
                                                                    {{ $myRequest->request_no }}</td>
                                                                <td class="d-none d-xl-table-cell">
                                                                    {{ $myRequest->requester->first_name . ' ' . $myRequest->requester->last_name }}
                                                                </td>
                                                                <td class="d-none d-xl-table-cell">
                                                                    {{ $myRequest->created_at->diffForHumans() }}</td>

                                                                <td class="d-none d-xl-table-cell">
                                                                    <x-status :status='$myRequest->status' />
                                                                </td>

                                                                <td class="d-none d-xl-table-cell">


                                                                    <div class="d-flex align-items-center">
                                                                        <form
                                                                            action="{{ route('finance.request.show', $myRequest) }}"
                                                                            method="get">
                                                                            @csrf
                                                                            <button
                                                                                class="btn btn-sm btn-primary">{{ $user->department->department_name == 'Finance' ? 'Review' : 'View' }}</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>



</x-app-layout>
