<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Letter extends Model
{
    protected $fillable = [
        'letter_number',
        'identifier',
        'letter_type',
        'submission_date',
        'completion_date',
        'file_link',
        'status',
        'file_path',
        'description',
    ];

    protected $dates = [
        'submission_date',
        'completion_date',
    ];

    protected $casts = [
        'submission_date' => 'datetime',
        'completion_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'identifier', 'identifier');
    }

    // Tambahkan event listener untuk debugging dan penghapusan file
    protected static function booted()
    {
        static::updating(function ($letter) {
            Log::info('Sebelum update status surat', [
                'id' => $letter->id,
                'status_lama' => $letter->getOriginal('status'),
                'status_baru' => $letter->status,
            ]);
        });

        static::updated(function ($letter) {
            Log::info('Setelah update status surat', [
                'id' => $letter->id,
                'status' => $letter->status,
            ]);
        });

        static::deleting(function ($letter) {
            // Hapus file fisik jika ada
            if ($letter->file_path && file_exists(storage_path('app/' . $letter->file_path))) {
                unlink(storage_path('app/' . $letter->file_path));
            }

            Log::info('Menghapus surat terkait pengguna secara permanen', [
                'letter_id' => $letter->id,
                'identifier' => $letter->identifier,
            ]);
        });
    }
}