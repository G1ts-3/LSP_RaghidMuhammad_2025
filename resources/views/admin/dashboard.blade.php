<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar .nav-link {
            font-size: 16px;
            color: #333;
        }
        .sidebar .nav-link.active {
            background-color: #5c5c5c;
            color: white;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
        .content-header {
            background-color: rgb(82, 80, 80);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .card {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .h2{
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h5 class="text-center mt-3 mb-4">Admin Dashboard</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/dashboard">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/books">
                                <i class="fas fa-book me-2"></i> Kelola Data Buku
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/transactions">
                                <i class="fas fa-exchange-alt me-2"></i> Transaksi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users">
                                <i class="fas fa-users me-2"></i> Kelola Anggota
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h1 class="h2">HI, {{ auth()->user()->name }}</h1>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>

                <div id="content">
                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">Buku Tersedia</h5>
                                        <p class="card-text fs-3">{{ $availableBooks }}</p>
                                    </div>
                                    <i class="fas fa-book fa-2x mt-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">Total Transaksi</h5>
                                        <p class="card-text fs-3">{{ $totalTransactions }}</p>
                                    </div>
                                    <i class="fas fa-exchange-alt fa-2x mt-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">Anggota Terdaftar</h5>
                                        <p class="card-text fs-3">{{ $registeredUsers }}</p>
                                    </div>
                                    <i class="fas fa-users fa-2x mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Selamat Datang</h5>
                            <p class="card-text">Selamat datang di halaman dashboard admin. Gunakan menu di sebelah kiri untuk mengelola sistem.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
