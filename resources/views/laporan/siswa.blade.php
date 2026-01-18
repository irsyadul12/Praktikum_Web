@extends('layouts.master')

@section('title', 'Laporan Siswa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Siswa</h1>

    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <form action="{{ route('laporan.siswa') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" name="q" class="form-control bg-light border-0 small" placeholder="Cari siswa..."
                    aria-label="Search" aria-describedby="basic-addon2" value="{{ request('q') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <div class="form-group ml-3">
                <select name="kelas_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Semua Kelas</option>
                    @foreach($allKelas as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($student->photo)
                                    <img src="{{ asset('storage/students/' . $student->photo) }}" alt="foto"
                                        class="img-thumbnail" style="max-height:60px">
                                @endif
                            </td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->kelas->nama ?? '-' }}</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data siswa.</td>
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
        .table td img.img-thumbnail {
            max-height: 60px;
        }
    }
</style>
@endpush
