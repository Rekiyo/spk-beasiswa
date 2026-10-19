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
        Schema::table('penilaians', function (Blueprint $table) {
            $table->double('nilai')->change();
        });

        Schema::table('kriterias', function (Blueprint $table) {
            if (Schema::hasColumn('kriterias', 'min_val')) {
                $table->double('min_val')->nullable()->change();
            }
            if (Schema::hasColumn('kriterias', 'max_val')) {
                $table->double('max_val')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->decimal('nilai', 14, 4)->change();
        });

        Schema::table('kriterias', function (Blueprint $table) {
            if (Schema::hasColumn('kriterias', 'min_val')) {
                $table->decimal('min_val', 14, 4)->nullable()->change();
            }
            if (Schema::hasColumn('kriterias', 'max_val')) {
                $table->decimal('max_val', 14, 4)->nullable()->change();
            }
        });
    }
};
