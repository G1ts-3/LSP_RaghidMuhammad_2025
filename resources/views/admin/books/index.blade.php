<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Kelola Data Buku</h1>
        <div class="mb-3">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Tambah Buku</a>
            <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Kembali</a>
        </div>

        <!-- Tampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book as $index => $v)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $v->book_code }}</td>
                        <td>{{ $v->book_title }}</td>
                        <td>{{ $v->author }}</td>
                        <td>{{ $v->publisher }}</td>
                        <td>{{ $v->year }}</td>
                        <td>{{ ucfirst($v->status) }}</td>
                        <td>
                            <a href="{{ route('admin.books.edit', $v->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.books.destroy', $v->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Buku ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
