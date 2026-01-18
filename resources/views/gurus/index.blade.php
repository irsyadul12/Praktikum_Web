@extends('layouts.master')

@section('title', 'Daftar Guru')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Guru</h1>
        <a href="{{ route('gurus.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Guru</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Guru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('gurus.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" name="q" placeholder="Cari nama atau NUPTK" value="{{ request('q') }}">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm mx-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('gurus.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync-alt"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>NUPTK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gurus as $guru)
                    <tr>
                        <td>{{ $loop->iteration + ($gurus->currentPage() - 1) * $gurus->perPage() }}</td>
                        <td class="text-center">
                            @if ($guru->photo)
                                <img src="{{ asset('storage/gurus/' . $guru->photo) }}" alt="foto"
                                    class="img-thumbnail" style="max-height:60px">
                            @else
                                <img src="{{ asset('img/undraw_profile.svg') }}" alt="foto"
                                    class="img-thumbnail" style="max-height:60px">
                            @endif
                        </td>
                        <td>{{ $guru->nuptk }}</td>
                        <td>{{ $guru->name }}</td>
                        <td>{{ $guru->email }}</td>
                        <td>{{ $guru->phone }}</td>
                        <td class="text-center">
                            <a href="{{ route('gurus.show', $guru->id) }}" class="btn btn-info btn-sm icon-only mr-1" title="Lihat" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('gurus.edit', $guru->id) }}" class="btn btn-warning btn-sm icon-only mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('gurus.destroy', $guru->id) }}" method="post"
                                style="display:inline-block" onsubmit="return confirm('Hapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm icon-only" title="Hapus" data-toggle="tooltip"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Guru belum Tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $gurus->withQueryString()->links() }}
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

            .icon-only i {
                line-height: 1;
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