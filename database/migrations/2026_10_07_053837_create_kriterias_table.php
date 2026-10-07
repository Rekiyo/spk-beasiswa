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
    Schema::create('kriterias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete();
        $table->string('kode', 10);
        $table->string('nama');
        $table->enum('atribut', ['benefit', 'cost']);
        $table->decimal('bobot', 10, 6)->nullable();
        $table->timestamps();

        $table->unique(['periode_id', 'kode']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
