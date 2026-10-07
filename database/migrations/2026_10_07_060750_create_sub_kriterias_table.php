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
    Schema::create('sub_kriterias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kriteria_id')->constrained('kriterias')->cascadeOnDelete();
        $table->string('label');
        $table->unsignedSmallInteger('nilai');
        $table->timestamps();

        $table->unique(['kriteria_id', 'label']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kriterias');
    }
};
