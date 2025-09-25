<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Detail Transaksi #{{ $transaction->id }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Anggota</h5>
                        <p><strong>Nama     :</strong> {{ $transaction->user->name }}</p>
                        <p><strong>NIS      :</strong> {{ $transaction->user->nis }}</p>
                        <p><strong>Kelas    :</strong> {{ $transaction->user->class }}</p>
                        <p><strong>Jurusan  :</strong> {{ $transaction->user->major }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Buku</h5>
                        <p><strong>Judul Buku :</strong> {{ $transaction->book->book_title }}</p>
                        <p><strong>Pengarang  :</strong> {{ $transaction->book->author }}</p>
                        <p><strong>Penerbit   :</strong> {{ $transaction->book->publisher }}</p>
                        <p><strong>Tahun      :</strong> {{ $transaction->book->year }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Informasi Transaksi</h5>
                        <p><strong>Tanggal Pinjam   :</strong> {{ $transaction->borrow_date }}</p>
                        <p><strong>Tanggal Kembali  :</strong> {{ $transaction->return_date }}</p>
                        <p><strong>Status   :</strong>
                            <span class="badge {{ $transaction->status === 'completed' ? 'bg-success' : ($transaction->status === 'ongoing' ? 'bg-primary' : 'bg-warning') }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST" class="mb-3">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <label class="form-label">Update Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="ongoing" {{ $transaction->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
