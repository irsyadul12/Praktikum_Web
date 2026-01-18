@extends('layouts.master')

@section('title', 'Detail Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Siswa</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $student->name }}</h6>
                </div>
                <div class="card-body text-center">
                    @if ($student->photo)
                        <img src="{{ asset('storage/students/' . $student->photo) }}" alt="foto" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('img/undraw_profile.svg') }}" alt="foto" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                    <h5 class="card-title">{{ $student->name }}</h5>
                    <p class="card-text text-muted">{{ $student->nis }}</p>
                    <ul class="list-group list-group-flush text-left">
                        <li class="list-group-item">
                            <strong>Kelas:</strong> {{ $student->kelas->nama ?? '-' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $student->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Telepon:</strong> {{ $student->phone ?? '-' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Alamat:</strong> {{ $student->address ?? '-' }}
                        </li>
                    </ul>
                     <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-icon-split mt-3">
                        <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                        <span class="text">Edit Profil</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">Daftar Pelanggaran</h6>
                    <a href="{{ route('pelanggarans.create', ['student_id' => $student->id]) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($student->pelanggarans as $pelanggaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pelanggaran->jenis }}</td>
                                        <td><span class="badge badge-danger">{{ $pelanggaran->poin }}</span></td>
                                        <td>{{ $pelanggaran->tanggal->format('d-m-Y') }}</td>
                                        <td>{{ $pelanggaran->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('pelanggarans.edit', $pelanggaran->id) }}" class="btn btn-warning btn-sm icon-only"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data pelanggaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-success">Daftar Prestasi</h6>
                     <a href="{{ route('prestasi.create', ['student_id' => $student->id]) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($student->prestasis as $prestasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $prestasi->jenis_prestasi }}</td>
                                        <td><span class="badge badge-success">{{ $prestasi->poin }}</span></td>
                                        <td>{{ $prestasi->tanggal->format('d-m-Y') }}</td>
                                        <td>{{ $prestasi->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('prestasi.edit', $prestasi->id) }}" class="btn btn-warning btn-sm icon-only"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data prestasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @push('styles')
        <style>
            .icon-only {
                width: 32px;
                height: 32px;
                padding: 0;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    @endpush
@endsection
