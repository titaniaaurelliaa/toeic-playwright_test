<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan_kode')->unique();
            $table->string('jurusan_nama');
            $table->unsignedBigInteger('kampus_id')->index();
            $table->timestamps();

            $table->foreign('kampus_id')->references('id')->on('kampus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurusan');
    }
};