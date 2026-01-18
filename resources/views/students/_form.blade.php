@csrf

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="name">Nama <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $student->name ?? '') }}" required placeholder="Nama lengkap">
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nis">NIS <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" name="nis" id="nis"
                        class="form-control @error('nis') is-invalid @enderror"
                        value="{{ old('nis', $student->nis ?? '') }}" required placeholder="NIS">
                </div>
                @error('nis')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="kelas">Kelas</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-school"></i></span>
                    </div>
                    <select name="kelas_id" id="kelas" class="form-control @error('kelas_id') is-invalid @enderror">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas ?? [] as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kelas_id', $student->kelas_id ?? '') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('kelas_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $student->email ?? '') }}" placeholder="contoh@domain.com">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <label>Foto</label>
        <div class="mb-2 text-center">
            @if (!empty($student->photo))
                <div class="photo-box mx-auto rounded position-relative">
                    <img id="photo-preview" src="{{ asset('storage/students/' . $student->photo) }}" alt="Foto siswa">
                    <button type="button" class="btn btn-sm btn-light position-absolute" id="change-photo-btn"
                        style="right:8px; bottom:8px;"><i class="fas fa-camera"></i></button>
                </div>
                <div id="selected-filename" class="text-truncate text-muted small mt-2">{{ basename($student->photo) }}
                </div>
            @else
                <div id="no-photo-label" class="text-muted small mt-2">Tidak ada foto</div>
                <div class="photo-box mx-auto rounded d-none">
                    <img id="photo-preview" src="" alt="Foto siswa">
                    <button type="button" class="btn btn-sm btn-light position-absolute d-none" id="change-photo-btn"
                        style="right:8px; bottom:8px;"><i class="fas fa-camera"></i></button>
                </div>
                <div id="selected-filename" class="text-truncate text-muted small mt-2"></div>
            @endif
        </div>

        <div class="form-group mt-1">
            <div class="custom-file d-none">
                <input type="file" name="photo" id="photo"
                    class="custom-file-input @error('photo') is-invalid @enderror" accept="image/*">
                <label class="custom-file-label" for="photo">Pilih foto</label>
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="button" class="btn btn-outline-secondary btn-block" id="choose-photo-btn">Pilih / Ubah
                Foto</button>
            <small class="form-text text-muted">Maks. 2MB. Format: JPG, PNG, GIF.</small>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .photo-box {
            max-width: 200px;
            width: 100%;
            /* scale down on small screens */
            aspect-ratio: 1 / 1;
            /* keep square */
            border-radius: 8px;
            overflow: hidden;
            min-width: 80px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        #change-photo-btn {
            opacity: 0.95;
            border-radius: 6px;
        }

        #change-photo-btn:hover {
            transform: translateY(-1px);
        }

        #selected-filename {
            max-width: 200px;
        }

        .input-group-text .fas {
            font-size: 0.9rem;
            width: 1.25em; /* Ensure consistent width */
            text-align: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function() {
            function updatePreview(input) {
                if (input.files && input.files[0]) {
                    var file = input.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo-preview').attr('src', e.target.result).show();
                        $('.photo-box').removeClass('d-none');
                        $('#no-photo-label').hide();
                        $('#change-photo-btn').removeClass('d-none');
                        $('#selected-filename').text(file.name);
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#photo-preview').hide();
                    $('.photo-box').addClass('d-none');
                    $('#no-photo-label').show();
                    $('#change-photo-btn').addClass('d-none');
                    $('#selected-filename').text('');
                }
            }

            // open file dialog when choose button clicked
            $('#choose-photo-btn, #change-photo-btn').on('click', function() {
                $('#photo').trigger('click');
            });

            $('#photo').on('change', function() {
                updatePreview(this);
            });

            // If browser preserved selected file on validation error, show filename
            var fileInput = $('#photo')[0];
            if (fileInput && fileInput.files && fileInput.files[0]) {
                $('#selected-filename').text(fileInput.files[0].name);
                updatePreview(fileInput);
            }
        });
    </script>
@endpush
