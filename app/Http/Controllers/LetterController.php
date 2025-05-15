<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LetterController extends Controller
{
    public function create()
    {
        if (Auth::user()->role !== 'mahasiswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya mahasiswa yang dapat mengajukan surat.');
        }

        if (is_null(Auth::user()->identifier)) {
            return redirect()->route('dashboard')->with('error', 'Identifier Anda tidak ditemukan. Silakan hubungi admin.');
        }

        return view('letters.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'mahasiswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya mahasiswa yang dapat mengajukan surat.');
        }

        if (is_null(Auth::user()->identifier)) {
            return redirect()->route('dashboard')->with('error', 'Identifier Anda tidak ditemukan. Silakan hubungi admin.');
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
            'identifier' => Auth::user()->identifier,
            'letter_type' => $request->letter_type,
            'submission_date' => now(),
            'completion_date' => null,
            'file_link' => null,
            'status' => 'Proses',
            'file_path' => null,
            'description' => $request->description,
        ];

        if ($request->hasFile('file_path')) {
            try {
                $data['file_path'] = $request->file('file_path')->store('letters', 'public');
                $data['file_link'] = asset('storage/' . $data['file_path']);
            } catch (\Exception $e) {
                return redirect()->route('dashboard')->with('error', 'Gagal mengunggah file: ' . $e->getMessage());
            }
        }

        try {
            Letter::create($data);
            return redirect()->route('dashboard')->with('success', 'Surat berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal menyimpan surat: ' . $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $letter = null;

        if ($user->role === 'mahasiswa') {
            if (is_null($user->identifier)) {
                return redirect()->route('dashboard')->with('error', 'Identifier Anda tidak ditemukan. Silakan hubungi admin.');
            }
            $letter = Letter::where('identifier', $user->identifier)->findOrFail($id);
        } elseif (in_array($user->role, ['dosen', 'admin'])) {
            $letter = Letter::findOrFail($id);
        } else {
            return redirect()->route('dashboard')->with('error', 'Role Anda tidak diizinkan untuk melihat surat.');
        }

        $letters = ($user->role === 'mahasiswa') ? Letter::where('identifier', $user->identifier)->get() : Letter::all();

        return view('dashboard', compact('letter', 'letters'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['dosen', 'admin'])) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya dosen atau admin yang dapat mengubah status surat.'
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:Selesai,Proses,Ditolak,Diterima',
        ]);

        $letter = Letter::findOrFail($id);

        Log::info('Status awal surat sebelum update', [
            'id' => $id,
            'status' => $letter->status,
            'user_role' => $user->role,
            'request_data' => $request->all(),
        ]);

        if ($user->role === 'dosen' && !in_array($request->status, ['Proses', 'Ditolak', 'Diterima'])) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen hanya dapat mengubah status menjadi Proses, Ditolak, atau Diterima.'
            ], 400);
        }

        if ($user->role === 'admin') {
            if ($request->status !== 'Selesai') {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin hanya dapat mengubah status menjadi Selesai.'
                ], 400);
            }
            if ($letter->status !== 'Diterima') {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin hanya dapat mengubah status surat yang sudah Diterima menjadi Selesai.'
                ], 400);
            }
        }

        $updateData = ['status' => $request->status];
        if ($request->status === 'Selesai') {
            $updateData['completion_date'] = now();
        } else {
            $updateData['completion_date'] = null;
        }

        try {
            Log::info('Mengubah status surat', [
                'id' => $id,
                'status_baru' => $request->status,
                'completion_date' => $updateData['completion_date'],
                'user_role' => $user->role,
            ]);
            $letter->update($updateData);

            $updatedLetter = Letter::findOrFail($id);
            Log::info('Status surat setelah update', [
                'id' => $id,
                'status' => $updatedLetter->status,
                'completion_date' => $updatedLetter->completion_date,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status surat berhasil diperbarui.',
                'status' => $updatedLetter->status,
                'completion_date' => $updatedLetter->completion_date ? $updatedLetter->completion_date->format('d-m-Y') : null,
                'letter_id' => $id
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui status surat', [
                'id' => $id,
                'error' => $e->getMessage(),
                'status_baru' => $request->status,
                'sql_query' => $e instanceof \PDOException ? $e->queryString : null,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status surat: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLetter($id)
    {
        $letter = Letter::findOrFail($id);
        $file_url = $letter->file_path ? asset('storage/' . $letter->file_path) : null;

        return response()->json([
            'success' => true,
            'letter' => $letter,
            'file_url' => $file_url,
        ]);
    }
}