@extends('layouts.master')

@section('title', 'Edit Sesi Pelajaran')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Sesi Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jam-pelajaran.update', $jamPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="sesi">Nama Sesi</label>
                    <input type="text" class="form-control" id="sesi" name="sesi" placeholder="Contoh: Sesi 1, Istirahat" value="{{ $jamPelajaran->sesi }}" required>
                </div>
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ \Carbon\Carbon::parse($jamPelajaran->waktu_mulai)->format('H:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="{{ \Carbon\Carbon::parse($jamPelajaran->waktu_selesai)->format('H:i') }}" required>
                </div>
                <a href="{{ route('jam-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
