<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Double Slider Login / Registration Form</title>
      <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
      <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins");

          * {
              box-sizing: border-box;
          }

          body {
              display: flex;
              background-color: #f6f5f7;
              justify-content: center;
              align-items: center;
              flex-direction: column;
              font-family: "Poppins", sans-serif;
              overflow: hidden;
              height: 100vh;
              margin: 0;
          }

          h1 {
              font-weight: 700;
              letter-spacing: -1.5px;
              margin: 0;
              margin-bottom: 15px;
          }

          h1.title {
              font-size: 45px;
              line-height: 45px;
              margin: 0;
              text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
          }

          p {
              font-size: 14px;
              font-weight: 100;
              line-height: 20px;
              letter-spacing: 0.5px;
              margin: 20px 0 30px;
              text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
          }

          span {
              font-size: 14px;
              margin-top: 25px;
          }

          a {
              color: #333;
              font-size: 14px;
              text-decoration: none;
              margin: 15px 0;
              transition: 0.3s ease-in-out;
          }

          a:hover {
              color: #4bb6b7;
          }

          .content {
              display: flex;
              width: 100%;
              height: 50px;
              align-items: center;
              justify-content: space-around;
          }

          .content .checkbox {
              display: flex;
              align-items: center;
              justify-content: center;
          }

          .content input {
              accent-color: #333;
              width: 12px;
              height: 12px;
          }

          .content label {
              font-size: 14px;
              user-select: none;
              padding-left: 5px;
          }

          button {
              position: relative;
              border-radius: 20px;
              border: 1px solid #4bb6b7;
              background-color: #4bb6b7;
              color: #fff;
              font-size: 15px;
              font-weight: 700;
              margin: 10px;
              padding: 12px 80px;
              letter-spacing: 1px;
              text-transform: capitalize;
              transition: 0.3s ease-in-out;
          }

          button:hover {
              letter-spacing: 3px;
          }

          button:active {
              transform: scale(0.95);
          }

          button:focus {
              outline: none;
          }

          button.ghost {
              background-color: rgba(225, 225, 225, 0.2);
              border: 2px solid #fff;
              color: #fff;
          }

          button.ghost i {
              position: absolute;
              opacity: 0;
              transition: 0.3s ease-in-out;
          }

          button.ghost i.register {
              right: 70px;
          }

          button.ghost i.login {
              left: 70px;
          }

          button.ghost:hover i.register {
              right: 40px;
              opacity: 1;
          }

          button.ghost:hover i.login {
              left: 40px;
              opacity: 1;
          }

          form {
              background-color: #fff;
              display: flex;
              align-items: center;
              justify-content: center;
              flex-direction: column;
              padding: 0 50px;
              height: 100%;
              text-align: center;
          }

          input, select {
              background-color: #eee;
              border-radius: 10px;
              border: none;
              padding: 12px 15px;
              margin: 8px 0;
              width: 100%;
          }

          .container {
              background-color: #fff;
              border-radius: 25px;
              box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
              position: relative;
              overflow: hidden;
              width: 768px;
              max-width: 100%;
              min-height: 500px;
          }

          .form-container {
              position: absolute;
              top: 0;
              height: 100%;
              transition: all 0.6s ease-in-out;
          }

          .login-container {
              left: 0;
              width: 50%;
              z-index: 2;
              opacity: 1;
          }

          .container.right-panel-active .login-container {
              transform: translateX(100%);
              opacity: 0;
          }

          .register-container {
              left: 0;
              width: 50%;
              opacity: 0;
              z-index: 1;
          }

          .container.right-panel-active .register-container {
              transform: translateX(100%);
              opacity: 1;
              z-index: 5;
              animation: show 0.6s;
          }

          @keyframes show {
              0%, 49.99% {
                  opacity: 0;
                  z-index: 1;
              }
              50%, 100% {
                  opacity: 1;
                  z-index: 5;
              }
          }

          .overlay-container {
              position: absolute;
              top: 0;
              left: 50%;
              width: 50%;
              height: 100%;
              overflow: hidden;
              transition: transform 0.6s ease-in-out;
              z-index: 100;
          }

          .container.right-panel-active .overlay-container {
              transform: translateX(-100%);
          }

          .overlay {
              background: linear-gradient(to right, #4bb6b7, #2e5e64);
              background-repeat: no-repeat;
              background-size: cover;
              background-position: 0 0;
              color: #fff;
              position: relative;
              left: -100%;
              height: 100%;
              width: 200%;
              transform: translateX(0);
              transition: transform 0.6s ease-in-out;
          }

          .overlay:before {
              content: "";
              position: absolute;
              left: 0;
              right: 0;
              top: 0;
              bottom: 0;
              background: linear-gradient(to top, rgba(46, 94, 100, 0.4) 40%, rgba(46, 94, 100, 0));
          }

          .container.right-panel-active .overlay {
              transform: translateX(50%);
          }

          .overlay-panel {
              position: absolute;
              display: flex;
              align-items: center;
              justify-content: center;
              flex-direction: column;
              padding: 0 40px;
              text-align: center;
              top: 0;
              height: 100%;
              width: 50%;
              transform: translateX(0);
              transition: transform 0.6s ease-in-out;
          }

          .overlay-left {
              transform: translateX(-20%);
          }

          .container.right-panel-active .overlay-left {
              transform: translateX(0);
          }

          .overlay-right {
              right: 0;
              transform: translateX(0);
          }

          .container.right-panel-active .overlay-right {
              transform: translateX(20%);
          }

          .social-container {
              margin: 20px 0;
          }

          .social-container a {
              border: 1px solid #dddddd;
              border-radius: 50%;
              display: inline-flex;
              justify-content: center;
              align-items: center;
              margin: 0 5px;
              height: 40px;
              width: 40px;
              transition: 0.3s ease-in-out;
          }

          .social-container a:hover {
              border: 1px solid #4bb6b7;
          }
      </style>
  </head>
  <body>
      <div class="container" id="container">
          <!-- Form Login -->
          <div class="form-container login-container">
              <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <h1>Login here.</h1>

                  <!-- Tampilkan Pesan Error dari Session -->
                  @if (session('error'))
                      <span class="text-danger" style="color: red; font-size: 12px;">{{ session('error') }}</span>
                  @endif
                  @if (session('login_error'))
                      <span class="text-danger" style="color: red; font-size: 12px;">{{ session('login_error') }}</span>
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

          <!-- Form Register -->
          <div class="form-container register-container">
              <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <h1>Register here.</h1>

                  <!-- Tampilkan Pesan Error dari Session -->
                  @if (session('register_error'))
                      <span class="text-danger" style="color: red; font-size: 12px;">{{ session('register_error') }}</span>
                  @endif

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

          <!-- Overlay -->
          <div class="overlay-container">
              <div class="overlay">
                  <div class="overlay-panel overlay-left">
                      <h1 class="title">Hello <br> friends</h1>
                      <p>If you have an account, login here and have fun</p>
                      <button class="ghost" id="login">Login
                          <i class="lni lni-arrow-left login"></i>
                      </button>
                  </div>
                  <div class="overlay-panel overlay-right">
                      <h1 class="title">Start your <br> journey now</h1>
                      <p>If you don't have an account yet, join us and start your journey.</p>
                      <button class="ghost" id="register">Register
                          <i class="lni lni-arrow-right register"></i>
                      </button>
                  </div>
              </div>
          </div>
      </div>

      <script>
          document.addEventListener("DOMContentLoaded", function () {
              const registerButton = document.getElementById("register");
              const loginButton = document.getElementById("login");
              const container = document.getElementById("container");

              // Periksa apakah ada error pada form login atau register
              const hasLoginError = @json(session('login_error') || $errors->has('email') || $errors->has('password'));
              const hasRegisterError = @json(session('register_error') || $errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('role'));

              // Jika ada error pada form register, tampilkan form register
              if (hasRegisterError) {
                  container.classList.add("right-panel-active");
              } else {
                  // Jika tidak, pastikan form login ditampilkan secara default
                  container.classList.remove("right-panel-active");
              }

              registerButton.addEventListener("click", () => {
                  container.classList.add("right-panel-active");
              });

              loginButton.addEventListener("click", () => {
                  container.classList.remove("right-panel-active");
              });
          });
      </script>
  </body>
  </html>