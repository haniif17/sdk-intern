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
        Schema::create('komunitas', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (untuk login)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('nama_komunitas');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('nama_ketua');
            $table->integer('jumlah_anggota');
            $table->string('logo')->nullable(); // Ganti 'image' jadi 'logo' biar sesuai request
            
            // Status Moderasi: default 'pending'
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};
