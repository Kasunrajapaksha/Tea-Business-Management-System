@props(['field'])

@error($field)
    <p class="text-danger text-sm p-0 m-0">{{ $message }}</p>
@enderror
