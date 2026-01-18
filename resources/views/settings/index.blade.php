@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Application Settings</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="app_name">Application Name</label>
                    <input type="text" class="form-control" id="app_name" name="app_name" value="{{ $settings['app_name']->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="pagination_limit">Pagination Limit</label>
                    <input type="number" class="form-control" id="pagination_limit" name="pagination_limit" value="{{ $settings['pagination_limit']->value ?? 10 }}">
                </div>
                {{-- Add other setting fields here --}}
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>

</div>
@endsection
