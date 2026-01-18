@extends('layouts.master')

@section('title', 'Laporan Absensi')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Absensi</h1>

    <div class="card shadow mb-4 no-print">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan Absensi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.absensi') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($allKelas as $kelasItem)
                                    <option value="{{ $kelasItem->id }}" {{ request('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                        {{ $kelasItem->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="start_date">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
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
            <h6 class="m-0 font-weight-bold text-primary">Data Absensi
                @if(request('kelas_id'))
                    Kelas {{ $allKelas->firstWhere('id', request('kelas_id'))->nama ?? '' }}
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
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensis as $absensi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $absensi->student->name ?? 'N/A' }}</td>
                            <td>{{ $absensi->student->kelas->nama ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $absensi->status }}</td>
                            <td>{{ $absensi->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data absensi.</td>
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
