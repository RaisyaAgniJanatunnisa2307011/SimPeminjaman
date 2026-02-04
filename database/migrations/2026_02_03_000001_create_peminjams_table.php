<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('no_identitas')->unique();
            $table->string('kontak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
