<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $letters = [];

        if ($user->role === 'mahasiswa') {
            $letters = Letter::where('nim', $user->nim)->get();
        } elseif ($user->role === 'dosen') {
            $letters = Letter::whereRaw('LOWER(status) = ?', ['proses'])->get();
        } elseif ($user->role === 'admin') {
            $letters = Letter::all();
        }

        return view('dashboard', compact('letters'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $letter = Letter::findOrFail($id);
        $letters = [];
    
        if ($user->role === 'mahasiswa') {
            $letters = Letter::where('nim', $user->nim)->get();
        } elseif ($user->role === 'dosen') {
            $letters = Letter::whereRaw('LOWER(status) = ?', ['proses'])->get();
        } elseif ($user->role === 'admin') {
            $letters = Letter::all();
        }
    
        return view('dashboard', compact('letter', 'letters'));
    }
}