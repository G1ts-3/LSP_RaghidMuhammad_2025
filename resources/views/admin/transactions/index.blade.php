<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Transaksi</h2>
            <a href="{{route('admin.dashboard')}}" class="btn btn-danger" style="margin-left: 790px;">Kembali</a>
            <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan informasi transaksi baru jika ada -->
        @if(session('newTransaction'))
            <div class="alert alert-info">
                Transaksi baru berhasil ditambahkan!
                <strong>ID Transaksi:</strong> {{ session('newTransaction')->id }}
                <strong>Buku:</strong> {{ session('newTransaction')->book->book_title }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->book->book_title }}</td>
                                <td>{{ $transaction->borrow_date }}</td>
                                <td>{{ $transaction->return_date }}</td>
                                <td>
                                    <span class="badge {{ $transaction->status === 'completed' ? 'bg-success' : ($transaction->status === 'ongoing' ? 'bg-primary' : 'bg-warning') }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-info btn-sm">Detail</a>
                                </td> --}}
                                <td>
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-info btn-sm">Detail</a>
                                    <!-- Form to delete transaction -->
                                    <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
