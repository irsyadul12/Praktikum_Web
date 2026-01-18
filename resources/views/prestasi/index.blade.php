@extends('layouts.master')

@section('title', 'Prestasi Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Prestasi Siswa</h1>
        <a href="{{ route('prestasi.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Prestasi</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Prestasi Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('prestasi.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="q" class="form-control" placeholder="Cari Nama Prestasi" value="{{ request('q') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="student_id" class="form-control">
                                <option value="">Semua Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="tingkat" class="form-control">
                                <option value="">Semua Tingkat</option>
                                @foreach (['Nasional', 'Provinsi', 'Kota/Kabupaten', 'Sekolah'] as $tingkat)
                                    <option value="{{ $tingkat }}" {{ request('tingkat') == $tingkat ? 'selected' : '' }}>
                                        {{ $tingkat }}
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
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Nama Prestasi</th>
                    <th>Tingkat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prestasis as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($prestasis->currentPage() - 1) * $prestasis->perPage() }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->nama_prestasi }}</td>
                        <td>{{ $item->tingkat }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td class="text-center">
                            <a href="{{ route('prestasi.show', $item->id) }}" class="btn btn-info btn-sm icon-only mr-1"
                                title="Lihat Detail" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('prestasi.edit', $item->id) }}" class="btn btn-warning btn-sm icon-only mr-1"
                                title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('prestasi.destroy', $item->id) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus prestasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Prestasi belum Tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $prestasis->withQueryString()->links() }}</div>

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

            /* Make the filter inputs responsive on small screens */
            @media (max-width: 576px) {
                .input-group .form-control {
                    margin-bottom: .5rem;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush

@endsection
