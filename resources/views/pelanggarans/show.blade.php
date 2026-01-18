@extends('layouts.master')

@section('title', 'Detail Pelanggaran')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pelanggaran</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pelanggaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">Nama Siswa</th>
                            <td>{{ $pelanggaran->student->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>{{ $pelanggaran->student->nis ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>{{ $pelanggaran->jenis }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $pelanggaran->kategori }}</td>
                        </tr>
                        <tr>
                            <th>Poin</th>
                            <td><span class="badge badge-danger">{{ $pelanggaran->poin }}</span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pelanggaran->tanggal ? $pelanggaran->tanggal->format('d F Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $pelanggaran->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Sanksi</th>
                            <td>{{ $pelanggaran->sanksi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <td>{{ $pelanggaran->creator->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $pelanggaran->created_at->format('d F Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 text-right">
                <a href="{{ route('pelanggarans.edit', $pelanggaran->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection