@csrf
<div class="form-group">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $guru->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="nuptk">NUPTK</label>
    <input type="text" name="nuptk" id="nuptk" class="form-control @error('nuptk') is-invalid @enderror" value="{{ old('nuptk', $guru->nuptk ?? '') }}">
    @error('nuptk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $guru->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone">Telepon</label>
    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $guru->phone ?? '') }}">
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="address">Alamat</label>
    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $guru->address ?? '') }}</textarea>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="photo">Foto</label>
    <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submitButtonText ?? 'Simpan' }}</button>
<a href="{{ route('gurus.index') }}" class="btn btn-secondary">Batal</a>
