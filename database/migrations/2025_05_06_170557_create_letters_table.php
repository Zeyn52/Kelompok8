<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number')->nullable();
            $table->string('nim', 20);
            $table->string('letter_type');
            $table->date('submission_date');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Proses', 'Selesai', 'Ditolak'])->default('Proses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('letters');
    }
}