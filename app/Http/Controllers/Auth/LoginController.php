<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Login request received:', $request->only('email'));

        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            Log::info('Login successful for user:', ['email' => $request->email]);
            
            // Regenerasi sesi untuk memastikan data lama tidak digunakan
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil!');
        }

        Log::warning('Login failed for user:', ['email' => $request->email]);
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Log::info('Logout request received for user:', ['user_id' => Auth::id()]);
        
        // Logout pengguna
        Auth::logout();
        
        // Hapus sesi dan regenerasi token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login awal
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}