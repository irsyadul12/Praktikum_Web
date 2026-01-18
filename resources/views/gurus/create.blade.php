@extends('layouts.master')

@section('title', 'Tambah Guru')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Guru</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('gurus.store') }}" method="POST" enctype="multipart/form-data">
                @include('gurus._form', ['submitButtonText' => 'Tambah'])
            </form>
        </div>
    </div>
@endsection
