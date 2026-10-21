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
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->year('tahun');
            $table->unsignedInteger('kuota')->default(0);
            $table->date('tanggal_mulai');
            $table->date('deadline');
            $table->decimal('lambda_max', 10, 5)->nullable();
            $table->decimal('ci', 10, 5)->nullable();
            $table->decimal('cr', 10, 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};
