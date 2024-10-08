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
        Schema::create('sertifikat_guru', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id')->on('guru')->cascadeOnDelete();
            $table->string('nama_file', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat_guru');
    }
};
