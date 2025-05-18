<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Pengguna - SIMAK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Arial', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            background: #2d6a4f;
            color: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .logo h2 {
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .sidebar .nav-links {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar .nav-links li {
            margin-bottom: 5px;
        }

        .sidebar .nav-links li a {
            color: #e0e0e0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-links li a:hover {
            background: #40916c;
            color: #ffffff;
        }

        .sidebar .nav-links li a.active {
            background: #40916c;
            color: #ffffff;
        }

        .sidebar .nav-links li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #2d6a4f;
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header .user-info .user-name {
            font-size: 15px;
            font-weight: 500;
            color: #333333;
        }

        .header .user-info button {
            background: #2d6a4f;
            color: #ffffff;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .header .user-info button:hover {
            background: #40916c;
        }

        .content-section {
            padding: 30px;
        }

        .content-section .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .content-section .card h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        .content-section .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .content-section .card-header h5 {
            font-size: 16px;
            font-weight: 600;
            color: #2d6a4f;
            margin: 0;
        }

        .content-section .card-header select {
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            color: #333333;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .content-section .card-header select:hover {
            border-color: #2d6a4f;
        }

        .content-section .table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-section .table th,
        .content-section .table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            color: #333333;
        }

        .content-section .table th {
            background: #f9fafb;
            font-weight: 600;
            color: #2d6a4f;
        }

        .content-section .table td {
            border-top: 1px solid #e5e7eb;
        }

        .content-section .table tbody tr:hover {
            background: #f1faee;
        }

        .btn-danger {
            background: #dc3545;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm i {
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .header h1 {
                font-size: 20px;
            }

            .content-section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h2>SIMAK</h2>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role == 'mahasiswa')
                <li>
                    <a href="{{ route('letters.create') }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Pengajuan Surat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('thesis_guidances.create') }}">
                        <i class="fas fa-book"></i>
                        <span>Bimbingan Skripsi</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'dosen')
                <li>
                    <a href="{{ route('thesis_guidances.supervisor') }}">
                        <i class="fas fa-book"></i>
                        <span>Bimbingan Mahasiswa</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('admin.users') }}" class="active">
                        <i class="fas fa-users-cog"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Kelola Pengguna</h1>
            <div class="user-info">
                <span class="user-name">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="content-section">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Pengguna</h5>
                    <select id="roleFilter" onchange="filterByRole()">
                        <option value="all">Semua Role</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Identifier</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        @forelse ($users as $index => $user)
                            <tr data-role="{{ $user->role }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name ?? 'Tidak tersedia' }}</td>
                                <td>{{ $user->email ?? 'Tidak tersedia' }}</td>
                                <td>{{ ucfirst($user->role ?? 'Tidak tersedia') }}</td>
                                <td>{{ $user->identifier ?? 'Tidak tersedia' }}</td>
                                <td>{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->setTimezone('Asia/Jakarta')->format('H:i A d M Y') : 'Belum login' }}</td>
                                <td>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada pengguna yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterByRole() {
            const filterValue = document.getElementById('roleFilter').value;
            const rows = document.querySelectorAll('#userTable tr');

            rows.forEach(row => {
                const role = row.getAttribute('data-role');
                if (filterValue === 'all' || role === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            filterByRole();
        });
    </script>
</body>
</html>