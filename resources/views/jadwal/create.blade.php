@extends('layouts.master')

@section('title', 'Tambah Jadwal Pelajaran')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jadwal Pelajaran</h1>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control" required>
                        <option value="">Pilih Hari</option>
                        @foreach ($hari as $day)
                            <option value="{{ $day }}" {{ old('hari') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jam_pelajaran_id">Jam Pelajaran</label>
                    <select name="jam_pelajaran_id" id="jam_pelajaran_id" class="form-control" required>
                        <option value="">Pilih Jam Pelajaran</option>
                        @foreach ($jamPelajaran as $jam)
                            <option value="{{ $jam->id }}" {{ old('jam_pelajaran_id') == $jam->id ? 'selected' : '' }}>
                                {{ $jam->waktu_mulai }} - {{ $jam->waktu_selesai }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="kelas_id" class="mb-0">Kelas</label>
                        <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fas fa-tasks fa-fw mr-1"></i>Kelola Kelas
                        </a>
                    </div>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="mata_pelajaran_id">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach ($mataPelajaran as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="guru_id">Guru</label>
                    <select name="guru_id" id="guru_id" class="form-control" required>
                        <option value="">Pilih Guru</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
