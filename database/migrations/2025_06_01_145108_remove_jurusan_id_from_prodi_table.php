<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            // Drop foreign key pakai nama yang benar
            $table->dropForeign('prodi_jurusan_id_foreign');
    
            // Drop kolom jurusan_id
            $table->dropColumn('jurusan_id');
        });
    }

    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            // Untuk rollback, tambahkan kembali kolom dan foreign key
            $table->unsignedBigInteger('jurusan_id')->after('prodi_nama');

            $table->foreign('jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onDelete('cascade');
        });
    }
};
