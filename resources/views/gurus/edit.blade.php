@extends('layouts.master')

@section('title', 'Edit Guru')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Guru</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('gurus.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('gurus._form', ['guru' => $guru, 'submitButtonText' => 'Update'])
            </form>
        </div>
    </div>
@endsection
