
@props(['status'])

@switch($status)
    @case(0)
        <span class="badge bg-secondary">Pending</span>
        @break
    @case(1)
        <span class="badge bg-warning">Under Review</span>
        @break
    @case(3)
        <span class="badge bg-success">Completed</span>
        @break
    @case(4)
        <span class="badge bg-danger">On Hold</span>
        @break
    @case(5)
        <span class="badge bg-danger">Not Approved</span>
        @break
    @case(6)
        <span class="badge bg-danger">Canceled</span>
        @break
    @default
        <span class="badge bg-secondary">Unknown Status</span>
@endswitch
