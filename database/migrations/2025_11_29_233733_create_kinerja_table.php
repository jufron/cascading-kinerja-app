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
        Schema::create('kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokument_kinerja_id');
            $table->foreign('dokument_kinerja_id')->references('id')->on('dokument_kinerja')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('sasaran_strategis');
            $table->text('sasaran_strategis_individu');
            $table->text('indikator_kinerja_individu');
            $table->string('target');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinerja');
    }
};
