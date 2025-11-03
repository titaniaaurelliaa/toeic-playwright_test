<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->index();
            $table->char('admin_nip', 10)->unique();
            $table->string('admin_nama', 100);
            $table->string('email', 100);
            $table->string('no_telp', 15);
            $table->string('alamat', 100);
            $table->string('username', 100);
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
};