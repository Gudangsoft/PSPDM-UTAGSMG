<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $gasal = [
            [1, 'Mei – Agustus 2026',            'Penerimaan Mahasiswa Baru',                       'administrasi'],
            [2, 'Juli – Agustus 2026',            'Registrasi administrasi dan akademik',            'administrasi'],
            [3, '15 Sep 2026',                    'Kuliah perdana',                                  'perkuliahan'],
            [4, '15 Sep 2026 – 15 Jan 2027',      'Perkuliahan reguler',                             'perkuliahan'],
            [5, '16 – 20 Nov 2026',               'Ujian Tengah Semester (UTS)',                     'evaluasi'],
            [6, '22 – 26 Februari 2027',          'Ujian Akhir Semester (UAS)',                      'evaluasi'],
            [7, '10 – 17 Maret 2027',             'Ujian kualifikasi (jadwal menyesuaikan)',         'sidang'],
            [8, '15 Maret 2027',                  'Yudisium Semester Gasal',                         'evaluasi'],
        ];

        $genap = [
            [1, 'Oktober 2026 – Feb 2027',        'Penerimaan Mahasiswa Baru',                       'administrasi'],
            [2, 'Jan – Feb 2027',                 'Registrasi administrasi dan akademik',            'administrasi'],
            [3, '15 Maret 2027',                  'Kuliah perdana',                                  'perkuliahan'],
            [4, '15 Maret 2027 s/d 15 Juli 2027', 'Perkuliahan reguler',                             'perkuliahan'],
            [5, '16 – 20 Mei 2027',               'Ujian Tengah Semester (UTS)',                     'evaluasi'],
            [6, '22 – 26 Juli 2027',              'Ujian Akhir Semester (UAS)',                      'evaluasi'],
            [7, '10 – 17 Agustus 2027',           'Ujian kualifikasi (jadwal menyesuaikan)',         'sidang'],
            [8, '20 Agustus 2027',                'Yudisium Semester Genap',                         'evaluasi'],
        ];

        $now  = now();
        $rows = [];

        foreach ($gasal as [$no, $periode, $kegiatan, $jenis]) {
            $rows[] = ['tahun_akademik'=>'2026/2027','semester'=>'gasal','no_urut'=>$no,
                       'periode'=>$periode,'kegiatan'=>$kegiatan,'jenis'=>$jenis,
                       'is_active'=>true,'created_at'=>$now,'updated_at'=>$now];
        }
        foreach ($genap as [$no, $periode, $kegiatan, $jenis]) {
            $rows[] = ['tahun_akademik'=>'2026/2027','semester'=>'genap','no_urut'=>$no,
                       'periode'=>$periode,'kegiatan'=>$kegiatan,'jenis'=>$jenis,
                       'is_active'=>true,'created_at'=>$now,'updated_at'=>$now];
        }

        DB::table('jadwal_akademik')->insert($rows);
    }

    public function down(): void
    {
        DB::table('jadwal_akademik')->where('tahun_akademik', '2026/2027')->delete();
    }
};
