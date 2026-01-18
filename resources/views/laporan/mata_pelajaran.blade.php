@extends('layouts.master')

@section('title', 'Laporan Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Mata Pelajaran</h1>

    <div class="card shadow mb-4 no-print">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.mata-pelajaran') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-10">
                        <div class="form-group mb-0">
                            <label for="nama_mapel">Nama Mata Pelajaran</label>
                            <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" value="{{ request('nama_mapel') }}" placeholder="Cari Nama Mata Pelajaran">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4 no-print">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran
                @if(request('nama_mapel'))
                    (Filter: {{ request('nama_mapel') }})
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mataPelajarans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_mapel }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">Tidak ada data mata pelajaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: relative;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            box-shadow: none;
            border: 1px solid #ccc;
            page-break-inside: avoid;
            margin-bottom: 20px;
        }
        .card-header, .no-print {
            display: none !important;
        }
        .table thead tr th, .table tbody tr td {
            border: 1px solid #dee2e6;
            padding: .75rem;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
    }
</style>
@endpush
