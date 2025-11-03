<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kampus', function (Blueprint $table) {
            $table->id();
            $table->string('kampus_nama');
            $table->string('kampus_alamat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kampus');
    }
};