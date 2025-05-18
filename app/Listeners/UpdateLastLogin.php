<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class UpdateLastLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $user->last_login = now();
        $user->save();

        // Logging login pengguna
        $currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i A d M Y');
        Log::info('Pengguna berhasil login [' . $currentTime . ']', [
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);
    }
}