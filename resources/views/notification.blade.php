
<x-app-layout>
    <x-slot:title>Notifications</x-slot:title>

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-2">Notifications</h1>
        <div>
            <form action="{{ route('notifications.markAllAsRead') }}" method="post">
            @csrf
            @method('patch')
            <button type="submit" class="btn text-secondary">Mark all as read</button>
        </form>
        </div>
    </div>
    <hr>

     @if($notifications->isEmpty())
        <p>You have no notifications.</p>
    @else
    @foreach ($notifications as $notification)
    <div class="alert {{ $notification->read_at ? 'alert-secondary' : 'alert-'.$notification->data['color'] }} alert-dismissible d-flex align-items-center" role="alert">
        <div class="alert-icon me-3">
            <i class="align-middle" data-feather="{{ $notification->data['icon'] }}"></i>
        </div>
        <div class="alert-message d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
                <strong class="me-2">{{ $notification->data['title'] }}</strong>
                <div>{{ $notification->data['message'] }}</div>
            </div>
            <div class="text-muted small mt-1 ">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
        <div class="alert-secondary"></div>
        <form action="{{ route('notifications.markAsRead') }}" method="post">
            @csrf
            @method('patch')
            <input type="text" name="notification_id" value="{{ $notification->id }}" hidden>
            @if ($notification->read_at)
            <a href="#" class="btn btn-sm text-secondary ms-3 px-1 m-0 p-0"><i class="align-middle" data-feather="check"></i></a>
            @else
            <button type="submit" class="btn btn-sm text-{{ $notification->data['color'] }} ms-3 px-1 m-0 p-0"><i class="align-middle" data-feather="eye"></i></button>
            @endif
        </form>
    </div>
    @endforeach
    @endif


</x-app-layout>

