<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $pages = [
            // ── Kurikulum ──────────────────────────────────────────────────
            [
                'slug'           => 'akademik-kurikulum',
                'judul'          => 'Kurikulum',
                'meta_deskripsi' => 'Struktur kurikulum Program Studi Manajemen Program Doktor FEB UNTAG Semarang.',
                'urutan'         => 20,
                'konten'         => <<<'HTML'
<h4 class="mb-4 text-center" style="font-weight:700;">Struktur Kurikulum Program Doktor Manajemen</h4>
<div class="row g-4">

  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 1</h6>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Filsafat Ilmu &amp; Metodologi Penelitian</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Teori Organisasi &amp; Manajemen Lanjutan</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Ekonomi Manajerial &amp; Analisis Bisnis</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 2</h6>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Strategi Bisnis Berbasis Riset</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Seminar Penelitian Manajemen</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Mata Kuliah Konsentrasi I</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#f0f4ff;color:#1a1a2e;">Konsentrasi</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 3</h6>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Mata Kuliah Konsentrasi II</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#f0f4ff;color:#1a1a2e;">Konsentrasi</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Mata Kuliah Konsentrasi III</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#f0f4ff;color:#1a1a2e;">Konsentrasi</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Proposal Disertasi</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">6 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#f0fff4;color:#2c7a4b;">Penelitian</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 4 – 6</h6>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Penelitian &amp; Penulisan Disertasi</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">12 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff8e1;color:#c8a84b;">Disertasi</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Publikasi Ilmiah Internasional</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">3 SKS</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#fff5f5;color:#C0304A;">Wajib</span></td>
            </tr>
            <tr>
              <td style="font-size:.875rem;padding:12px 20px;">Ujian Kualifikasi &amp; Sidang Disertasi</td>
              <td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;">–</td>
              <td><span class="badge rounded-pill" style="font-size:.72rem;background:#f0fff4;color:#2c7a4b;">Evaluasi</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="alert mt-4" style="background:#fff5f5;border:1px solid #ffcccc;border-radius:12px;">
  <i class="bi bi-info-circle-fill text-danger me-2"></i>
  <strong>Total:</strong> 42 SKS &bull; Durasi normal: 6 semester (3 tahun) &bull; Maksimal: 10 semester
</div>
HTML,
            ],

            // ── Syarat Pendaftaran ─────────────────────────────────────────
            [
                'slug'           => 'akademik-syarat-pendaftaran',
                'judul'          => 'Syarat Pendaftaran',
                'meta_deskripsi' => 'Persyaratan dan dokumen pendaftaran Program Studi Manajemen Program Doktor FEB UNTAG Semarang.',
                'urutan'         => 21,
                'konten'         => <<<'HTML'
<div class="row g-4">
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:20px;">
        <h5 class="mb-0 fw-bold"><i class="bi bi-person-check me-2"></i>Persyaratan Akademik</h5>
      </div>
      <div class="card-body p-4">
        <ul class="list-unstyled" style="font-size:.875rem;line-height:1.8;">
          <li class="d-flex gap-2 mb-3"><i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>Memiliki ijazah S2 (Magister) atau yang sederajat dari perguruan tinggi terakreditasi</li>
          <li class="d-flex gap-2 mb-3"><i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>IPK minimal 3.00 (skala 4.00)</li>
          <li class="d-flex gap-2 mb-3"><i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>Latar belakang pendidikan Manajemen/Ekonomi/Bisnis (atau bidang relevan)</li>
          <li class="d-flex gap-2 mb-3"><i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>Memiliki karya tulis ilmiah yang pernah dipublikasikan</li>
          <li class="d-flex gap-2 mb-3"><i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>Menguasai bahasa Inggris (TOEFL ≥ 500 atau IELTS ≥ 5.5)</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-header" style="background:#1a1a2e;color:white;border-radius:16px 16px 0 0;padding:20px;">
        <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2"></i>Dokumen yang Diperlukan</h5>
      </div>
      <div class="card-body p-4">
        <ul class="list-unstyled" style="font-size:.875rem;line-height:1.8;">
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Formulir pendaftaran (online)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Fotokopi ijazah S1 &amp; S2 (dilegalisir)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Transkrip nilai S1 &amp; S2 (dilegalisir)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Sertifikat TOEFL/IELTS (masih berlaku)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Proposal penelitian (±3000 kata)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Curriculum Vitae (CV) terbaru</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Surat rekomendasi (2 orang)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Pas foto 3x4 (2 lembar)</li>
          <li class="d-flex gap-2 mb-2"><i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>Kartu Identitas (KTP/SIM)</li>
        </ul>
      </div>
    </div>
  </div>
</div>
HTML,
            ],

            // ── Jadwal PMB ─────────────────────────────────────────────────
            [
                'slug'           => 'akademik-jadwal-pmb',
                'judul'          => 'Jadwal PMB',
                'meta_deskripsi' => 'Jadwal Penerimaan Mahasiswa Baru Program Studi Manajemen Program Doktor FEB UNTAG Semarang.',
                'urutan'         => 22,
                'konten'         => <<<'HTML'
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
  <div class="card-header" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:20px;">
    <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-event me-2"></i>Jadwal Penerimaan Mahasiswa Baru</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead style="background:#f8f8f8;">
        <tr>
          <th style="padding:16px 20px;">Kegiatan</th>
          <th style="padding:16px 20px;">Periode</th>
          <th style="padding:16px 20px;">Status</th>
        </tr>
      </thead>
      <tbody style="font-size:.875rem;">
        <tr>
          <td style="padding:14px 20px;"><strong>Pendaftaran Online Gelombang I</strong></td>
          <td>Februari – April</td>
          <td><span class="badge bg-success rounded-pill">Buka</span></td>
        </tr>
        <tr>
          <td style="padding:14px 20px;"><strong>Seleksi Administrasi Gel. I</strong></td>
          <td>April</td>
          <td><span class="badge bg-secondary rounded-pill">Proses</span></td>
        </tr>
        <tr>
          <td style="padding:14px 20px;"><strong>Tes Tulis &amp; Wawancara Gel. I</strong></td>
          <td>Mei</td>
          <td><span class="badge bg-secondary rounded-pill">Proses</span></td>
        </tr>
        <tr>
          <td style="padding:14px 20px;"><strong>Pengumuman Gel. I</strong></td>
          <td>Juni</td>
          <td><span class="badge bg-secondary rounded-pill">Belum</span></td>
        </tr>
        <tr>
          <td style="padding:14px 20px;"><strong>Pendaftaran Online Gelombang II</strong></td>
          <td>Juni – Agustus</td>
          <td><span class="badge bg-warning text-dark rounded-pill">Akan Datang</span></td>
        </tr>
        <tr>
          <td style="padding:14px 20px;"><strong>Awal Perkuliahan</strong></td>
          <td>September</td>
          <td><span class="badge bg-secondary rounded-pill">Belum</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="text-center mt-4">
  <a href="/kontak" class="btn btn-primary btn-lg">
    <i class="bi bi-pencil-square me-2"></i>Hubungi untuk Informasi Pendaftaran
  </a>
</div>
HTML,
            ],
        ];

        foreach ($pages as $page) {
            if (! DB::table('halaman')->where('slug', $page['slug'])->exists()) {
                DB::table('halaman')->insert(array_merge($page, [
                    'is_published' => true,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ]));
            }
        }
    }

    public function down(): void
    {
        DB::table('halaman')->whereIn('slug', [
            'akademik-kurikulum',
            'akademik-syarat-pendaftaran',
            'akademik-jadwal-pmb',
        ])->delete();
    }
};
