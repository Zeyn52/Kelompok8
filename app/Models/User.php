<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles; // Hapus SoftDeletes

    protected $fillable = [
        'name',
        'email',
        'password',
        'identifier',
        'role',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class, 'identifier', 'identifier');
    }

    public function thesisGuidancesAsStudent()
    {
        return $this->hasMany(ThesisGuidance::class, 'student_identifier', 'identifier');
    }

    public function thesisGuidancesAsSupervisor()
    {
        return $this->hasMany(ThesisGuidance::class, 'supervisor_identifier', 'identifier');
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

    protected static function booted()
    {
        static::deleting(function ($user) {
            // Hapus permanen semua data pengajuan surat terkait
            $user->letters()->forceDelete();

            // Hapus permanen semua data bimbingan skripsi (sebagai mahasiswa)
            $user->thesisGuidancesAsStudent()->forceDelete();

            // Hapus permanen semua data bimbingan skripsi (sebagai dosen/pembimbing)
            $user->thesisGuidancesAsSupervisor()->forceDelete();
        });
    }
}