<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['jurusan_id']);

            // Kemudian hapus kolom
            $table->dropColumn('jurusan_id');
        });
    }

    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            // Untuk rollback, tambahkan kembali kolom dan foreign key
            $table->unsignedBigInteger('jurusan_id')->index();
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
        });
    }
};
