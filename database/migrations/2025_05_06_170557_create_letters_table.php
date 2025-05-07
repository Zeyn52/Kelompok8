<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id(); // No (auto-increment primary key)
            $table->string('letter_number'); // No Surat
            $table->string('nim'); // NIM
            $table->string('letter_type'); // Jenis Surat
            $table->date('submission_date'); // Tanggal Pengajuan
            $table->date('completion_date')->nullable(); // Tanggal Selesai (nullable)
            $table->string('file_link')->nullable(); // File Surat (nullable)
            $table->string('status'); // Status
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('letters');
    }
}