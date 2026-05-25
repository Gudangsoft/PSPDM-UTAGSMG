<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $judul = 'Jadwal Akademik Program Doktor Manajemen Tahun Akademik 2026/2027';

        if (DB::table('pengumuman')->where('judul', $judul)->exists()) return;

        $konten = '
<h4 style="color:#C0304A; margin-bottom:6px;">JADWAL AKADEMIK PROGRAM DOKTOR</h4>
<p style="margin-bottom:24px; color:#666;">
    <strong>Tahun Akademik 2026/2027</strong> &nbsp;|&nbsp;
    Semester Gasal (Sept. 2026 – Feb. 2027) &nbsp;|&nbsp; Semester Genap (Maret – Agust. 2027)
</p>

<h5 style="background:#C0304A; color:white; padding:10px 16px; border-radius:8px 8px 0 0; margin-bottom:0;">
    SEMESTER GASAL 2026/2027
</h5>
<table style="width:100%; border-collapse:collapse; margin-bottom:28px;">
    <thead>
        <tr style="background:#f8f9fa;">
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:40px; text-align:center;">No</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:200px;">Periode</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px;">Kegiatan Akademik</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:130px; text-align:center;">Jenis Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">1</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Mei – Agustus 2026</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Penerimaan Mahasiswa Baru</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Administrasi</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">2</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Juli – Agustus 2026</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Registrasi administrasi dan akademik</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Administrasi</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">3</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">15 Sep 2026</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Kuliah perdana</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Perkuliahan</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">4</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">15 Sep 2026 – 15 Jan 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Perkuliahan reguler</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Perkuliahan</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">5</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">16 – 20 Nov 2026</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian Tengah Semester (UTS)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">6</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">22 – 26 Februari 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian Akhir Semester (UAS)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">7</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">10 – 17 Maret 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian kualifikasi (jadwal menyesuaikan)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Sidang</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">8</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">15 Maret 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Yudisium Semester Gasal</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
    </tbody>
</table>

<h5 style="background:#C0304A; color:white; padding:10px 16px; border-radius:8px 8px 0 0; margin-bottom:0;">
    SEMESTER GENAP 2026/2027
</h5>
<table style="width:100%; border-collapse:collapse; margin-bottom:16px;">
    <thead>
        <tr style="background:#f8f9fa;">
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:40px; text-align:center;">No</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:200px;">Periode</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px;">Kegiatan Akademik</th>
            <th style="border:1px solid #dee2e6; padding:9px 12px; width:130px; text-align:center;">Jenis Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">1</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Oktober 2026 – Feb 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Penerimaan Mahasiswa Baru</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Administrasi</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">2</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Jan – Feb 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Registrasi administrasi dan akademik</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Administrasi</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">3</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">15 Maret 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Kuliah perdana</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Perkuliahan</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">4</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">15 Maret 2027 s/d 15 Juli 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Perkuliahan reguler</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Perkuliahan</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">5</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">16 – 20 Mei 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian Tengah Semester (UTS)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">6</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">22 – 26 Juli 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian Akhir Semester (UAS)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
        <tr>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">7</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">10 – 17 Agustus 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Ujian kualifikasi (jadwal menyesuaikan)</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Sidang</td>
        </tr>
        <tr style="background:#fafafa;">
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">8</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">20 Agustus 2027</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px;">Yudisium Semester Genap</td>
            <td style="border:1px solid #dee2e6; padding:9px 12px; text-align:center;">Evaluasi</td>
        </tr>
    </tbody>
</table>
';

        DB::table('pengumuman')->insert([
            'judul'           => $judul,
            'konten'          => trim($konten),
            'file_lampiran'   => null,
            'tanggal_mulai'   => '2026-05-01',
            'tanggal_selesai' => '2027-08-31',
            'is_active'       => true,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('pengumuman')
            ->where('judul', 'Jadwal Akademik Program Doktor Manajemen Tahun Akademik 2026/2027')
            ->delete();
    }
};
