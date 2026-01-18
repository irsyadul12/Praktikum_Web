@extends('layouts.master')

@section('title', 'Daftar Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Siswa</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('students.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" name="q" class="form-control" placeholder="Cari berdasarkan Nama atau NIS" value="{{ request('q') }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <select name="kelas_id" class="form-control">
                                <option value="">Semua Kelas</option>
                                @foreach ($allKelas as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                        <td class="text-center">
                            @if ($student->photo)
                                <img src="{{ asset('storage/students/' . $student->photo) }}" alt="foto"
                                    class="img-thumbnail" style="max-height:60px">
                            @endif
                        </td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->kelas->nama ?? '-' }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm icon-only mr-1"
                                title="Lihat Detail" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm icon-only mr-1"
                                title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('students.destroy', $student) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('styles')
        <style>
            /* Compact icon-only buttons (rectangular with gentle rounded corners) */
            .icon-only {
                width: 32px;
                height: 32px;
                padding: 0;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 6px;
                /* gentler corners */
                font-size: .85rem;
            }

            .icon-only i {
                line-height: 1;
                font-size: .85rem;
            }

            .icon-only:hover {
                transform: translateY(-1px);
                opacity: 0.95;
            }

            /* Slightly smaller on very small screens */
            @media (max-width: 576px) {
                .icon-only {
                    width: 28px;
                    height: 28px;
                    font-size: .75rem;
                }

                .icon-only i {
                    font-size: .75rem;
                }
            }

            .table td img.img-thumbnail {
                max-height: 60px;
            }

            /* Make the filter inputs responsive on small screens */
            @media (max-width: 576px) {
                .input-group .form-control {
                    margin-bottom: .5rem;
                }
            }
        </style>
    @endpush

    <div class="mt-3">{{ $students->withQueryString()->links() }}</div>

    @push('scripts')
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush

@endsection
