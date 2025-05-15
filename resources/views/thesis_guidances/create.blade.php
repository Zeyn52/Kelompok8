<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bimbingan Skripsi - SIMAK</title>
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

        .form-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 30px;
        }

        .form-section h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        .form-section .form-group {
            margin-bottom: 15px;
        }

        .form-section label {
            font-size: 14px;
            font-weight: 500;
            color: #333333;
            display: block;
            margin-bottom: 5px;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
            color: #333333;
            transition: all 0.3s ease;
        }

        .form-section input:focus,
        .form-section select:focus,
        .form-section textarea:focus {
            border-color: #2d6a4f;
            outline: none;
            box-shadow: 0 0 5px rgba(45, 106, 79, 0.2);
        }

        .form-section button {
            background: #2d6a4f;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-section button:hover {
            background: #40916c;
        }

        .table-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 30px;
        }

        .table-section h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        .table-section .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-section .table th,
        .table-section .table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            color: #333333;
        }

        .table-section .table th {
            background: #f9fafb;
            font-weight: 600;
            color: #2d6a4f;
        }

        .table-section .table td {
            border-top: 1px solid #e5e7eb;
        }

        .table-section .table tbody tr:hover {
            background: #f1faee;
            cursor: pointer;
        }

        .text-danger {
            color: #d00000;
            font-size: 12px;
        }

        .text-success {
            color: #2d6a4f;
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

            .form-section,
            .table-section {
                margin: 15px;
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
            <h1>Bimbingan Skripsi</h1>
            <div class="user-info">
                <span class="user-name">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <!-- Form Pengajuan Bimbingan Skripsi -->
        <div class="form-section">
            <h2>Form Pengajuan Bimbingan Skripsi</h2>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('thesis_guidances.store') }}">
                @csrf
                <div class="form-group">
                    <label for="student_identifier">NIM</label>
                    <input type="text" name="student_identifier" id="student_identifier" value="{{ Auth::user()->identifier }}" readonly>
                    @error('student_identifier')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="supervisor_identifier">Nama Dosen Pembimbing</label>
                    <select name="supervisor_identifier" id="supervisor_identifier" required>
                        <option value="" disabled selected>Pilih Dosen Pembimbing</option>
                        @foreach ($supervisors as $supervisor)
                            <option value="{{ $supervisor->identifier }}">{{ $supervisor->name }} ({{ $supervisor->identifier }})</option>
                        @endforeach
                    </select>
                    @error('supervisor_identifier')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="topic">Topik Bimbingan (Opsional)</label>
                    <input type="text" name="topic" id="topic" value="{{ old('topic') }}">
                    @error('topic')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">Catatan Bimbingan (Opsional)</label>
                    <textarea name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="guidance_date">Tanggal Bimbingan</label>
                    <input type="date" name="guidance_date" id="guidance_date" value="{{ old('guidance_date', now()->format('Y-m-d')) }}" required>
                    @error('guidance_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">Ajukan Bimbingan</button>
            </form>
        </div>

        <!-- Tabel Riwayat Bimbingan Skripsi -->
        <div class="table-section">
            <h2>Riwayat Bimbingan Skripsi</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Dosen</th>
                        <th>Topik</th>
                        <th>Catatan</th>
                        <th>Tanggal Bimbingan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guidances as $guidance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guidance->student_identifier }}</td>
                            <td>{{ $guidance->supervisor->name ?? 'Tidak tersedia' }}</td>
                            <td>{{ $guidance->topic ?? 'Tidak tersedia' }}</td>
                            <td>{{ $guidance->notes ?? 'Tidak ada catatan' }}</td>
                            <td>{{ \Carbon\Carbon::parse($guidance->guidance_date)->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Belum ada riwayat bimbingan skripsi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>