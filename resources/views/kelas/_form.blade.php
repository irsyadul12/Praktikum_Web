@csrf
<div class="form-group">
    <label for="nama">Nama Kelas</label>
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $kelas->nama ?? '') }}" required>
    @error('nama')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="kapasitas">Kapasitas</label>
    <input type="number" name="kapasitas" id="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror"
        value="{{ old('kapasitas', $kelas->kapasitas ?? '') }}" required>
    @error('kapasitas')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="guru_id">Guru Pengampu</label>
    <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
        <option value="">Pilih Guru</option>
        @foreach ($gurus as $guru)
            <option value="{{ $guru->id }}" {{ old('guru_id', $kelas->guru_id ?? '') == $guru->id ? 'selected' : '' }}>
                {{ $guru->name }}
            </option>
        @endforeach
    </select>
    @error('guru_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
