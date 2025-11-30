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
        Schema::create('dokument_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_pihak_pertama');
            $table->foreign('user_id_pihak_pertama')->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('user_id_pihak_kedua');
            $table->foreign('user_id_pihak_kedua')->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('jenis_kinerja');
            $table->text('head_dokument');
            $table->text('body_dokument');
            $table->string('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokument_kinerja');
    }
};
