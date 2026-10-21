<?php

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
            if (! Schema::hasColumn('periodes', 'total_siswa')) {
                $table->unsignedInteger('total_siswa')->nullable()->default(0)->after('kuota');
            }
        });

        // Set nilai default awal yang wajar untuk periode yang sudah ada
        $periodes = DB::table('periodes')->get();
        foreach ($periodes as $p) {
            $calonCount = DB::table('calon_penerimas')->where('periode_id', $p->id)->count();
            $targetAwal = ($calonCount > 0) ? max(300, (int) ceil($calonCount * 1.5)) : 300;

            DB::table('periodes')->where('id', $p->id)->update([
                'total_siswa' => $targetAwal,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periodes', function (Blueprint $table) {
            if (Schema::hasColumn('periodes', 'total_siswa')) {
                $table->dropColumn('total_siswa');
            }
        });
    }
};
