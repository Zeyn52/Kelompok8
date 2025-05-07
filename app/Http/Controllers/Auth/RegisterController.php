<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Log::info('Register request received:', $request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:mahasiswa,dosen,admin',
            'nim' => 'required_if:role,mahasiswa|nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Buat akun baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'nim' => $request->role === 'mahasiswa' ? $request->nim : null,
            ]);

            Log::info('User created successfully:', $user->toArray());

            // Login dengan akun yang baru dibuat
            Auth::login($user);

            // Regenerasi sesi untuk memastikan data lama tidak digunakan
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Anda telah login.');
        } catch (\Exception $e) {
            Log::error('Failed to register user:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal melakukan registrasi: ' . $e->getMessage())->withInput();
        }
    }
}