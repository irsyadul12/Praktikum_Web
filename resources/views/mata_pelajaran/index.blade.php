@extends('layouts.master')

@section('title', 'Manajemen Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Mata Pelajaran</h1>
        <a href="{{ route('mata-pelajaran.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Mata Pelajaran
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mata-pelajaran.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="{{ request('nama_mapel') }}">
                        </div>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm mx-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync-alt"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mataPelajarans as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_mapel }}</td>
                                <td>
                                    <a href="{{ route('mata-pelajaran.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('mata-pelajaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $mataPelajarans->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
