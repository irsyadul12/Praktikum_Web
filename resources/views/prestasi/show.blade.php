@extends('layouts.master')

@section('title', 'Detail Prestasi')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Prestasi</h1>
        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $prestasi->nama_prestasi }}</h6>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Siswa:</strong> {{ $prestasi->student->name }}
                </li>
                <li class="list-group-item">
                    <strong>Nama Prestasi:</strong> {{ $prestasi->nama_prestasi }}
                </li>
                <li class="list-group-item">
                    <strong>Tingkat:</strong> {{ $prestasi->tingkat }}
                </li>
                <li class="list-group-item">
                    <strong>Tanggal:</strong> {{ $prestasi->tanggal }}
                </li>
                <li class="list-group-item">
                    <strong>Keterangan:</strong> {{ $prestasi->keterangan }}
                </li>
            </ul>
            <a href="{{ route('prestasi.edit', $prestasi->id) }}" class="btn btn-warning btn-icon-split mt-3">
                <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                <span class="text">Edit Prestasi</span>
            </a>
        </div>
    </div>
@endsection
