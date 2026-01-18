@extends('layouts.master')

@section('title', 'Absensi Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Absensi Siswa</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pilih Kelas dan Tanggal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control">
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $kelasId ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($students->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa Kelas {{ $students->first()->kelas->nama ?? '' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 30%;">Nama Siswa</th>
                                    <th style="width: 40%;">Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            @php
                                                $absen = $absensi->get($student->id);
                                            @endphp
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-success {{ ($absen->status ?? '') == 'hadir' ? 'active' : '' }}">
                                                    <input type="radio" name="absensi[{{ $student->id }}][status]" value="hadir" {{ ($absen->status ?? '') == 'hadir' ? 'checked' : '' }}> Hadir
                                                </label>
                                                <label class="btn btn-outline-warning {{ ($absen->status ?? '') == 'sakit' ? 'active' : '' }}">
                                                    <input type="radio" name="absensi[{{ $student->id }}][status]" value="sakit" {{ ($absen->status ?? '') == 'sakit' ? 'checked' : '' }}> Sakit
                                                </label>
                                                <label class="btn btn-outline-info {{ ($absen->status ?? '') == 'izin' ? 'active' : '' }}">
                                                    <input type="radio" name="absensi[{{ $student->id }}][status]" value="izin" {{ ($absen->status ?? '') == 'izin' ? 'checked' : '' }}> Izin
                                                </label>
                                                <label class="btn btn-outline-danger {{ ($absen->status ?? 'alpa') == 'alpa' ? 'active' : '' }}">
                                                    <input type="radio" name="absensi[{{ $student->id }}][status]" value="alpa" {{ ($absen->status ?? 'alpa') == 'alpa' ? 'checked' : '' }}> Alpa
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="absensi[{{ $student->id }}][keterangan]" class="form-control" placeholder="Keterangan..." value="{{ $absen->keterangan ?? '' }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Absensi</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            Tidak ada siswa di kelas ini atau kelas belum dipilih.
        </div>
    @endif

@endsection

@push('styles')
<style>
    .btn-group-toggle .btn {
        margin: 0 2px;
        border-radius: .25rem !important;
    }
</style>
@endpush
