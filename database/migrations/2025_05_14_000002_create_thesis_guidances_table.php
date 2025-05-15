<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('thesis_guidances', function (Blueprint $table) {
            $table->id();
            $table->string('student_identifier', 255);
            $table->string('supervisor_identifier', 255);
            $table->string('topic', 255)->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('guidance_date');
            $table->timestamps();

            $table->foreign('student_identifier')->references('identifier')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_identifier')->references('identifier')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('thesis_guidances');
    }
};