<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateLastLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_login = now();
            $user->save();

            // Logging login pengguna
            $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i A d M Y'); // 06:11 PM 18 May 2025
            Log::info('Pengguna berhasil login [' . $currentTime . ']', [
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);
        }

        return $next($request);
    }
}