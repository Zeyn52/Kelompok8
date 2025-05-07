@extends('layouts.auth')

@section('title', 'SIMAK - Login')

@section('content')
    <div class="form-container login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login here.</h1>

            <!-- Tampilkan Pesan Error dari Session -->
            @if (session('error'))
                <span class="text-danger">{{ session('error') }}</span>
            @endif
            @if (session('login_error'))
                <span class="text-danger">{{ session('login_error') }}</span>
            @endif

            <!-- Email Field -->
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
            />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Password Field -->
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
            />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Remember Me and Forgot Password -->
            <div class="content">
                <div class="checkbox">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        {{ old('remember') ? 'checked' : '' }} 
                    />
                    <label for="remember">Remember me</label>
                </div>
                <div class="pass-link">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit">Login</button>
        </form>
    </div>
@endsection