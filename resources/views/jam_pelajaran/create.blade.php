@extends('layouts.master')

@section('title', 'Tambah Sesi Pelajaran')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Sesi Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jam-pelajaran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="sesi">Nama Sesi</label>
                    <input type="text" class="form-control" id="sesi" name="sesi" placeholder="Contoh: Sesi 1, Istirahat" required>
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') ? \Carbon\Carbon::parse(old('waktu_mulai'))->format('H:i') : '' }}" required>
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') ? \Carbon\Carbon::parse(old('waktu_selesai'))->format('H:i') : '' }}" required>
                </div>
                <a href="{{ route('jam-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
