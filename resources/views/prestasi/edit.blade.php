@extends('layouts.master')

@section('title', 'Edit Prestasi')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Prestasi</h1>
        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST">
                @method('PUT')
                @include('prestasi._form', ['prestasi' => $prestasi])

                <div class="mt-3 text-right">
                    <a href="{{ route('prestasi.index') }}" class="btn btn-light">Batal</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
