<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - SIMAK</title>
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

        .header .user-info form {
            display: inline;
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

        .dashboard-content {
            padding: 30px;
        }

        .dashboard-content .welcome-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .dashboard-content .welcome-section h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2d6a4f;
            margin-bottom: 10px;
        }

        .dashboard-content .welcome-section p {
            font-size: 14px;
            color: #666666;
        }

        .dashboard-content .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .dashboard-content .info-cards .card {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .dashboard-content .info-cards .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .dashboard-content .info-cards .card h3 {
            font-size: 15px;
            font-weight: 500;
            color: #2d6a4f;
            margin-bottom: 8px;
        }

        .dashboard-content .info-cards .card p {
            font-size: 14px;
            color: #666666;
        }

        .letter-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .letter-section .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .letter-section .card-header h5 {
            font-size: 16px;
            font-weight: 600;
            color: #2d6a4f;
            margin: 0;
        }

        .letter-section .card-header select {
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            color: #333333;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .letter-section .card-header select:hover {
            border-color: #2d6a4f;
        }

        .letter-section .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .letter-section .table th,
        .letter-section .table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            color: #333333;
        }

        .letter-section .table th {
            background: #f9fafb;
            font-weight: 600;
            color: #2d6a4f;
            cursor: pointer;
        }

        .letter-section .table th i {
            margin-left: 5px;
            font-size: 12px;
        }

        .letter-section .table th.sorted-asc i::after,
        .letter-section .table th.sorted-desc i::after {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .letter-section .table th.sorted-asc i::after {
            content: '\f0de';
        }

        .letter-section .table th.sorted-desc i::after {
            content: '\f0dd';
        }

        .letter-section .table td {
            border-top: 1px solid #e5e7eb;
        }

        .letter-section .table tbody tr {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .letter-section .table tbody tr.show {
            opacity: 1;
            transform: translateY(0);
        }

        .letter-section .table tbody tr:hover {
            background: #f1faee;
            cursor: pointer;
        }

        .letter-section .table .btn-view {
            color: #2d6a4f;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        .letter-section .table .btn-view:hover {
            color: #40916c;
            text-decoration: underline;
        }

        .letter-section .table .status-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 5px;
        }

        .letter-section .table .status-selesai {
            background: #2d6a4f;
        }

        .letter-section .table .status-proses {
            background: #f59e0b;
        }

        .letter-section .table .status-ditolak {
            background: #d00000;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 20px;
            background: #f9fafb;
        }

        .modal-header h5 {
            font-size: 16px;
            font-weight: 600;
            color: #2d6a4f;
        }

        .modal-body p {
            font-size: 14px;
            color: #333333;
            margin-bottom: 10px;
        }

        .modal-body p strong {
            color: #2d6a4f;
        }

        .modal-body a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: 500;
        }

        .modal-body a:hover {
            color: #40916c;
            text-decoration: underline;
        }

        .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding: 10px 20px;
        }

        .modal-footer .btn-secondary {
            background: #2d6a4f;
            border: none;
            border-radius: 20px;
            font-size: 13px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .modal-footer .btn-secondary:hover {
            background: #40916c;
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

            .dashboard-content {
                padding: 15px;
            }

            .letter-section .table {
                font-size: 12px;
            }

            .letter-section .table th,
            .letter-section .table td {
                padding: 8px;
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
                    <a href="#">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Nilai Akademik</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'dosen')
                <li>
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Mengajar</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <span>Daftar Mahasiswa</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'admin')
                <li>
                    <a href="#">
                        <i class="fas fa-users-cog"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-info">
                <span class="user-name">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="welcome-section">
                @if (Auth::user()->role == 'mahasiswa')
                    <h2>Selamat Datang, Mahasiswa!</h2>
                    <p>Ini adalah dashboard Anda. Gunakan menu di sisi kiri untuk mengakses pengajuan surat atau nilai akademik Anda.</p>
                @elseif (Auth::user()->role == 'dosen')
                    <h2>Selamat Datang, Dosen!</h2>
                    <p>Ini adalah dashboard Anda. Gunakan menu di sisi kiri untuk melihat jadwal mengajar atau daftar mahasiswa.</p>
                @elseif (Auth::user()->role == 'admin')
                    <h2>Selamat Datang, Admin!</h2>
                    <p>Ini adalah dashboard Anda. Gunakan menu di sisi kiri untuk mengelola pengguna atau pengaturan sistem.</p>
                @else
                    <h2>Selamat Datang!</h2>
                    <p>Role tidak dikenali. Silakan hubungi admin.</p>
                @endif
            </div>

            <div class="info-cards">
                <div class="card">
                    <h3>Nama</h3>
                    <p>{{ Auth::user()->name ?? 'Tidak tersedia' }}</p>
                </div>
                <div class="card">
                    <h3>Email</h3>
                    <p>{{ Auth::user()->email ?? 'Tidak tersedia' }}</p>
                </div>
                <div class="card">
                    <h3>Role</h3>
                    <p>{{ ucfirst(Auth::user()->role ?? 'Tidak tersedia') }}</p>
                </div>
            </div>

            <div class="letter-section">
                <div class="card-header">
                    <h5>Dashboard > Keterangan Surat</h5>
                    <select id="filterDate">
                        <option value="this-week">This week</option>
                        <option value="this-month">This month</option>
                        <option value="all">All time</option>
                    </select>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">No <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(1)">No Surat <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(2)">NIM <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(3)">Jenis Surat <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(4)">Tanggal Pengajuan <i class="fas fa-sort"></i></th>
                                <th onclick="sortTable(5)">Tanggal Selesai <i class="fas fa-sort"></i></th>
                                <th>File Surat</th>
                                <th onclick="sortTable(7)">Status <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody id="letterTable">
                            @forelse ($letters ?? [] as $letter)
                                <tr data-id="{{ $letter->id }}" onclick="showLetterDetails({{ $letter->id }})">
                                    <td>{{ $letter->id }}</td>
                                    <td>{{ $letter->letter_number ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $letter->nim ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $letter->letter_type ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $letter->submission_date ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $letter->completion_date ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn-view" onclick="event.stopPropagation(); showLetterDetails({{ $letter->id }})">
                                            Lihat
                                        </a>
                                    </td>
                                    <td>
                                        {{ $letter->status ?? 'Tidak tersedia' }}
                                        <span class="status-dot {{ $letter->status == 'Selesai' ? 'status-selesai' : ($letter->status == 'Proses' ? 'status-proses' : 'status-ditolak') }}"></span>
                                        @if (Auth::user()->role == 'dosen')
                                            <form class="status-form" method="POST" action="{{ route('letters.updateStatus', $letter->id) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="Proses" {{ $letter->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="Ditolak" {{ $letter->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </form>
                                        @elseif (Auth::user()->role == 'admin')
                                            <form class="status-form" method="POST" action="{{ route('letters.updateStatus', $letter->id) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="Selesai" {{ $letter->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak ada surat yang diajukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="letterModal" tabindex="-1" aria-labelledby="letterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="letterModalLabel">Detail Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($letter))
                        <p><strong>No Surat:</strong> {{ $letter->letter_number ?? 'Tidak tersedia' }}</p>
                        <p><strong>NIM:</strong> {{ $letter->nim ?? 'Tidak tersedia' }}</p>
                        <p><strong>Jenis Surat:</strong> {{ $letter->letter_type ?? 'Tidak tersedia' }}</p>
                        <p><strong>Tanggal Pengajuan:</strong> {{ $letter->submission_date ?? 'Tidak tersedia' }}</p>
                        <p><strong>Tanggal Selesai:</strong> {{ $letter->completion_date ?? '-' }}</p>
                        <p><strong>Status:</strong> {{ $letter->status ?? 'Tidak tersedia' }}</p>
                        <p><strong>Keterangan Tambahan:</strong> {{ $letter->description ?? 'Tidak ada keterangan tambahan' }}</p>
                        <p><strong>File Surat:</strong>
                            @if ($letter->file_path)
                                <a href="{{ asset('storage/' . $letter->file_path) }}" target="_blank">Download File</a>
                            @else
                                Tidak ada file
                            @endif
                        </p>
                    @else
                        <p>Tidak ada detail surat untuk ditampilkan.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('#letterTable tr');
            rows.forEach((row, index) => {
                gsap.to(row, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    delay: index * 0.1,
                    onComplete: () => row.classList.add('show')
                });
            });

            // Tampilkan modal jika ada detail surat
            @if (isset($letter))
                const modal = new bootstrap.Modal(document.getElementById('letterModal'));
                modal.show();
            @endif
        });

        document.getElementById('filterDate').addEventListener('change', function(e) {
            const filter = e.target.value;
            const rows = document.querySelectorAll('#letterTable tr');
            rows.forEach(row => {
                gsap.to(row, { opacity: 1, y: 0, duration: 0.3 });
                row.style.display = '';
            });
        });

        let sortDirection = {};

        function sortTable(columnIndex) {
            const tbody = document.getElementById('letterTable');
            if (!tbody) {
                console.warn('tbody element with ID "letterTable" not found');
                return;
            }

            const rows = Array.from(tbody.rows);
            const isAscending = sortDirection[columnIndex] !== 'asc';
            sortDirection[columnIndex] = isAscending ? 'asc' : 'desc';

            document.querySelectorAll('.table th').forEach(th => {
                th.classList.remove('sorted-asc', 'sorted-desc');
            });

            const table = tbody.closest('table');
            const header = table.querySelector(`thead th:nth-child(${columnIndex + 1})`);
            if (header) {
                header.classList.add(isAscending ? 'sorted-asc' : 'sorted-desc');
            }

            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                if (columnIndex === 0) {
                    aValue = parseInt(aValue) || 0;
                    bValue = parseInt(bValue) || 0;
                    return isAscending ? aValue - bValue : bValue - aValue;
                } else if (columnIndex === 4 || columnIndex === 5) {
                    aValue = aValue === '-' ? 0 : new Date(aValue).getTime() || 0;
                    bValue = bValue === '-' ? 0 : new Date(bValue).getTime() || 0;
                    return isAscending ? aValue - bValue : bValue - aValue;
                } else {
                    return isAscending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            rows.forEach((row, index) => {
                tbody.appendChild(row);
                gsap.from(row, { opacity: 0, y: 20, duration: 0.3, delay: index * 0.05 });
            });
        }

        function showLetterDetails(letterId) {
            window.location.href = '/dashboard/' + letterId;
        }

        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const letterId = button.closest('tr').getAttribute('data-id');
                showLetterDetails(letterId);
            });
        });
    </script>