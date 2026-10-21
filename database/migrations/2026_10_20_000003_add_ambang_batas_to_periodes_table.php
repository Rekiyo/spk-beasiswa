<?php

use App\Services\SawService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('periodes', function (Blueprint $table) {
            if (! Schema::hasColumn('periodes', 'ambang_batas')) {
                $table->decimal('ambang_batas', 4, 3)->nullable()->default(SawService::AMBANG_BATAS)->after('total_siswa');
            }
        });

        // Pastikan periode yang sudah ada memiliki nilai ambang_batas 0.800
        DB::table('periodes')->whereNull('ambang_batas')->update([
            'ambang_batas' => SawService::AMBANG_BATAS,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periodes', function (Blueprint $table) {
            if (Schema::hasColumn('periodes', 'ambang_batas')) {
                $table->dropColumn('ambang_batas');
            }
        });
    }
};
