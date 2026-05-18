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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jalan_id')->nullable()->constrained('jalans')->onDelete('set null');
            $table->date('tanggal');
            $table->string('waktu');
            $table->string('lokasi');
            $table->string('jenis');
            $table->string('penyebab')->nullable();
            $table->string('dampak')->nullable();
            $table->string('foto');
            $table->string('video')->nullable();
            $table->string('status')->default('pending');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
