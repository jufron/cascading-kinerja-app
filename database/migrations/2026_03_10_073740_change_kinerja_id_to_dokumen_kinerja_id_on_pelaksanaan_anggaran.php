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
        Schema::drop('pelaksanaan_anggaran');

        Schema::create('pelaksanaan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokument_kinerja_id');
            $table->foreign('dokument_kinerja_id')->references('id')->on('dokument_kinerja')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('program_kegiatan');
            $table->string('jumlah_anggaran');
            $table->string('target_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('pelaksanaan_anggaran');

        Schema::create('pelaksanaan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kinerja_id');
            $table->foreign('kinerja_id')->references('id')->on('kinerja')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('program_kegiatan');
            $table->string('jumlah_anggaran');
            $table->string('target_kegiatan');
            $table->timestamps();
        });

    }
};
