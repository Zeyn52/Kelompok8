<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - SIMAK</title>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #2d6a4f, #74c69d);
            padding: 20px;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .form-container h1 {
            font-size: 24px;
            font-weight: 600;
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
            color: #333333;
            transition: all 0.3s ease;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #2d6a4f;
            outline: none;
            box-shadow: 0 0 5px rgba(45, 106, 79, 0.2);
        }

        .form-container select {
            appearance: none;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") no-repeat right 10px center;
            background-size: 16px;
        }

        .form-container button {
            background: #2d6a4f;
            color: #ffffff;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .form-container button:hover {
            background: #40916c;
        }

        .form-container .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: #666666;
        }

        .form-container .register-link a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: 500;
        }

        .form-container .register-link a:hover {
            color: #40916c;
            text-decoration: underline;
        }

        .text-danger {
            color: #d00000;
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }

        .text-success {
            color: #2d6a4f;
            font-size: 12px;
            display: block;
            margin-bottom: 10px;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
                max-width: 100%;
            }

            .form-container h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Register</h1>

        @if (session('success'))
            <span class="text-success">{{ session('success') }}</span>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <span class="text-danger">{{ $error }}</span>
            @endforeach
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" id="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" name="password" id="password" placeholder="Password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <select name="role" id="role" required onchange="toggleNimField()">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div id="nim-field" style="display: none;">
                <input type="text" name="nim" id="nim" placeholder="NIM" value="{{ old('nim') }}">
                @error('nim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="register-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

    <script>
        function toggleNimField() {
            const role = document.getElementById('role').value;
            const nimField = document.getElementById('nim-field');
            if (role === 'mahasiswa') {
                nimField.style.display = 'block';
                document.getElementById('nim').setAttribute('required', 'required');
            } else {
                nimField.style.display = 'none';
                document.getElementById('nim').removeAttribute('required');
            }
        }

        // Set initial state based on old input
        document.addEventListener('DOMContentLoaded', function() {
            toggleNimField();
        });
    </script>
</body>
</html>