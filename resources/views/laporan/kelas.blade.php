@extends('layouts.master')

@section('title', 'Laporan Kelas')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Kelas</h1>

    <div class="d-flex justify-content-end mb-4 no-print">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kelas</th>
                            <th>Kapasitas</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $kelasItem)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelasItem->nama }}</td>
                            <td>{{ $kelasItem->kapasitas }}</td>
                            <td>{{ $kelasItem->guru ? $kelasItem->guru->name : 'N/A' }}</td>
                            <td>{{ $kelasItem->students->count() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Tidak ada data kelas.</td>
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
