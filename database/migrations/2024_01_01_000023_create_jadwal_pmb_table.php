<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pmb', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan', 200);
            $table->string('periode', 100);
            $table->string('status', 20)->default('belum'); // buka|proses|belum|akan_datang|selesai
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed initial data
        $rows = [
            ['kegiatan' => 'Pendaftaran Online Gelombang I',   'periode' => 'Februari – April', 'status' => 'buka',        'urutan' => 1],
            ['kegiatan' => 'Seleksi Administrasi Gel. I',       'periode' => 'April',            'status' => 'proses',      'urutan' => 2],
            ['kegiatan' => 'Tes Tulis & Wawancara Gel. I',      'periode' => 'Mei',              'status' => 'proses',      'urutan' => 3],
            ['kegiatan' => 'Pengumuman Gel. I',                  'periode' => 'Juni',             'status' => 'belum',       'urutan' => 4],
            ['kegiatan' => 'Pendaftaran Online Gelombang II',   'periode' => 'Juni – Agustus',   'status' => 'akan_datang', 'urutan' => 5],
            ['kegiatan' => 'Awal Perkuliahan',                   'periode' => 'September',        'status' => 'belum',       'urutan' => 6],
        ];

        $now = now();
        foreach ($rows as $row) {
            DB::table('jadwal_pmb')->insert(array_merge($row, [
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pmb');
    }
};
