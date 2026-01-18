@extends('layouts.master')

@section('title', 'Detail Guru')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Guru</h1>
        <a href="{{ route('gurus.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($guru->photo)
                        <img src="{{ asset('storage/gurus/' . $guru->photo) }}" alt="foto" class="img-fluid rounded-circle" style="max-width: 200px;">
                    @else
                        <img src="{{ asset('img/undraw_profile.svg') }}" alt="foto" class="img-fluid rounded-circle" style="max-width: 200px;">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $guru->name }}</td>
                        </tr>
                        <tr>
                            <th>NUPTK</th>
                            <td>{{ $guru->nuptk }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $guru->email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $guru->phone }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $guru->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
