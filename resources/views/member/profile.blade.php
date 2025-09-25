{{-- <!-- resources/views/member/profile.blade.php -->

@extends('layouts.member')

@section('title', 'Profil Anggota')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>

                <div class="mt-5">
                    <div class="col-md-6">
                        <h3 style="display: flex; margin-left: 30px;" class=""><strong>Informasi Anggota</strong></h3>
                        <div class="mt-6">
                            <p style="display: flex; margin-left: 50px;"><strong>Username  :</strong> {{ $user->username }}</p>
                            <p style="display: flex; margin-left: 50px;"><strong>Nama     :</strong> {{ $user->name }}</p>
                            <p style="display: flex; margin-left: 50px;"><strong>NIS      :</strong> {{ $user->nis }}</p>
                            <p style="display: flex; margin-left: 50px;"><strong>Kelas    :</strong> {{ $user->class }}</p>
                            <p style="display: flex; margin-left: 50px;"><strong>Jurusan  :</strong> {{ $user->major }}</p>
                        </div>
                    </div>
                    <!-- Add more user details if necessary -->

                    <div class="right">
                        <a href="{{ route('member.dashboard') }}" class="mt-4 inline-flex items-center px-2 py-1 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg">
                            Kembali ke Dashboard
                        </a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Profile Anggota</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" disabled class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis', $user->nis) }}">
                @error('nis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" disabled class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" disabled class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Kelas</label>
                <input type="text" disabled class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ old('class', $user->class) }}">
                @error('class')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" disabled class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="{{ old('role', $user->role) }}">
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="major" class="form-label">Jurusan</label>
                <input type="text" disabled class="form-control @error('major') is-invalid @enderror" id="major" name="major" value="{{ old('major', $user->major) }}">
                @error('major')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengganti)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button> --}}
            <a href="{{ route('member.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

