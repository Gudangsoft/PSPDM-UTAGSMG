<?php

namespace Database\Seeders;

use App\Models\Halaman;
use Illuminate\Database\Seeder;

class KonsentrasiHalamanSeeder extends Seeder
{
    public function run(): void
    {
        $konten = <<<'HTML'
<div class="text-center mb-5">
  <p class="text-muted mx-auto" style="max-width:620px;font-size:.95rem;line-height:1.8;">Dirancang untuk menghasilkan doktor manajemen yang spesialis dan berkompeten di bidangnya</p>
</div>

<!-- ===== KONSENTRASI 1 ===== -->
<div class="row g-5 align-items-center mb-5 pb-5" style="border-bottom:1px solid #e9e9e9;">
  <div class="col-lg-5" data-aos="fade-right">
    <div style="background:linear-gradient(135deg,#C0304A,#8B1A2E);border-radius:20px;padding:50px;color:white;text-align:center;position:relative;overflow:hidden;">
      <div style="font-size:5rem;margin-bottom:20px;line-height:1;"><i class="bi bi-people-fill"></i></div>
      <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:8px;">Manajemen Modal Manusia Strategis</h3>
      <p style="opacity:.85;font-size:.875rem;margin:0;">Human Capital Strategic Management</p>
    </div>
  </div>
  <div class="col-lg-7" data-aos="fade-left">
    <span style="display:inline-block;background:#C0304A;color:white;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:700;margin-bottom:16px;">Konsentrasi 1</span>
    <h3 style="font-size:1.6rem;font-weight:700;color:#1a1a2e;margin-bottom:16px;">Manajemen Modal Manusia Strategis</h3>
    <p class="text-muted" style="line-height:1.8;">Mengkaji pengembangan, pengelolaan, dan optimalisasi sumber daya manusia secara strategis untuk meningkatkan kinerja organisasi dan daya saing institusi di era global.</p>
    <p class="text-muted" style="line-height:1.8;">Konsentrasi ini mempersiapkan mahasiswa untuk menjadi pemimpin SDM yang mampu mengelola modal manusia secara strategis, mengembangkan talenta, dan menciptakan budaya organisasi yang adaptif terhadap perubahan.</p>
    <h6 style="font-weight:700;color:#1a1a2e;margin-top:20px;margin-bottom:12px;">Topik Kajian Utama:</h6>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Manajemen SDM Strategis</span>
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Pengembangan Organisasi</span>
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Kepemimpinan Transformasional</span>
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Manajemen Talenta</span>
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">HR Analytics</span>
      <span style="background:#fff5f5;color:#C0304A;border:1px solid #ffcccc;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Budaya &amp; Perubahan Organisasi</span>
    </div>
  </div>
</div>

<!-- ===== KONSENTRASI 2 ===== -->
<div class="row g-5 align-items-center mb-5 pb-5" style="border-bottom:1px solid #e9e9e9;">
  <div class="col-lg-5 order-lg-2" data-aos="fade-left">
    <div style="background:linear-gradient(135deg,#1a1a2e,#16213e);border-radius:20px;padding:50px;color:white;text-align:center;position:relative;overflow:hidden;">
      <div style="font-size:5rem;margin-bottom:20px;line-height:1;"><i class="bi bi-graph-up-arrow"></i></div>
      <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:8px;">Manajemen Ekosistem Pasar Inovatif</h3>
      <p style="opacity:.85;font-size:.875rem;margin:0;">Innovative Market Ecosystem Management</p>
    </div>
  </div>
  <div class="col-lg-7 order-lg-1" data-aos="fade-right">
    <span style="display:inline-block;background:#1a1a2e;color:white;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:700;margin-bottom:16px;">Konsentrasi 2</span>
    <h3 style="font-size:1.6rem;font-weight:700;color:#1a1a2e;margin-bottom:16px;">Manajemen Ekosistem Pasar Inovatif</h3>
    <p class="text-muted" style="line-height:1.8;">Mempelajari dinamika pasar berbasis teknologi, transformasi bisnis, dan strategi pengelolaan ekosistem pasar yang inovatif, adaptif, dan kompetitif di tingkat nasional maupun internasional.</p>
    <p class="text-muted" style="line-height:1.8;">Mahasiswa akan dipersiapkan untuk memahami dan mengelola ekosistem pasar digital, mengembangkan strategi inovasi bisnis, dan memimpin transformasi organisasi di era industri 4.0.</p>
    <h6 style="font-weight:700;color:#1a1a2e;margin-top:20px;margin-bottom:12px;">Topik Kajian Utama:</h6>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Pemasaran Digital</span>
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Inovasi Bisnis</span>
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Transformasi Digital</span>
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Manajemen Merek Global</span>
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Analitik Pasar</span>
      <span style="background:#f0f4ff;color:#1a1a2e;border:1px solid #c5d0e6;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Strategi Kompetitif</span>
    </div>
  </div>
</div>

<!-- ===== KONSENTRASI 3 ===== -->
<div class="row g-5 align-items-center">
  <div class="col-lg-5" data-aos="fade-right">
    <div style="background:linear-gradient(135deg,#c8a84b,#a0822a);border-radius:20px;padding:50px;color:white;text-align:center;position:relative;overflow:hidden;">
      <div style="font-size:5rem;margin-bottom:20px;line-height:1;"><i class="bi bi-currency-exchange"></i></div>
      <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:8px;">Manajemen Keuangan Etis &amp; Pengembangan Berkelanjutan</h3>
      <p style="opacity:.85;font-size:.875rem;margin:0;">Ethical Finance &amp; Sustainable Development Management</p>
    </div>
  </div>
  <div class="col-lg-7" data-aos="fade-left">
    <span style="display:inline-block;background:#c8a84b;color:white;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:700;margin-bottom:16px;">Konsentrasi 3</span>
    <h3 style="font-size:1.6rem;font-weight:700;color:#1a1a2e;margin-bottom:16px;">Manajemen Keuangan Etis &amp; Pengembangan Berkelanjutan</h3>
    <p class="text-muted" style="line-height:1.8;">Mengintegrasikan prinsip etika, tata kelola keuangan yang bertanggung jawab, dan strategi pengembangan berkelanjutan untuk menciptakan nilai ekonomi yang berdampak sosial dan lingkungan positif.</p>
    <p class="text-muted" style="line-height:1.8;">Konsentrasi ini mempersiapkan pemimpin keuangan yang mampu mengelola aset secara etis, menerapkan prinsip ESG (Environmental, Social, Governance), dan merancang strategi keberlanjutan jangka panjang.</p>
    <h6 style="font-weight:700;color:#1a1a2e;margin-top:20px;margin-bottom:12px;">Topik Kajian Utama:</h6>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Keuangan Berkelanjutan</span>
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">ESG &amp; Green Finance</span>
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Etika Bisnis</span>
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Tata Kelola Perusahaan</span>
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Manajemen Risiko</span>
      <span style="background:#fffbf0;color:#a0822a;border:1px solid #e8d5a0;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">Corporate Governance</span>
    </div>
  </div>
</div>
HTML;

        Halaman::updateOrCreate(
            ['slug' => 'konsentrasi'],
            [
                'judul'          => 'Konsentrasi Program Studi',
                'slug'           => 'konsentrasi',
                'konten'         => $konten,
                'meta_deskripsi' => 'Tiga konsentrasi unggulan Program Studi Manajemen Program Doktor FEB UNTAG Semarang.',
                'is_published'   => true,
                'urutan'         => 11,
            ]
        );

        $this->command->info('✅ Halaman Konsentrasi berhasil dibuat/diperbarui.');
    }
}
