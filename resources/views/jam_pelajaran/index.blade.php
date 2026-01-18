@extends('layouts.master')

@section('title', 'Pengaturan Jam Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan Jam Pelajaran</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pengaturan Jam Masuk dan Keluar Umum -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jam Umum Sekolah</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="07:00">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jam_pulang">Jam Pulang</label>
                            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" value="15:00">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Jam Umum</button>
            </form>
        </div>
    </div>

    <!-- Data Sesi Pelajaran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Sesi Pelajaran</h6>
            <a href="{{ route('jam-pelajaran.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Sesi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sesi</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jamPelajarans as $sesi)
                            <tr>
                                <td>{{ $sesi->sesi }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesi->waktu_mulai)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesi->waktu_selesai)->format('H:i') }}</td>
                                <td>
                                    <a href="{{ route('jam-pelajaran.edit', $sesi->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('jam-pelajaran.destroy', $sesi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus sesi ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada sesi pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
