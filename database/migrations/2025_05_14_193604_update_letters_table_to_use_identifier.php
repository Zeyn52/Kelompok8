<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLettersTableToUseIdentifier extends Migration
{
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Ganti kolom nim menjadi identifier
            $table->renameColumn('nim', 'identifier');
            
            // Tambahkan foreign key constraint ke tabel users (opsional, jika Anda ingin relasi)
            $table->foreign('identifier')
                  ->references('identifier')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Drop foreign key terlebih dahulu
            $table->dropForeign(['identifier']);
            
            // Kembalikan kolom identifier menjadi nim
            $table->renameColumn('identifier', 'nim');
        });
    }
}