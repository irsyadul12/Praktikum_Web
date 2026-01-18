@extends('layouts.master')

@section('title', 'Edit Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Siswa</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('students._form', ['student' => $student, 'kelas' => $kelas])
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
