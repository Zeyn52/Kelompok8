<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'role', // Kolom role Anda tetap ada, tapi Spatie akan mengelola role tambahan
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}