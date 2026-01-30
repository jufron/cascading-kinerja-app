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
        Schema::create('catatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('validation_laporan_id');
            $table->foreign('validation_laporan_id')->references('id')->on('validasi_laporan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('dokument_kinerja_id');
            $table->foreign('dokument_kinerja_id')->references('id')->on('dokument_kinerja')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan');
    }
};
