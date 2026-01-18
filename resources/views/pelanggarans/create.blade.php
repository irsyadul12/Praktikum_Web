@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Pelanggaran Siswa Baru</h1>
    <p class="mb-4">Formulir ini digunakan untuk menambahkan data pelanggaran siswa baru.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pelanggaran Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pelanggarans.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="student_id">Siswa:</label>
                    <select class="form-control" id="student_id" name="student_id" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} (NIS: {{ $student->nis }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis:</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="pelanggaran">Pelanggaran</option>
                        <option value="prestasi">Prestasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="akademik">Akademik</option>
                        <option value="non-akademik">Non-Akademik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="poin">Poin:</label>
                    <input type="number" class="form-control" id="poin" name="poin" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="sanksi">Sanksi:</label>
                    <textarea class="form-control" id="sanksi" name="sanksi" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pelanggarans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
