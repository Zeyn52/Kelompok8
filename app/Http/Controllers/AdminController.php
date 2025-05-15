<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function manageUsers()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
        }

        // Ambil semua pengguna
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function systemSettings()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
        }

        return view('admin.settings');
    }
}