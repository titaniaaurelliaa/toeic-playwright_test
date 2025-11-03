<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['kampus_id']);

            // Kemudian hapus kolom
            $table->dropColumn('kampus_id');
        });
    }

    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            // Untuk rollback, tambahkan kembali kolom dan foreign key
            $table->unsignedBigInteger('kampus_id')->index();
            $table->foreign('kampus_id')->references('id')->on('kampus')->onDelete('cascade');
        });
    }
};
