@extends('layouts.master')

@section('title', 'Edit Kelas')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kelas</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('kelas.update', $kela->id) }}" method="post">
                @method('PUT')
                @include('kelas._form', ['kelas' => $kela])
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
