<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Buku</h1>

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="book_code" class="form-label">Kode Buku</label>
                <input type="text" class="form-control" id="book_code" name="book_code" value="{{ $book->book_code }}" required>
            </div>
            <div class="mb-3">
                <label for="book_title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="book_title" name="book_title" value="{{ $book->book_title }}" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
            </div>
            <div class="mb-3">
                <label for="publisher" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ $book->year }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="borrowed" {{ $book->status == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
