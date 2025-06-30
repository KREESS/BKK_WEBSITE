<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinatSiswasTable extends Migration
{
    public function up(): void
    {
        Schema::create('minat_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nisn')->nullable();
            $table->string('kelas')->default('12');
            $table->string('jurusan');
            $table->json('minat'); // bisa menyimpan array
            $table->text('alasan');
            $table->string('kontak')->nullable(); // email atau no hp
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minat_siswas');
    }
}
