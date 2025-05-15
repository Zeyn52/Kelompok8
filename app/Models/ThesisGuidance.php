<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function student()
    {
        return $this->belongsTo(User::class, 'student_identifier', 'identifier');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_identifier', 'identifier');
    }
}