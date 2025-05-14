
@props(['status'])

@switch($status)
    @case(0)
        <span class="badge bg-secondary">Pending</span>
        @break
    @case(1)
        <span class="badge bg-warning">Under Review</span>
        @break
    @case(2)
        <span class="badge bg-primary">On Hold</span>
        @break
    @case(3)
        <span class="badge bg-secondary">Canceled</span>
        @break
    @case(4)
        <span class="badge bg-danger">Not Approved</span>
        @break
    @case(5)
        <span class="badge bg-success">Completed</span>
        @break
    @default
        <span class="badge bg-secondary">Unknown Status</span>
@endswitch
