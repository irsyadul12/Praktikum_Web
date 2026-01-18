@extends('layouts.master')

@section('title', 'Jadwal Pelajaran')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Pelajaran</h1>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Jadwal</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Jadwal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jadwal.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select name="hari" class="form-control">
                                <option value="">Semua Hari</option>
                                @foreach ($hari as $day)
                                    <option value="{{ $day }}" {{ request('hari') == $day ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <select name="kelas_id" class="form-control">
                                <option value="">Semua Kelas</option>
                                @foreach ($allKelas as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration + ($jadwals->currentPage() - 1) * $jadwals->perPage() }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jamPelajaran->waktu_mulai ?? '' }} - {{ $jadwal->jamPelajaran->waktu_selesai ?? '' }}</td>
                        <td>{{ $jadwal->mataPelajaran->nama_mapel ?? '' }}</td>
                        <td>{{ $jadwal->guru->name ?? '' }}</td>
                        <td>{{ $jadwal->kelas->nama ?? '' }}</td>
                        <td class="text-center">
                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm icon-only mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data jadwal pelajaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $jadwals->withQueryString()->links() }}
    </div>

    @push('styles')
        <style>
            .icon-only {
                width: 32px;
                height: 32px;
                padding: 0;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 6px;
                font-size: .85rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush

@endsection