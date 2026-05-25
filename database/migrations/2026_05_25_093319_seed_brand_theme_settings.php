<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            'nama_fakultas'      => 'Fakultas Ekonomika dan Bisnis',
            'nama_universitas'   => 'Universitas 17 Agustus 1945 Semarang',
            'singkatan_institusi'=> 'FEB Untag Semarang',
            'jam_layanan'        => "Senin – Jumat: 08.00 – 16.00 WIB\nSabtu: 08.00 – 12.00 WIB",
            'meta_keywords'      => 'program doktor manajemen, PSPDM, UNTAG Semarang, FEB UNTAG, S3 manajemen',
            'warna_primer'       => '#C0304A',
            'warna_sekunder'     => '#8B1A2E',
            'warna_gelap'        => '#5C0E1C',
        ];

        $now = now();
        foreach ($defaults as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => $now, 'created_at' => $now]
            );
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'nama_fakultas', 'nama_universitas', 'singkatan_institusi',
            'jam_layanan', 'meta_keywords', 'warna_primer', 'warna_sekunder', 'warna_gelap',
        ])->delete();
    }
};
