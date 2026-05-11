<?php

namespace Database\Seeders;

use App\Models\Halaman;
use Illuminate\Database\Seeder;

class BiayaHalamanSeeder extends Seeder
{
    public function run(): void
    {
        $konten = <<<'HTML'
<div class="row g-4 mb-5">
  <div class="col-md-4">
    <div class="card border-0 shadow-sm rounded-4 h-100" style="border-top:4px solid #C0304A !important;">
      <div class="card-body text-center p-4">
        <div style="width:56px;height:56px;border-radius:14px;background:#fff5f7;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:1.4rem;color:#C0304A;"><i class="bi bi-cash-coin"></i></div>
        <div style="font-size:1.6rem;font-weight:800;color:#1a1a2e;">Rp 79.250.000</div>
        <div style="font-size:.8rem;color:#888;text-transform:uppercase;letter-spacing:.5px;font-weight:500;">Total Investasi Pendidikan</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm rounded-4 h-100" style="border-top:4px solid #C0304A !important;">
      <div class="card-body text-center p-4">
        <div style="width:56px;height:56px;border-radius:14px;background:#fff5f7;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:1.4rem;color:#C0304A;"><i class="bi bi-calendar3"></i></div>
        <div style="font-size:1.6rem;font-weight:800;color:#1a1a2e;">6 Semester</div>
        <div style="font-size:.8rem;color:#888;text-transform:uppercase;letter-spacing:.5px;font-weight:500;">Durasi Program (3 Tahun)</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm rounded-4 h-100" style="border-top:4px solid #C0304A !important;">
      <div class="card-body text-center p-4">
        <div style="width:56px;height:56px;border-radius:14px;background:#fff5f7;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:1.4rem;color:#C0304A;"><i class="bi bi-graph-down-arrow"></i></div>
        <div style="font-size:1.6rem;font-weight:800;color:#1a1a2e;">Rp 13.208.333</div>
        <div style="font-size:.8rem;color:#888;text-transform:uppercase;letter-spacing:.5px;font-weight:500;">Rata-rata Biaya per Semester</div>
      </div>
    </div>
  </div>
</div>

<h4 class="fw-bold mb-3" style="color:#1a1a2e;font-size:1.3rem;">Estimasi Biaya Per Semester</h4>
<div class="table-responsive mb-2">
  <table class="table table-hover align-middle mb-0" style="border-radius:14px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.07);">
    <thead style="background:linear-gradient(120deg,#6D1020,#9B2038 40%,#C0304A);color:white;">
      <tr>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;font-weight:700;">#</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;font-weight:700;">Semester &amp; Kegiatan</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;font-weight:700;text-align:right;">Biaya Kuliah</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;font-weight:700;text-align:right;">Biaya Disertasi</th>
        <th style="padding:14px 16px;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;border:none;font-weight:700;text-align:right;">Total / Sem</th>
      </tr>
    </thead>
    <tbody style="background:white;">
      <tr style="border-bottom:1px solid #f5f5f5;">
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">1</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 1 <span style="background:#fff0f3;color:#8B1A2E;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun I</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Perkuliahan &amp; Orientasi</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 10.000.000</td>
        <td style="padding:14px 16px;text-align:right;color:#bbb;font-style:italic;">—</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 10.000.000</td>
      </tr>
      <tr style="border-bottom:1px solid #f5f5f5;">
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">2</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 2 <span style="background:#fff0f3;color:#8B1A2E;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun I</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Perkuliahan &amp; Seminar Proposal</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 10.000.000</td>
        <td style="padding:14px 16px;text-align:right;color:#555;font-size:.9rem;">Rp 3.400.000</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 13.400.000</td>
      </tr>
      <tr style="border-bottom:1px solid #f5f5f5;">
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">3</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 3 <span style="background:#fff5f7;color:#A0263C;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun II</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Penulisan Disertasi Tahap I</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 9.000.000</td>
        <td style="padding:14px 16px;text-align:right;color:#555;font-size:.9rem;">Rp 4.400.000</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 13.400.000</td>
      </tr>
      <tr style="border-bottom:1px solid #f5f5f5;">
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">4</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 4 <span style="background:#fff5f7;color:#A0263C;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun II</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Penulisan Disertasi Tahap II</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 9.000.000</td>
        <td style="padding:14px 16px;text-align:right;color:#555;font-size:.9rem;">Rp 5.000.000</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 14.000.000</td>
      </tr>
      <tr style="border-bottom:1px solid #f5f5f5;">
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">5</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 5 <span style="background:#fffbfb;color:#C0304A;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun III</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Ujian Kelayakan &amp; Revisi</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 8.500.000</td>
        <td style="padding:14px 16px;text-align:right;color:#555;font-size:.9rem;">Rp 5.000.000</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 13.500.000</td>
      </tr>
      <tr>
        <td style="padding:14px 16px;"><span style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);color:white;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;">6</span></td>
        <td style="padding:14px 16px;"><div style="font-weight:600;font-size:.9rem;color:#1a1a2e;">Semester 6 <span style="background:#fffbfb;color:#C0304A;border-radius:20px;padding:2px 10px;font-size:.68rem;font-weight:700;text-transform:uppercase;margin-left:6px;">Tahun III</span></div><div style="font-size:.8rem;color:#888;margin-top:2px;">Ujian Promosi Doktor</div></td>
        <td style="padding:14px 16px;text-align:right;font-weight:600;font-size:.9rem;color:#1a1a2e;">Rp 8.500.000</td>
        <td style="padding:14px 16px;text-align:right;color:#555;font-size:.9rem;">Rp 6.450.000</td>
        <td style="padding:14px 16px;text-align:right;font-weight:700;color:#C0304A;">Rp 14.950.000</td>
      </tr>
    </tbody>
    <tfoot>
      <tr style="background:linear-gradient(135deg,#fff5f7,#ffecf0);border-top:2px solid #f5c0cc;">
        <td colspan="2" style="padding:16px;font-weight:700;color:#1a1a2e;"><i class="bi bi-calculator me-2" style="color:#C0304A;"></i>Total Keseluruhan</td>
        <td style="padding:16px;text-align:right;font-weight:700;color:#1a1a2e;">Rp 55.000.000</td>
        <td style="padding:16px;text-align:right;font-weight:700;color:#1a1a2e;">Rp 24.250.000</td>
        <td style="padding:16px;text-align:right;font-weight:900;font-size:1.05rem;color:#C0304A;">Rp 79.250.000</td>
      </tr>
    </tfoot>
  </table>
</div>
<p class="text-muted mb-5" style="font-size:.78rem;"><i class="bi bi-info-circle me-1"></i>Biaya di atas bersifat <strong>estimasi</strong> dan dapat berubah sewaktu-waktu. Konfirmasi biaya resmi dapat diperoleh melalui bagian keuangan atau Tata Usaha Fakultas.</p>

<hr class="my-5" style="border-color:#f0e0e4;">

<h4 class="fw-bold mb-4" style="color:#1a1a2e;font-size:1.3rem;">Informasi Pembayaran</h4>
<div class="row g-4 mb-5">
  <div class="col-md-4">
    <div style="background:white;border-radius:14px;padding:24px;box-shadow:0 3px 18px rgba(0,0,0,.06);height:100%;">
      <h6 style="font-size:.9rem;font-weight:700;color:#1a1a2e;margin-bottom:14px;"><i class="bi bi-check2-circle" style="color:#C0304A;margin-right:6px;"></i>Yang Termasuk Biaya</h6>
      <ul style="list-style:none;padding:0;margin:0;">
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya SKS / perkuliahan per semester</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya bimbingan akademik &amp; promotor</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya seminar proposal disertasi</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya ujian kelayakan disertasi</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya ujian promosi doktor</li>
      </ul>
    </div>
  </div>
  <div class="col-md-4">
    <div style="background:white;border-radius:14px;padding:24px;box-shadow:0 3px 18px rgba(0,0,0,.06);height:100%;">
      <h6 style="font-size:.9rem;font-weight:700;color:#1a1a2e;margin-bottom:14px;"><i class="bi bi-bank" style="color:#C0304A;margin-right:6px;"></i>Metode Pembayaran</h6>
      <ul style="list-style:none;padding:0;margin:0;">
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Transfer bank sesuai tagihan sistem akademik</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Pembayaran per semester sesuai jadwal</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Bukti transfer dikonfirmasi ke keuangan</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Kemungkinan cicilan (konfirmasi ke TU)</li>
      </ul>
    </div>
  </div>
  <div class="col-md-4">
    <div style="background:white;border-radius:14px;padding:24px;box-shadow:0 3px 18px rgba(0,0,0,.06);height:100%;">
      <h6 style="font-size:.9rem;font-weight:700;color:#1a1a2e;margin-bottom:14px;"><i class="bi bi-lightbulb" style="color:#C0304A;margin-right:6px;"></i>Catatan Penting</h6>
      <ul style="list-style:none;padding:0;margin:0;">
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya disertasi mulai dikenakan semester 2</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Penerima beasiswa: konfirmasi subsidi ke prodi</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;border-bottom:1px solid #f8f8f8;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Biaya dapat berubah per kebijakan universitas</li>
        <li style="font-size:.83rem;color:#555;padding:5px 0;display:flex;align-items:flex-start;gap:8px;"><i class="bi bi-dot" style="color:#C0304A;flex-shrink:0;margin-top:2px;"></i>Tidak termasuk biaya hidup &amp; buku teks</li>
      </ul>
    </div>
  </div>
</div>
HTML;

        Halaman::updateOrCreate(
            ['slug' => 'biaya-pendidikan'],
            [
                'judul'          => 'Biaya Pendidikan',
                'slug'           => 'biaya-pendidikan',
                'konten'         => $konten,
                'meta_deskripsi' => 'Informasi estimasi biaya pendidikan Program Studi Manajemen Program Doktor FEB UNTAG Semarang per semester.',
                'is_published'   => true,
                'urutan'         => 10,
            ]
        );

        $this->command->info('✅ Halaman Biaya Pendidikan berhasil dibuat/diperbarui.');
    }
}
