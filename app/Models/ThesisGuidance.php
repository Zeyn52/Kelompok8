<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ThesisGuidance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_identifier',
        'supervisor_identifier',
        'topic',
        'notes',
        'guidance_date',
    ];

    protected $dates = [
        'guidance_date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_identifier', 'identifier');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_identifier', 'identifier');
    }

    protected static function booted()
    {
        static::deleting(function ($thesisGuidance) {
            Log::info('Menghapus bimbingan skripsi terkait pengguna secara permanen', [
                'thesis_guidance_id' => $thesisGuidance->id,
                'student_identifier' => $thesisGuidance->student_identifier,
                'supervisor_identifier' => $thesisGuidance->supervisor_identifier,
            ]);
        });
    }
}