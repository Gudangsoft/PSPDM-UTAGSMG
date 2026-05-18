<?php
// One-time script: seed dosen table — DELETE after use
require dirname(__DIR__) . '/vendor/autoload.php';
$app = require dirname(__DIR__) . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$dosen = [
    ['nama' => 'Prof. Dr. Emiliana Sri Pudjiarti, MSi',           'jabatan' => 'Guru Besar', 'urutan' => 1],
    ['nama' => 'Prof. Dr. Honorata Ratnawati Dwi Putranti, MM',   'jabatan' => 'Guru Besar', 'urutan' => 2],
    ['nama' => 'Prof. Dr. Suparjo, MP',                            'jabatan' => 'Guru Besar', 'urutan' => 3],
    ['nama' => 'Prof. Dr. Gita Sugiyarti, MSi',                   'jabatan' => 'Guru Besar', 'urutan' => 4],
    ['nama' => 'Prof. Dr. Hikmah, MS',                             'jabatan' => 'Guru Besar', 'urutan' => 5],
    ['nama' => 'Dr. Sulistiyani, MM',                              'jabatan' => 'Dosen',      'urutan' => 6],
    ['nama' => 'Dr. Nurchayati, MSi',                              'jabatan' => 'Dosen',      'urutan' => 7],
    ['nama' => 'Dr. Tri Widayati, MS',                             'jabatan' => 'Dosen',      'urutan' => 8],
    ['nama' => 'Prof. Dr. Retno Mawarini, SH, MHum',              'jabatan' => 'Guru Besar', 'urutan' => 9],
    ['nama' => 'Prof. Dr. Suparno, MS',                            'jabatan' => 'Guru Besar', 'urutan' => 10],
    ['nama' => 'Prof. Dr. Widodo, MSi',                            'jabatan' => 'Guru Besar', 'urutan' => 11],
    ['nama' => 'Prof. Dr. Tri Purwaningsih, MM',                   'jabatan' => 'Guru Besar', 'urutan' => 12],
    ['nama' => 'Dr. Nuryakin, MS',                                 'jabatan' => 'Dosen',      'urutan' => 13],
    ['nama' => 'Dr. Antonius Denny Firmanto, MPd MFil',           'jabatan' => 'Dosen',      'urutan' => 14],
    ['nama' => 'Dr. Eko Suseno, MM',                               'jabatan' => 'Dosen',      'urutan' => 15],
];

$now = now();
$inserted = 0;
$skipped  = 0;

foreach ($dosen as $d) {
    $exists = DB::table('dosen')->where('nama', $d['nama'])->exists();
    if ($exists) {
        $skipped++;
        echo "SKIP (already exists): {$d['nama']}<br>";
        continue;
    }
    DB::table('dosen')->insert([
        'nama'       => $d['nama'],
        'jabatan'    => $d['jabatan'],
        'urutan'     => $d['urutan'],
        'is_active'  => true,
        'created_at' => $now,
        'updated_at' => $now,
    ]);
    $inserted++;
    echo "OK: {$d['nama']}<br>";
}

echo "<hr><b>Selesai. Inserted: {$inserted} | Skipped: {$skipped}</b><br>";
echo "<b style='color:red;'>Hapus file ini setelah selesai!</b>";
