
@props(['status'])

@switch($status)
    @case(0)
        <span class="badge bg-dark">Pending</span>
        @break
    @case(1)
        <span class="badge bg-warning">Under Review</span>
        @break
    @case(2)
        <span class="badge bg-warning">On Hold</span>
        @break
    @case(3)
        <span class="badge bg-secondary">Canceled</span>
        @break
    @case(4)
        <span class="badge bg-danger">Not Approved</span>
        @break
    @case(5)
        <span class="badge bg-primary">Paid</span>
        @break
    @case(6)
        <span class="badge bg-success">Received</span>
        @break
    @case(7)
        <span class="badge bg-success">Complited</span>
        @break
    @default
        <span class="badge bg-secondary">Unknown Status</span>
@endswitch
