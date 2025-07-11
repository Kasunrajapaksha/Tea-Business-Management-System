
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

    @case(11)
        <span class="badge bg-secondary">Order Placed</span>
        @break
    @case(12)
        <span class="badge bg-info">Production Plan Created</span>
        @break
    @case(13)
        <span class="badge bg-primary">Shipping Scheduled</span>
        @break
    @case(14)
        <span class="badge bg-warning">Proforma Invoice Sent</span>
        @break
    @case(15)
        <span class="badge bg-success">Payment Verified</span>
        @break
    @case(16)
        <span class="badge bg-primary">Production Started</span>
        @break
    @case(17)
        <span class="badge bg-success">Production Completed</span>
        @break
    @case(18)
        <span class="badge bg-success">Ready to Ship</span>
        @break
    @case(19)
        <span class="badge bg-info">Shipped to Customer</span>
        @break
    @case(20)
        <span class="badge bg-dark">Order Delivered</span>
        @break
    @default
        <span class="badge bg-secondary">Unknown Status</span>
@endswitch
