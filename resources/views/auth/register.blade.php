@extends('layouts.auth')

@section('content')
    <div class="form-container register-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Register here.</h1>

            <!-- Name Field -->
            <input 
                type="text" 
                name="name" 
                placeholder="Full Name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
            />
            @error('name')
                <span class="text-danger" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror

            <!-- Email Field -->
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                value="{{ old('email') }}" 
                required 
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

            <!-- Password Confirmation Field -->
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Confirm Password" 
                required 
            />

            <!-- Role Field -->
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <span class="text-danger" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror

            <!-- Submit Button -->
            <button type="submit">Register</button>

            <!-- Social Links (Opsional) -->
            <div class="social-container">
                <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                <a href="#" class="social"><i class="lni lni-google"></i></a>
                <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
            </div>
        </form>
    </div>

    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form langsung submit
        const formData = new FormData(this);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        this.submit(); // Lanjutkan submit setelah log
    });
</script>

@endsection