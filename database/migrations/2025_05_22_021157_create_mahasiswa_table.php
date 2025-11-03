<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->index();
            $table->char('mahasiswa_nim', 10)->unique();
            $table->string('mahasiswa_nama', 100);
            $table->string('alamat', 255);
            $table->char('no_telp', 15);
            $table->string('email', 100);
            $table->string('file_ktm', 100);
            $table->string('file_ktp', 100);
            $table->string('file_pas_foto', 100);
            $table->unsignedBigInteger('prodi_id')->index();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};