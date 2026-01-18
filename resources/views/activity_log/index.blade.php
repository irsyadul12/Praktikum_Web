@extends('layouts.admin')

@section('title', 'Activity Log')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Activity Log</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent Activities</h6>
        </div>
        <div class="card-body">
            <p>This is a placeholder for the activity log. In a real application, this would display a list of recent user actions or system events.</p>

            @if (count($activities) > 0)
                <div class="list-group">
                    @foreach ($activities as $activity)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $activity->description }} - <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    No activities to display.
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
