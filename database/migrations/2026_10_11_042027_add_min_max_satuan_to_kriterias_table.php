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
        Schema::table('kriterias', function (Blueprint $table) {
            $table->decimal('min_val', 15, 2)->nullable()->after('rentang');
            $table->decimal('max_val', 15, 2)->nullable()->after('min_val');
            $table->string('satuan', 50)->nullable()->after('max_val');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kriterias', function (Blueprint $table) {
            $table->dropColumn(['min_val', 'max_val', 'satuan']);
        });
    }
};
