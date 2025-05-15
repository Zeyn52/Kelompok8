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
            $letters = Letter::where('identifier', $user->identifier)->get(); // Ubah nim menjadi identifier
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
    
        if ($user->role === 'mahasiswa' && $letter->identifier !== $user->identifier) { // Ubah nim menjadi identifier
            abort(403, 'Unauthorized');
        }
    
        $letters = [];
        if ($user->role === 'mahasiswa') {
            $letters = Letter::where('identifier', $user->identifier)->get(); // Ubah nim menjadi identifier
        } elseif ($user->role === 'dosen') {
            $letters = Letter::whereRaw('LOWER(status) = ?', ['proses'])->get();
        } elseif ($user->role === 'admin') {
            $letters = Letter::all();
        }
    
        return view('dashboard', compact('letter', 'letters'));
    }

    public function getLetterDetails($id)
    {
        $user = Auth::user();
        $letter = Letter::findOrFail($id);

        if ($user->role === 'mahasiswa' && $letter->identifier !== $user->identifier) { // Ubah nim menjadi identifier
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $fileUrl = $letter->file_path ? asset('storage/' . $letter->file_path) : null;
        return response()->json(['success' => true, 'letter' => $letter, 'file_url' => $fileUrl]);
    }
}