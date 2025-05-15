<?php

namespace App\Http\Controllers;

use App\Models\ThesisGuidance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThesisGuidanceController extends Controller
{
    /**
     * Menampilkan halaman untuk mahasiswa mengajukan dan melihat bimbingan skripsi.
     */
    public function create()
    {
        // Ambil daftar dosen untuk dropdown
        $supervisors = User::where('role', 'dosen')->get();

        // Ambil riwayat bimbingan skripsi untuk mahasiswa yang sedang login
        $guidances = ThesisGuidance::where('student_identifier', Auth::user()->identifier)
            ->with('supervisor')
            ->get();

        return view('thesis_guidances.create', compact('supervisors', 'guidances'));
    }

    /**
     * Menyimpan pengajuan bimbingan skripsi dari mahasiswa.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'student_identifier' => 'required|string|exists:users,identifier',
            'supervisor_identifier' => 'required|string|exists:users,identifier',
            'topic' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'guidance_date' => 'required|date',
        ]);

        // Simpan data bimbingan skripsi ke database
        ThesisGuidance::create([
            'student_identifier' => $request->student_identifier,
            'supervisor_identifier' => $request->supervisor_identifier,
            'topic' => $request->topic,
            'notes' => $request->notes,
            'guidance_date' => $request->guidance_date,
        ]);

        // Redirect kembali ke halaman create dengan pesan sukses
        return redirect()->route('thesis_guidances.create')
            ->with('success', 'Bimbingan skripsi berhasil diajukan.');
    }

    /**
     * Menampilkan daftar bimbingan mahasiswa untuk dosen.
     */
    public function supervisor()
    {
        // Ambil daftar bimbingan skripsi yang dosennya adalah user yang sedang login
        $guidances = ThesisGuidance::where('supervisor_identifier', Auth::user()->identifier)
            ->with('student')
            ->get();

        return view('thesis_guidances.supervisor', compact('guidances'));
    }
}