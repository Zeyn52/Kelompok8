<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMAK - Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f5f7;
        }
        .navbar {
            background: linear-gradient(to right, #4bb6b7, #2e5e64);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }
        .navbar form {
            margin: 0;
        }
        .navbar button {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        .navbar button:hover {
            background-color: white;
            color: #2e5e64;
        }
        .container {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .text-success {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>SIMAK - Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="text-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>