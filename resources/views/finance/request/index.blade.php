
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
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h1>All Requests</h1>
                        @if ($requests->isEmpty())
                            <div>No Payment Requests</div>
                        @else
                            <table class="table table-hover table-striped my-0">

                                <thead>
                                    <tr>
                                        <th class="d-none d-xl-table-cell">Request No</th>
                                        <th class="d-none d-xl-table-cell">Item name</th>
                                        <th class="d-none d-xl-table-cell">Amount (LKR)</th>
                                        <th class="d-none d-xl-table-cell">Requested by</th>
                                        <th class="d-none d-xl-table-cell">Requested on</th>
                                        <th class="d-none d-xl-table-cell">Status</th>
                                        <th class="d-none d-md-table-cell">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($requests as $request)
                                        <tr>
                                            <td class="d-none d-xl-table-cell">{{ $request->request_no }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $request->material_perchese ? $request->material_perchese->material->material_name : $request->tea_perchese->tea->tea_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ number_format($request->amount,2) }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $request->requester->first_name . ' ' . $request->requester->last_name }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $request->created_at->toDateString() }}</td>

                                            <td class="d-none d-xl-table-cell">
                                                <x-status :status='$request->status' />
                                            </td>

                                            <td class="d-none d-xl-table-cell">
                                                <div class="d-flex align-items-center">

                                                    <form
                                                        action="{{ route('finance.request.show', $request) }}" method="get">
                                                        @csrf
                                                        <button class="btn btn-sm btn-primary">Review</button>
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


    <div class="col-12 px-3">
        {{ $requests->links() }}
    </div>

</x-app-layout>
