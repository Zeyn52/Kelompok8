<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
        'letter_number',
        'nim',
        'letter_type',
        'submission_date',
        'completion_date',
        'file_link',
        'status',
    ];

    protected $casts = [
        'submission_date' => 'date',
        'completion_date' => 'date',
    ];
}