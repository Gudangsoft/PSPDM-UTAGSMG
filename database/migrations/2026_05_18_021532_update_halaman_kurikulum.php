<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $konten = <<<'HTML'
<h4 class="mb-4 text-center" style="font-weight:700;">Struktur Kurikulum Program Doktor Manajemen</h4>

<div class="row g-4">

  <!-- Semester 1 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 1</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">12 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Filosofi Ilmu dan Epistemologi Manajemen</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Manajemen World View Pancasila</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Transformasi Strategis dan Kelembagaan Organisasi</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Analisis Statistik Lanjutan</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Semester 2 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 2</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">13 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Metodologi Riset Manajemen Lanjutan</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">4 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Publikasi Riset Manajemen</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Mata Kuliah Konsentrasi 1</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Mata Kuliah Konsentrasi 2</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Semester 3 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 3</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">6 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Independen Study / Pra Kualifikasi</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Seminar Proposal</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Semester 4 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 4</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">3 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Seminar Hasil</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">3 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Semester 5 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 5</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">4 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Ujian Tertutup</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">4 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Semester 6 -->
  <div class="col-md-6">
    <div class="card border-0 shadow-sm rounded-4 h-100">
      <div class="card-header d-flex justify-content-between align-items-center" style="background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;border-radius:16px 16px 0 0;padding:16px 20px;">
        <h6 class="mb-0 fw-bold">Semester 6</h6>
        <span class="badge" style="background:rgba(255,255,255,.25);font-size:.78rem;">5 SKS</span>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover mb-0">
          <tbody>
            <tr><td style="font-size:.875rem;padding:12px 20px;">Ujian Terbuka dan Publish Artikel Ilmiah Bereputasi</td><td class="text-center" style="font-size:.8rem;font-weight:700;color:#C0304A;padding:12px;white-space:nowrap;">5 SKS</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Mata Kuliah Konsentrasi -->
<h5 class="mt-5 mb-3 fw-bold">Mata Kuliah Konsentrasi</h5>
<div class="table-responsive mb-4">
  <table class="table table-bordered align-middle" style="border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.06);">
    <thead style="background:linear-gradient(120deg,#6D1020,#9B2038 40%,#C0304A);color:white;">
      <tr>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;width:40px;">No</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;">Konsentrasi</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;">Nama Mata Kuliah</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;text-align:center;">SKS</th>
      </tr>
    </thead>
    <tbody style="background:white;">
      <tr>
        <td rowspan="2" class="text-center fw-bold" style="color:#C0304A;">1</td>
        <td rowspan="2" style="font-size:.875rem;">Manajemen Human Capital Strategis</td>
        <td style="font-size:.875rem;">Kepemimpinan Strategis dan Perubahan Kelembagaan</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
      <tr>
        <td style="font-size:.875rem;">Talent Management dan Organizational Learning</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
      <tr style="background:#fafafa;">
        <td rowspan="2" class="text-center fw-bold" style="color:#C0304A;">2</td>
        <td rowspan="2" style="font-size:.875rem;">Manajemen Ekosistem Pasar Inovatif</td>
        <td style="font-size:.875rem;">Digital Market Strategy dan Business Ecosystem Innovation</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
      <tr style="background:#fafafa;">
        <td style="font-size:.875rem;">Consumer Behavior dan Competitive Market Dynamics</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
      <tr>
        <td rowspan="2" class="text-center fw-bold" style="color:#C0304A;">3</td>
        <td rowspan="2" style="font-size:.875rem;">Manajemen Keuangan Etis &amp; Pengembangan Berkelanjutan</td>
        <td style="font-size:.875rem;">ESG dan Impact Investment</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
      <tr>
        <td style="font-size:.875rem;">Manajemen Keuangan Strategis untuk Transformasi Berkelanjutan</td>
        <td class="text-center fw-bold" style="color:#C0304A;">3</td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Rekapitulasi -->
<h5 class="mt-4 mb-3 fw-bold">Rekapitulasi SKS</h5>
<div class="row">
  <div class="col-md-5">
    <div class="table-responsive">
      <table class="table table-bordered" style="border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.06);">
        <thead style="background:linear-gradient(120deg,#6D1020,#C0304A);color:white;">
          <tr>
            <th style="padding:12px 16px;border:none;">Semester</th>
            <th style="padding:12px 16px;border:none;text-align:center;">SKS</th>
          </tr>
        </thead>
        <tbody style="background:white;">
          <tr><td style="font-size:.875rem;padding:10px 16px;">Semester 1</td><td class="text-center fw-bold" style="color:#C0304A;">12</td></tr>
          <tr style="background:#fafafa;"><td style="font-size:.875rem;padding:10px 16px;">Semester 2</td><td class="text-center fw-bold" style="color:#C0304A;">13</td></tr>
          <tr><td style="font-size:.875rem;padding:10px 16px;">Semester 3</td><td class="text-center fw-bold" style="color:#C0304A;">6</td></tr>
          <tr style="background:#fafafa;"><td style="font-size:.875rem;padding:10px 16px;">Semester 4</td><td class="text-center fw-bold" style="color:#C0304A;">3</td></tr>
          <tr><td style="font-size:.875rem;padding:10px 16px;">Semester 5</td><td class="text-center fw-bold" style="color:#C0304A;">4</td></tr>
          <tr style="background:#fafafa;"><td style="font-size:.875rem;padding:10px 16px;">Semester 6</td><td class="text-center fw-bold" style="color:#C0304A;">5</td></tr>
          <tr style="background:linear-gradient(135deg,#fff5f7,#ffecf0);border-top:2px solid #f5c0cc;">
            <td style="font-size:.875rem;padding:12px 16px;font-weight:700;">Jumlah</td>
            <td class="text-center" style="font-size:1.1rem;font-weight:900;color:#C0304A;">43</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="alert mt-3" style="background:#fff5f5;border:1px solid #ffcccc;border-radius:12px;">
  <i class="bi bi-info-circle-fill text-danger me-2"></i>
  <strong>Total: 43 SKS</strong> &bull; Durasi normal: 6 semester (3 tahun) &bull; Maksimal: 10 semester
</div>
HTML;

        DB::table('halaman')
            ->where('slug', 'akademik-kurikulum')
            ->update(['konten' => $konten, 'updated_at' => now()]);
    }

    public function down(): void
    {
        // No rollback needed — original content preserved in prior migration
    }
};
