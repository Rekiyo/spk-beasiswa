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
        // Tambahkan kolom matriks_ahp dan status_final pada tabel periodes jika belum ada
        Schema::table('periodes', function (Blueprint $table) {
            if (! Schema::hasColumn('periodes', 'matriks_ahp')) {
                $table->json('matriks_ahp')->nullable()->after('cr');
            }
            if (! Schema::hasColumn('periodes', 'is_final')) {
                $table->boolean('is_final')->default(false)->after('matriks_ahp');
            }
        });

        // Tabel calon penerima beasiswa (alternatif dalam SPK)
        if (! Schema::hasTable('calon_penerimas')) {
            Schema::create('calon_penerimas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete();
                $table->string('nim', 30);
                $table->string('nama', 255);
                $table->string('program_studi', 255);
                $table->string('semester', 50)->default('Semester 5');
                $table->string('jalur', 100)->default('Reguler Pagi');
                $table->decimal('skor_saw', 8, 4)->nullable();
                $table->unsignedInteger('ranking')->nullable();
                $table->enum('status_kelulusan', ['lolos', 'cadangan', 'tidak_lolos'])->default('tidak_lolos');
                $table->text('catatan')->nullable();
                $table->timestamps();

                $table->unique(['periode_id', 'nim']);
            });
        }

        // Tabel penilaian kriteria untuk masing-masing calon penerima
        if (! Schema::hasTable('penilaians')) {
            Schema::create('penilaians', function (Blueprint $table) {
                $table->id();
                $table->foreignId('calon_penerima_id')->constrained('calon_penerimas')->cascadeOnDelete();
                $table->foreignId('kriteria_id')->constrained('kriterias')->cascadeOnDelete();
                $table->foreignId('sub_kriteria_id')->nullable()->constrained('sub_kriterias')->nullOnDelete();
                $table->decimal('nilai', 14, 4);
                $table->timestamps();

                $table->unique(['calon_penerima_id', 'kriteria_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
        Schema::dropIfExists('calon_penerimas');

        Schema::table('periodes', function (Blueprint $table) {
            if (Schema::hasColumn('periodes', 'is_final')) {
                $table->dropColumn('is_final');
            }
            if (Schema::hasColumn('periodes', 'matriks_ahp')) {
                $table->dropColumn('matriks_ahp');
            }
        });
    }
};
