@csrf
<div class="form-group">
    <label for="student_id">Siswa</label>
    <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
        <option value="">Pilih Siswa</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}" {{ old('student_id', $prestasi->student_id ?? '') == $student->id ? 'selected' : '' }}>
                {{ $student->name }}
            </option>
        @endforeach
    </select>
    @error('student_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="nama_prestasi">Nama Prestasi</label>
    <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control @error('nama_prestasi') is-invalid @enderror" value="{{ old('nama_prestasi', $prestasi->nama_prestasi ?? '') }}">
    @error('nama_prestasi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="tingkat">Tingkat</label>
    <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
        <option value="">Pilih Tingkat</option>
        @foreach (['Sekolah', 'Kecamatan', 'Provinsi', 'Nasional', 'Internasional'] as $tingkat)
            <option value="{{ $tingkat }}" {{ old('tingkat', $prestasi->tingkat ?? '') == $tingkat ? 'selected' : '' }}>
                {{ $tingkat }}
            </option>
        @endforeach
    </select>
    @error('tingkat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $prestasi->tanggal ?? '') }}">
    @error('tanggal')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $prestasi->keterangan ?? '') }}</textarea>
    @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

