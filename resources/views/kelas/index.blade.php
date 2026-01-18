@extends('layouts.master')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kelas</h1>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Kelas</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Kelas" value="{{ request('nama') }}">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm mx-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync-alt"></i> Reset
                        </a>
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
                    <th>Nama Kelas</th>
                    <th>Kapasitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kapasitas }}</td>
                        <td class="text-center">
                            <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-warning btn-sm icon-only mr-1"
                                title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('kelas.destroy', $item->id) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $kelas->withQueryString()->links() }}
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

@endsection
