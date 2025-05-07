<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function create()
    {
        if (Auth::user()->role !== 'mahasiswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya mahasiswa yang dapat mengajukan surat.');
        }

        if (is_null(Auth::user()->nim)) {
            return redirect()->route('dashboard')->with('error', 'NIM Anda tidak ditemukan. Silakan hubungi admin.');
        }

        return view('letters.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'mahasiswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya mahasiswa yang dapat mengajukan surat.');
        }

        if (is_null(Auth::user()->nim)) {
            return redirect()->route('dashboard')->with('error', 'NIM Anda tidak ditemukan. Silakan hubungi admin.');
        }

        $request->validate([
            'letter_number' => 'nullable|string|max:255',
            'letter_type' => 'required|string',
            'submission_date' => 'required|date',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'letter_number' => $request->letter_number,
            'nim' => Auth::user()->nim,
            'letter_type' => $request->letter_type,
            'submission_date' => $request->submission_date,
            'completion_date' => null,
            'file_link' => null,
            'status' => 'Proses',
            'file_path' => null,
            'description' => $request->description,
        ];

        if ($request->hasFile('file_path')) {
            try {
                $data['file_path'] = $request->file('file_path')->store('letters', 'public');
            } catch (\Exception $e) {
                return redirect()->route('letters.create')->with('error', 'Gagal mengunggah file: ' . $e->getMessage());
            }
        }

        try {
            Letter::create($data);
            return redirect()->route('dashboard')->with('success', 'Surat berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->route('letters.create')->with('error', 'Gagal menyimpan surat: ' . $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $letter = null;

        if ($user->role === 'mahasiswa') {
            if (is_null($user->nim)) {
                return redirect()->route('dashboard')->with('error', 'NIM Anda tidak ditemukan. Silakan hubungi admin.');
            }
            $letter = Letter::where('nim', $user->nim)->findOrFail($id);
        } elseif (in_array($user->role, ['dosen', 'admin'])) {
            $letter = Letter::findOrFail($id);
        } else {
            return redirect()->route('dashboard')->with('error', 'Role Anda tidak diizinkan untuk melihat surat.');
        }

        $letters = ($user->role === 'mahasiswa') ? Letter::where('nim', $user->nim)->get() : Letter::all();

        return view('dashboard', compact('letter', 'letters'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['dosen', 'admin'])) {
            return redirect()->route('dashboard')->with('error', 'Hanya dosen atau admin yang dapat mengubah status surat.');
        }

        $request->validate([
            'status' => 'required|in:Selesai,Proses,Ditolak',
        ]);

        $letter = Letter::findOrFail($id);

        if ($user->role === 'dosen' && !in_array($request->status, ['Proses', 'Ditolak'])) {
            return redirect()->route('dashboard')->with('error', 'Dosen hanya dapat mengubah status menjadi Proses atau Ditolak.');
        }

        if ($user->role === 'admin' && $request->status !== 'Selesai') {
            return redirect()->route('dashboard')->with('error', 'Admin hanya dapat mengubah status menjadi Selesai.');
        }

        $updateData = ['status' => $request->status];
        if ($request->status === 'Selesai') {
            $updateData['completion_date'] = now()->toDateString();
        } else {
            $updateData['completion_date'] = null;
        }

        try {
            $letter->update($updateData);
            return redirect()->route('dashboard')->with('success', 'Status surat berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal memperbarui status surat: ' . $e->getMessage());
        }
    }
}