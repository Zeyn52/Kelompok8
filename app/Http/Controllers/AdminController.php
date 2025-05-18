<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function manageUsers()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
        }

        // Ambil semua pengguna dengan data last_login
        $users = User::all();

        // Logging dengan waktu saat ini (07:30 PM WIB, 18 Mei 2025)
        $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i A d M Y'); // 07:30 PM 18 May 2025
        Log::info('Admin mengakses halaman Kelola Pengguna [' . $currentTime . ']', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
        ]);

        return view('admin.users', compact('users'));
    }

    public function systemSettings()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
        }

        // Logging dengan waktu saat ini (07:30 PM WIB, 18 Mei 2025)
        $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i A d M Y'); // 07:30 PM 18 May 2025
        Log::info('Admin mengakses halaman Pengaturan Sistem [' . $currentTime . ']', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
        ]);

        return view('admin.settings');
    }

    public function destroy(User $user)
    {
        // Pastikan hanya admin yang bisa menghapus
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.users')->with('error', 'Hanya admin yang dapat menghapus pengguna.');
        }

        // Jangan izinkan admin menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Simpan nama pengguna untuk logging sebelum dihapus
        $userName = $user->name;

        // Hapus pengguna secara permanen (akan memicu event deleting untuk menghapus data terkait)
        $user->forceDelete();

        // Logging aktivitas penghapusan
        $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i A d M Y'); // 07:30 PM 18 May 2025
        Log::info('Admin menghapus pengguna secara permanen [' . $currentTime . ']', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'deleted_user' => $userName,
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna dan data terkait berhasil dihapus secara permanen.');
    }
}