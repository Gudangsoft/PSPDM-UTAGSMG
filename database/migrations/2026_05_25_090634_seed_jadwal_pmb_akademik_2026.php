<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah data sudah ada
        if (DB::table('jadwal_pmb')->where('periode', 'Mei – Agustus 2026')->exists()) return;

        $now  = now();
        $data = [
            // Semester Gasal
            [1,  'Mei – Agustus 2026',        'Penerimaan Mahasiswa Baru',                     'buka'],
            [2,  'Juli – Agustus 2026',        'Registrasi administrasi dan akademik',          'akan_datang'],
            [3,  '15 Sep 2026',                'Kuliah perdana',                                'belum'],
            [4,  '15 Sep 2026 – 15 Jan 2027',  'Perkuliahan reguler',                           'belum'],
            [5,  '16 – 20 Nov 2026',           'Ujian Tengah Semester (UTS)',                   'belum'],
            [6,  '22 – 26 Februari 2027',      'Ujian Akhir Semester (UAS)',                    'belum'],
            [7,  '10 – 17 Maret 2027',         'Ujian kualifikasi (jadwal menyesuaikan)',       'belum'],
            [8,  '15 Maret 2027',              'Yudisium Semester Gasal',                       'belum'],
            // Semester Genap
            [9,  'Oktober 2026 – Feb 2027',    'Penerimaan Mahasiswa Baru (Sem. Genap)',        'akan_datang'],
            [10, 'Jan – Feb 2027',             'Registrasi administrasi dan akademik (Genap)',  'belum'],
            [11, '15 Maret 2027',              'Kuliah perdana (Sem. Genap)',                   'belum'],
            [12, '15 Mar 2027 s/d 15 Jul 2027','Perkuliahan reguler (Sem. Genap)',              'belum'],
            [13, '16 – 20 Mei 2027',           'Ujian Tengah Semester (UTS) Genap',             'belum'],
            [14, '22 – 26 Juli 2027',          'Ujian Akhir Semester (UAS) Genap',              'belum'],
            [15, '10 – 17 Agustus 2027',       'Ujian kualifikasi (jadwal menyesuaikan)',       'belum'],
            [16, '20 Agustus 2027',            'Yudisium Semester Genap',                       'belum'],
        ];

        $rows = [];
        foreach ($data as [$urutan, $periode, $kegiatan, $status]) {
            $rows[] = [
                'kegiatan'   => $kegiatan,
                'periode'    => $periode,
                'status'     => $status,
                'urutan'     => $urutan,
                'is_active'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('jadwal_pmb')->insert($rows);
    }

    public function down(): void
    {
        DB::table('jadwal_pmb')
            ->whereIn('urutan', range(1, 16))
            ->where('periode', 'like', '%2026%')
            ->delete();
    }
};
