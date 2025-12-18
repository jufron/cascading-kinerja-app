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
        Schema::create('validasi_laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokument_kinerja_id');
            $table->foreign('dokument_kinerja_id')->references('id')->on('dokument_kinerja')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('status');
            $table->string('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_laporan');
    }
};
