<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan pengguna pertama
        User::create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'mahasiswa@example.com',
            'password' => bcrypt('password'),
            'nim' => '1234567890',
            'role' => 'mahasiswa',
        ]);

        // Tambahkan pengguna kedua
        User::create([
            'name' => 'Dosen Contoh',
            'email' => 'dosen@example.com',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        // Tambahkan pengguna ketiga
        User::create([
            'name' => 'Admin Contoh',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}