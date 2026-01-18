@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Notifications</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Your Notifications</h6>
            @if (Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-primary">Mark All as Read</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            @forelse ($notifications as $notification)
                <a href="{{ route('notifications.show', $notification->id) }}" class="list-group-item list-group-item-action @if (is_null($notification->read_at)) list-group-item-light @endif">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $notification->data['message'] ?? 'New Notification' }}</h5>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">
                        @if (isset($notification->data['user_name']))
                            User: {{ $notification->data['user_name'] }}
                        @endif
                        @if (isset($notification->data['link']))
                            <br><small>Click to view</small>
                        @endif
                    </p>
                    @if (is_null($notification->read_at))
                        <small class="text-primary">Unread</small>
                    @else
                        <small class="text-muted">Read {{ $notification->read_at->diffForHumans() }}</small>
                    @endif
                </a>
                @if (!$loop->last)
                    <hr class="my-2">
                @endif
            @empty
                <div class="alert alert-info" role="alert">
                    You have no notifications.
                </div>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
