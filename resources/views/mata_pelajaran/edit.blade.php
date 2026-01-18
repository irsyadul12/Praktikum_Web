@extends('layouts.master')

@section('title', 'Edit Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Mata Pelajaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('mata-pelajaran.update', $mataPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" id="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" value="{{ old('nama_mapel', $mataPelajaran->nama_mapel) }}" required>
                    @error('nama_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="guru_id">Guru Pengampu</label>
                    <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                        <option value="">Pilih Guru</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id', $mataPelajaran->guru_id) == $guru->id ? 'selected' : '' }}>{{ $guru->name }}</option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
