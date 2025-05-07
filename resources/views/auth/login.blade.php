@extends('layouts.auth')

  @section('content')
      <div class="form-container login-container">
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <h1>Login here.</h1>

              <!-- Tampilkan Pesan Error dari Session -->
              @if (session('error'))
                  <span class="text-danger" style="color: red; font-size: 12px;">{{ session('error') }}</span>
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
                  <span class="text-danger" style="color: red; font-size: 12px;">{{ $message }}</span>
              @enderror

              <!-- Password Field -->
              <input 
                  type="password" 
                  name="password" 
                  placeholder="Password" 
                  required 
              />
              @error('password')
                  <span class="text-danger" style="color: red; font-size: 12px;">{{ $message }}</span>
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

              <!-- Social Login Links (Opsional) -->
              <div class="social-container">
                  <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                  <a href="#" class="social"><i class="lni lni-google"></i></a>
                  <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
              </div>
          </form>
      </div>
  @endsection