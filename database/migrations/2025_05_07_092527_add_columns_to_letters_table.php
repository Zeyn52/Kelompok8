<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLettersTable extends Migration
{
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('status'); // Kolom untuk menyimpan path file
            $table->text('description')->nullable()->after('file_path'); // Kolom untuk keterangan tambahan
        });
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'description']);
        });
    }
}