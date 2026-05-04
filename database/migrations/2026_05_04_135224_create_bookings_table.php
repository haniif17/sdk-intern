<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('nama_komunitas');
            $table->date('tanggal');
            $table->string('ruangan');
            $table->string('waktu');
            $table->string('no_hp');
            $table->string('status')->default('pending'); // pending / approved / rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
