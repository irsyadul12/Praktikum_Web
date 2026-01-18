@extends('layouts.master')

@section('title', 'Laporan Prestasi')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Prestasi Siswa</h1>

    <div class="card shadow mb-4 no-print">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan Prestasi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.prestasi') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="student_id">Siswa</label>
                            <select name="student_id" id="student_id" class="form-control">
                                <option value="">-- Semua Siswa --</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="tingkat">Tingkat</label>
                            <select name="tingkat" id="tingkat" class="form-control">
                                <option value="">-- Semua Tingkat --</option>
                                @foreach (['Nasional', 'Provinsi', 'Kota/Kabupaten', 'Sekolah'] as $tingkatOption)
                                    <option value="{{ $tingkatOption }}" {{ request('tingkat') == $tingkatOption ? 'selected' : '' }}>
                                        {{ $tingkatOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label for="start_date">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label for="end_date">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
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
            <h6 class="m-0 font-weight-bold text-primary">Data Prestasi Siswa
                @if(request('student_id'))
                    untuk {{ $students->firstWhere('id', request('student_id'))->name ?? '' }}
                @endif
                @if(request('tingkat'))
                    Tingkat {{ request('tingkat') }}
                @endif
                @if(request('start_date') || request('end_date'))
                    Tanggal
                    @if(request('start_date'))
                        {{ \Carbon\Carbon::parse(request('start_date'))->format('d-m-Y') }}
                    @endif
                    @if(request('start_date') && request('end_date'))
                        s/d
                    @endif
                    @if(request('end_date'))
                        {{ \Carbon\Carbon::parse(request('end_date'))->format('d-m-Y') }}
                    @endif
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Nama Prestasi</th>
                            <th>Tingkat</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prestasis as $prestasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prestasi->student->name ?? 'N/A' }}</td>
                            <td>{{ $prestasi->nama_prestasi }}</td>
                            <td>{{ $prestasi->tingkat }}</td>
                            <td>{{ $prestasi->keterangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data prestasi.</td>
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
