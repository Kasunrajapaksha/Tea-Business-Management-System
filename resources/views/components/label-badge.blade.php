@props(['title','diffIndays'])

<label  class="form-label">{{ $title }}
    @if( $diffIndays > 0)
    <span class="badge bg-danger-subtle text-danger ms-2"> {{ abs($diffIndays) != 1 ? number_format(abs($diffIndays)).' days delay' : 'One day delay' }}</span>
    @elseif ($diffIndays < 0)
    <span class="badge bg-success-subtle text-success ms-2"> {{ abs($diffIndays) != 1 ? number_format(abs($diffIndays)).' days early' : 'One day early' }}</span>
    @else
    <span class="badge bg-primary-subtle text-primary ms-2">On time</span>
    @endif
</label>
