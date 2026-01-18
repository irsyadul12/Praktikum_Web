@extends('layouts.master')

@section('title', 'Daftar Pelanggaran')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pelanggaran</h1>
        <a href="{{ route('pelanggarans.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Pelanggaran</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Pelanggaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pelanggarans.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                             <select name="student_id" class="form-control">
                                <option value="">Semua Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->nis }})
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
                    <th>Nama Siswa</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Poin</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Sanksi</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggarans as $pelanggaran)
                    <tr>
                        <td>{{ $loop->iteration + ($pelanggarans->currentPage() - 1) * $pelanggarans->perPage() }}</td>
                        <td>{{ $pelanggaran->student->name ?? 'N/A' }}</td>
                        <td>{{ $pelanggaran->jenis }}</td>
                        <td>{{ $pelanggaran->kategori }}</td>
                        <td>{{ $pelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->tanggal ? \Carbon\Carbon::parse($pelanggaran->tanggal)->format('d-m-Y') : 'N/A' }}</td>
                        <td>{{ $pelanggaran->keterangan ?? 'N/A' }}</td>
                        <td>{{ $pelanggaran->sanksi ?? 'N/A' }}</td>
                        <td>{{ $pelanggaran->creator->name ?? 'N/A' }}</td>
                        <td class="text-center">
                            <a href="{{ route('pelanggarans.show', $pelanggaran->id) }}" class="btn btn-info btn-sm icon-only mr-1" title="Lihat" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('pelanggarans.edit', $pelanggaran->id) }}" class="btn btn-warning btn-sm icon-only mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('pelanggarans.destroy', $pelanggaran->id) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data pelanggaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pelanggarans->withQueryString()->links() }}
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
                border-radius: 6px;
                font-size: .85rem;
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
