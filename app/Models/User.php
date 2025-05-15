<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'identifier',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class, 'identifier', 'identifier'); // Sesuaikan relasi dengan identifier
    }

    // Getter untuk nim (untuk backward compatibility dengan data lama)
    public function getNimAttribute()
    {
        return $this->role === 'mahasiswa' ? $this->identifier : null;
    }

    // Getter untuk nip (untuk dosen/admin)
    public function getNipAttribute()
    {
        return in_array($this->role, ['dosen', 'admin']) ? $this->identifier : null;
    }
}