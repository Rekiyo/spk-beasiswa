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
        // 1. Tabel Master Konfigurasi Seleksi
        Schema::create('konfigurasi_seleksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('versi')->default(1);
            $table->foreignId('parent_id')->nullable()->constrained('konfigurasi_seleksis')->nullOnDelete();
            $table->json('matriks_ahp')->nullable();
            $table->decimal('lambda_max', 8, 5)->nullable();
            $table->decimal('ci', 8, 5)->nullable();
            $table->decimal('cr', 8, 5)->nullable();
            $table->boolean('is_konsisten')->default(true);
            $table->boolean('is_siap')->default(true);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // 2. Tabel 5 Kriteria Konfigurasi Seleksi
        Schema::create('konfigurasi_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konfigurasi_seleksi_id')->constrained('konfigurasi_seleksis')->cascadeOnDelete();
            $table->string('kode', 10);
            $table->string('nama');
            $table->string('atribut')->default('benefit'); // 'benefit' atau 'cost'
            $table->string('tipe_input')->default('angka'); // 'angka' atau 'pilihan'
            $table->string('rentang')->nullable();
            $table->double('min_val')->nullable()->default(0);
            $table->double('max_val')->nullable()->default(100);
            $table->string('satuan')->nullable();
            $table->decimal('bobot', 8, 6)->default(0.200000);
            $table->unsignedSmallInteger('urutan')->default(1);
            $table->timestamps();
        });

        // 3. Tabel Sub-Kriteria / Opsi Pilihan Konfigurasi
        Schema::create('konfigurasi_sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konfigurasi_kriteria_id')->constrained('konfigurasi_kriterias')->cascadeOnDelete();
            $table->string('label');
            $table->integer('nilai')->default(1);
            $table->unsignedSmallInteger('urutan')->default(1);
            $table->timestamps();
        });

        // 4. Tambahkan relasi konfigurasi_seleksi_id ke tabel periodes
        Schema::table('periodes', function (Blueprint $table) {
            $table->foreignId('konfigurasi_seleksi_id')
                ->nullable()
                ->after('deadline')
                ->constrained('konfigurasi_seleksis')
                ->nullOnDelete();
        });

        // 5. Data Migration: Transisi periode lama ke paket konfigurasi awal
        $periodes = DB::table('periodes')->get();
        foreach ($periodes as $periode) {
            $kriterias = DB::table('kriterias')->where('periode_id', $periode->id)->orderBy('kode')->get();
            if ($kriterias->isNotEmpty()) {
                $now = now();
                $konfigurasiId = DB::table('konfigurasi_seleksis')->insertGetId([
                    'nama' => 'Konfigurasi '.$periode->nama,
                    'deskripsi' => 'Paket konfigurasi seleksi otomatis dari riwayat '.$periode->nama,
                    'versi' => 1,
                    'parent_id' => null,
                    'matriks_ahp' => $periode->matriks_ahp,
                    'lambda_max' => $periode->lambda_max,
                    'ci' => $periode->ci,
                    'cr' => $periode->cr,
                    'is_konsisten' => ($periode->cr !== null && floatval($periode->cr) <= 0.10),
                    'is_siap' => true,
                    'is_aktif' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                DB::table('periodes')->where('id', $periode->id)->update([
                    'konfigurasi_seleksi_id' => $konfigurasiId,
                ]);

                $urutan = 1;
                foreach ($kriterias as $k) {
                    $kkId = DB::table('konfigurasi_kriterias')->insertGetId([
                        'konfigurasi_seleksi_id' => $konfigurasiId,
                        'kode' => $k->kode,
                        'nama' => $k->nama,
                        'atribut' => $k->atribut,
                        'tipe_input' => $k->tipe_input,
                        'rentang' => $k->rentang,
                        'min_val' => $k->min_val,
                        'max_val' => $k->max_val,
                        'satuan' => $k->satuan,
                        'bobot' => $k->bobot,
                        'urutan' => $urutan++,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $subKriterias = DB::table('sub_kriterias')->where('kriteria_id', $k->id)->orderBy('nilai')->get();
                    $subUrutan = 1;
                    foreach ($subKriterias as $sub) {
                        DB::table('konfigurasi_sub_kriterias')->insert([
                            'konfigurasi_kriteria_id' => $kkId,
                            'label' => $sub->label,
                            'nilai' => $sub->nilai,
                            'urutan' => $subUrutan++,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periodes', function (Blueprint $table) {
            $table->dropForeign(['konfigurasi_seleksi_id']);
            $table->dropColumn('konfigurasi_seleksi_id');
        });

        Schema::dropIfExists('konfigurasi_sub_kriterias');
        Schema::dropIfExists('konfigurasi_kriterias');
        Schema::dropIfExists('konfigurasi_seleksis');
    }
};
