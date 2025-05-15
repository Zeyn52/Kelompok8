<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLettersTableAddDiterimaStatus extends Migration
{
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Ubah kolom status untuk menyertakan 'Diterima'
            $table->enum('status', ['Proses', 'Selesai', 'Ditolak', 'Diterima'])->default('Proses')->change();
        });
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Kembalikan ke definisi sebelumnya (tanpa 'Diterima')
            $table->enum('status', ['Proses', 'Selesai', 'Ditolak'])->default('Proses')->change();
        });
    }
}