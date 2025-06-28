<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran');
            $table->string('nama');
            $table->string('jurusan');
            $table->string('asal_sekolah');
            $table->string('jenis_kelamin');
            // Tambahkan status_pembayaran
            $table->enum('status_pembayaran', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->foreignId('user_id');
            $table->foreignId('lowongan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pendaftar');
    }
};
