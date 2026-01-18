@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Pelanggaran Siswa</h1>
    <p class="mb-4">Formulir ini digunakan untuk mengubah data pelanggaran siswa.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pelanggaran Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pelanggaransiswa.update', $pelanggaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="student_id">Siswa:</label>
                    <select class="form-control" id="student_id" name="student_id" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ $pelanggaran->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} (NIS: {{ $student->nis }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis:</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="pelanggaran" {{ $pelanggaran->jenis == 'pelanggaran' ? 'selected' : '' }}>Pelanggaran</option>
                        <option value="prestasi" {{ $pelanggaran->jenis == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="akademik" {{ $pelanggaran->kategori == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="non-akademik" {{ $pelanggaran->kategori == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="poin">Poin:</label>
                    <input type="number" class="form-control" id="poin" name="poin" value="{{ $pelanggaran->poin }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pelanggaran->tanggal ? $pelanggaran->tanggal->format('Y-m-d') : '' }}">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $pelanggaran->keterangan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sanksi">Sanksi:</label>
                    <textarea class="form-control" id="sanksi" name="sanksi" rows="3">{{ $pelanggaran->sanksi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pelanggarans.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
