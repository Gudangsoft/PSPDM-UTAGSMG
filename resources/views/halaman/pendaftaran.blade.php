@extends('layouts.app')
@section('title', 'Pendaftaran Mahasiswa Baru - ' . ($site['singkatan']?->value ?? 'PSMPD'))
@section('og_title', 'Pendaftaran Mahasiswa Baru - Program Doktor Manajemen FEB UNTAG Semarang')
@section('og_description', 'Daftar sekarang untuk Program Doktor Manajemen (S3) FEB UNTAG Semarang. Persyaratan lengkap, biaya, dan alur pendaftaran Gelombang I TA 2025/2026.')

@section('styles')
<style>
/* ── Hero ── */
.pmb-hero {
    background: linear-gradient(135deg, #8B0000 0%, #b91c1c 50%, #c2410c 100%);
    padding: 70px 0 50px;
    position: relative;
    overflow: hidden;
}
.pmb-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.pmb-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.4);
    color: #fff;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 16px;
}
.pmb-hero h1 {
    color: #fff;
    font-size: clamp(1.9rem, 4vw, 2.8rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 12px;
}
.pmb-hero p.lead {
    color: rgba(255,255,255,.85);
    font-size: 1.05rem;
    max-width: 560px;
}
.breadcrumb-hero .breadcrumb-item,
.breadcrumb-hero .breadcrumb-item a {
    color: rgba(255,255,255,.7);
    font-size: .85rem;
}
.breadcrumb-hero .breadcrumb-item.active { color: #fff; }
.breadcrumb-hero .breadcrumb-item+.breadcrumb-item::before { color: rgba(255,255,255,.5); }

/* ── Stat Cards ── */
.stat-cards { margin-top: -36px; position: relative; z-index: 5; }
.stat-card {
    background: #fff;
    border-radius: 14px;
    padding: 22px 18px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(0,0,0,.12);
    border-top: 4px solid #8B0000;
    height: 100%;
    transition: transform .2s;
}
.stat-card:hover { transform: translateY(-4px); }
.stat-card .icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg,#8B0000,#c2410c);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px;
    font-size: 1.3rem; color: #fff;
}
.stat-card .value {
    font-size: 1.35rem;
    font-weight: 800;
    color: #8B0000;
    line-height: 1.1;
}
.stat-card .label {
    font-size: .78rem;
    color: #6b7280;
    margin-top: 4px;
    font-weight: 500;
}

/* ── Section titles ── */
.section-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 6px;
}
.section-subtitle { color: #6b7280; font-size: .95rem; margin-bottom: 36px; }
.section-line {
    width: 48px; height: 4px;
    background: linear-gradient(90deg,#8B0000,#c2410c);
    border-radius: 2px; margin-bottom: 10px;
}

/* ── Persyaratan ── */
.req-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #f0f0f0;
    padding: 18px 20px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    transition: box-shadow .2s, border-color .2s;
    height: 100%;
}
.req-card:hover {
    box-shadow: 0 4px 20px rgba(139,0,0,.1);
    border-color: #fca5a5;
}
.req-num {
    flex-shrink: 0;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg,#8B0000,#c2410c);
    color: #fff;
    font-weight: 800;
    font-size: .85rem;
    display: flex; align-items: center; justify-content: center;
}
.req-body h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 3px; font-size: .92rem; }
.req-body p  { color: #6b7280; font-size: .82rem; margin: 0; line-height: 1.5; }
.req-wajib { font-size: .7rem; font-weight: 700; color: #8B0000; background: #fee2e2; padding: 1px 8px; border-radius: 20px; display: inline-block; margin-top: 4px; }
.req-opsional { font-size: .7rem; font-weight: 700; color: #059669; background: #d1fae5; padding: 1px 8px; border-radius: 20px; display: inline-block; margin-top: 4px; }

/* ── Biaya ── */
.biaya-card {
    background: linear-gradient(135deg,#8B0000 0%,#c2410c 100%);
    border-radius: 20px;
    color: #fff;
    padding: 40px 36px;
    position: relative;
    overflow: hidden;
}
.biaya-card::after {
    content: '💳';
    position: absolute; right: 28px; top: 28px;
    font-size: 4rem; opacity: .12;
}
.biaya-amount {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 900;
    line-height: 1;
    letter-spacing: -.02em;
}
.biaya-label { font-size: .85rem; opacity: .8; margin-top: 4px; }
.bank-detail {
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 12px;
    padding: 20px 24px;
    backdrop-filter: blur(4px);
}
.bank-row { display: flex; gap: 12px; align-items: center; padding: 8px 0; }
.bank-row:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,.15); }
.bank-row .bi { font-size: 1.1rem; opacity: .75; }
.bank-row .key { font-size: .78rem; opacity: .7; min-width: 100px; }
.bank-row .val { font-weight: 700; font-size: .95rem; }
.copy-btn {
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.35);
    color: #fff;
    border-radius: 6px;
    padding: 2px 10px;
    font-size: .72rem;
    cursor: pointer;
    transition: background .2s;
    margin-left: auto;
}
.copy-btn:hover { background: rgba(255,255,255,.35); }

/* ── Alur ── */
.step-list { position: relative; padding-left: 0; list-style: none; }
.step-item {
    display: flex;
    gap: 20px;
    margin-bottom: 28px;
    position: relative;
}
.step-item::before {
    content: '';
    position: absolute;
    left: 22px; top: 52px;
    width: 2px; bottom: -28px;
    background: linear-gradient(180deg,#fca5a5,transparent);
}
.step-item:last-child::before { display: none; }
.step-icon {
    flex-shrink: 0;
    width: 44px; height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg,#8B0000,#c2410c);
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    box-shadow: 0 4px 12px rgba(139,0,0,.3);
}
.step-body h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
.step-body p { color: #6b7280; font-size: .88rem; margin: 0; }

/* ── Kontak ── */
.kontak-card {
    background: #fff;
    border-radius: 14px;
    padding: 28px 24px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    border: 1px solid #f0f0f0;
    height: 100%;
    transition: transform .2s, box-shadow .2s;
}
.kontak-card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(0,0,0,.12); }
.kontak-icon {
    width: 60px; height: 60px;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 1.6rem;
}
.kontak-card h6 { font-weight: 700; color: #374151; margin-bottom: 6px; }
.kontak-card p, .kontak-card a { color: #6b7280; font-size: .9rem; text-decoration: none; }
.kontak-card a:hover { color: #8B0000; }

/* ── CTA ── */
.cta-section {
    background: linear-gradient(135deg,#1a1a2e 0%,#16213e 100%);
    border-radius: 20px;
    padding: 56px 32px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.cta-section::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(139,0,0,.3), transparent 60%),
                radial-gradient(circle at 80% 50%, rgba(194,65,12,.2), transparent 60%);
}
.btn-daftar {
    background: linear-gradient(135deg,#8B0000,#c2410c);
    color: #fff;
    padding: 14px 36px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    border: none;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 8px 24px rgba(139,0,0,.4);
    transition: transform .2s, box-shadow .2s;
}
.btn-daftar:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(139,0,0,.5);
    color: #fff;
}
.btn-wa {
    background: #25D366;
    color: #fff;
    padding: 14px 36px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    border: none;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 8px 24px rgba(37,211,102,.35);
    transition: transform .2s, box-shadow .2s;
}
.btn-wa:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(37,211,102,.5);
    color: #fff;
}

/* ── Accordion persyaratan detail ── */
.req-accordion .accordion-button:not(.collapsed) {
    background: #fee2e2; color: #8B0000;
}
.req-accordion .accordion-button:focus { box-shadow: none; }
</style>
@endsection

@section('content')

{{-- ── HERO ── --}}
<div class="pmb-hero">
    <div class="container-xl position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="pmb-badge"><i class="bi bi-mortarboard-fill me-1"></i> Gelombang I TA 2025/2026</div>
                <h1>Pendaftaran<br>Mahasiswa Baru</h1>
                <p class="lead">Program Doktor Manajemen (S3) FEB UNTAG Semarang — dirancang untuk para profesional dan akademisi yang ingin mencapai puncak karier.</p>
                <nav aria-label="breadcrumb" class="breadcrumb-hero mt-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Pendaftaran</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0" data-aos="fade-left">
                <div style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:28px 24px;display:inline-block;">
                    <div style="color:#fff;font-size:.8rem;opacity:.7;margin-bottom:8px;text-transform:uppercase;letter-spacing:.1em;">Pendaftaran Dibuka</div>
                    <div style="color:#fff;font-size:2rem;font-weight:900;">S E K A R A N G</div>
                    <div style="color:rgba(255,255,255,.7);font-size:.85rem;margin-top:6px;">Jangan lewatkan kesempatan ini</div>
                    <a href="https://wa.me/6282319475792?text=Halo%20PSMPD%2C%20saya%20ingin%20mendaftar%20Program%20Doktor%20Manajemen.%20Boleh%20minta%20informasi%20pendaftarannya%3F"
                       target="_blank"
                       class="btn-daftar mt-4 d-inline-flex" style="padding:12px 28px;font-size:.9rem;">
                        <i class="bi bi-send-fill"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── STAT CARDS ── --}}
<div class="container-xl stat-cards">
    <div class="row g-3">
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
            <div class="stat-card">
                <div class="icon"><i class="bi bi-award-fill"></i></div>
                <div class="value">≥ 3,00</div>
                <div class="label">IPK S2 Minimal</div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="80">
            <div class="stat-card">
                <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="value">≥ 500</div>
                <div class="label">Skor TPA Minimal</div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="160">
            <div class="stat-card">
                <div class="icon"><i class="bi bi-translate"></i></div>
                <div class="value">≥ 525</div>
                <div class="label">TOEFL ITP Minimal</div>
            </div>
        </div>
        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="240">
            <div class="stat-card">
                <div class="icon"><i class="bi bi-cash-stack"></i></div>
                <div class="value">Rp 1 Jt</div>
                <div class="label">Biaya Pendaftaran</div>
            </div>
        </div>
    </div>
</div>

{{-- ── PERSYARATAN ── --}}
<section style="padding:80px 0 60px; background:#f8f9fb;">
    <div class="container-xl">
        <div data-aos="fade-up">
            <div class="section-line"></div>
            <h2 class="section-title">Persyaratan Pendaftaran</h2>
            <p class="section-subtitle">14 dokumen wajib yang harus disiapkan sebelum mendaftar.</p>
        </div>

        <div class="row g-3">
            @php
            $persyaratan = [
                ['judul' => 'KTP / Identitas Diri', 'detail' => 'Salinan KTP yang masih berlaku.', 'tipe' => 'wajib', 'icon' => 'bi-person-vcard-fill'],
                ['judul' => 'Ijazah & Transkrip S1', 'detail' => 'Ijazah dan transkrip nilai S1 yang telah dilegalisir oleh perguruan tinggi asal.', 'tipe' => 'wajib', 'icon' => 'bi-file-earmark-text-fill'],
                ['judul' => 'Ijazah & Transkrip S2', 'detail' => 'Ijazah dan transkrip nilai S2 yang telah dilegalisir. IPK minimal 3,00 pada skala 0–4,00.', 'tipe' => 'wajib', 'icon' => 'bi-file-earmark-text-fill'],
                ['judul' => 'Sertifikat TPA', 'detail' => 'Skor minimal 500, berlaku maksimal 2 tahun. Dapat diperoleh dari BAPPENAS / OTO Bappenas.', 'tipe' => 'wajib', 'icon' => 'bi-clipboard-data-fill'],
                ['judul' => 'Sertifikat Bahasa Inggris', 'detail' => 'TOEFL ITP minimal 525 atau IELTS minimal 6,0. Sertifikat berlaku maksimal 2 tahun.', 'tipe' => 'wajib', 'icon' => 'bi-translate'],
                ['judul' => '2 Surat Rekomendasi', 'detail' => 'Dari tokoh akademik (dosen/guru besar) atau profesional di bidang terkait.', 'tipe' => 'wajib', 'icon' => 'bi-envelope-paper-fill'],
                ['judul' => 'Surat Jaminan Pembiayaan', 'detail' => 'Surat resmi yang menyatakan sumber dan jaminan pembiayaan studi selama program.', 'tipe' => 'wajib', 'icon' => 'bi-bank2'],
                ['judul' => 'Surat Keterangan Sehat', 'detail' => 'Dari instansi berwenang (rumah sakit/puskesmas), termasuk keterangan bebas narkoba.', 'tipe' => 'wajib', 'icon' => 'bi-heart-pulse-fill'],
                ['judul' => 'Surat Izin Pimpinan', 'detail' => 'Bagi karyawan aktif: surat izin dari pimpinan instansi/perusahaan tempat bekerja.', 'tipe' => 'wajib', 'icon' => 'bi-building-fill-check'],
                ['judul' => 'Pas Foto Berwarna', 'detail' => 'Berlatar biru, ukuran 3×4 dan 4×6 masing-masing 3 lembar.', 'tipe' => 'wajib', 'icon' => 'bi-camera-fill'],
                ['judul' => 'Curriculum Vitae (CV)', 'detail' => 'CV lengkap mencakup riwayat pendidikan, pengalaman kerja, dan prestasi akademik.', 'tipe' => 'wajib', 'icon' => 'bi-journal-richtext'],
                ['judul' => 'Bukti Publikasi Ilmiah', 'detail' => 'Jika ada: jurnal, prosiding seminar, atau karya ilmiah yang pernah dipublikasikan.', 'tipe' => 'opsional', 'icon' => 'bi-journal-bookmark-fill'],
                ['judul' => 'Proposal Disertasi', 'detail' => 'Mencakup topik/judul, latar belakang masalah, tujuan penelitian, dan metodologi yang akan digunakan.', 'tipe' => 'wajib', 'icon' => 'bi-file-earmark-richtext-fill'],
                ['judul' => 'Surat Pernyataan Bermeterai', 'detail' => 'Menyatakan keaslian seluruh dokumen yang diserahkan.', 'tipe' => 'wajib', 'icon' => 'bi-patch-check-fill'],
            ];
            @endphp

            @foreach($persyaratan as $i => $req)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 60 }}">
                <div class="req-card">
                    <div class="req-num">{{ $i + 1 }}</div>
                    <div class="req-body">
                        <h6><i class="bi {{ $req['icon'] }} me-1 text-danger opacity-75"></i> {{ $req['judul'] }}</h6>
                        <p>{{ $req['detail'] }}</p>
                        @if($req['tipe'] === 'opsional')
                            <span class="req-opsional">Jika ada</span>
                        @else
                            <span class="req-wajib">Wajib</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 p-3 rounded-3" style="background:#fff3cd;border:1px solid #ffc107;" data-aos="fade-up">
            <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
            <strong>Catatan:</strong> Seluruh dokumen wajib dilengkapi dengan <strong>surat pernyataan bermeterai</strong> yang menyatakan keaslian dokumen. Dokumen yang tidak lengkap akan mengakibatkan pendaftaran ditolak.
        </div>
    </div>
</section>

{{-- ── BIAYA & ALUR ── --}}
<section style="padding:80px 0; background:#fff;">
    <div class="container-xl">
        <div class="row g-5 align-items-start">

            {{-- Biaya --}}
            <div class="col-lg-6" data-aos="fade-right">
                <div class="section-line"></div>
                <h2 class="section-title">Biaya Pendaftaran</h2>
                <p class="section-subtitle">Transfer ke rekening resmi Fakultas.</p>

                <div class="biaya-card">
                    <div class="biaya-label">Biaya Pendaftaran</div>
                    <div class="biaya-amount">Rp 1.000.000</div>
                    <div class="biaya-label mt-1">Satu Juta Rupiah</div>

                    <div class="bank-detail mt-4">
                        <div class="bank-row">
                            <i class="bi bi-bank2"></i>
                            <span class="key">Bank</span>
                            <span class="val">BTN (Bank Tabungan Negara)</span>
                        </div>
                        <div class="bank-row">
                            <i class="bi bi-credit-card-2-front"></i>
                            <span class="key">No. Rekening</span>
                            <span class="val" id="norek">0057101390000046</span>
                            <button class="copy-btn" onclick="copyRek()"><i class="bi bi-copy"></i> Salin</button>
                        </div>
                        <div class="bank-row">
                            <i class="bi bi-person-fill"></i>
                            <span class="key">Atas Nama</span>
                            <span class="val">FEB UNTAG SEMARANG</span>
                        </div>
                    </div>

                    <div class="mt-3" style="font-size:.82rem;opacity:.8;">
                        <i class="bi bi-info-circle me-1"></i>
                        Simpan bukti transfer dan sertakan saat proses pendaftaran.
                    </div>
                </div>
            </div>

            {{-- Alur --}}
            <div class="col-lg-6" data-aos="fade-left">
                <div class="section-line"></div>
                <h2 class="section-title">Alur Pendaftaran</h2>
                <p class="section-subtitle">Ikuti langkah-langkah berikut untuk mendaftar.</p>

                <ul class="step-list">
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-1-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Siapkan Dokumen</h6>
                            <p>Lengkapi seluruh 14 dokumen persyaratan. Pastikan semua ijazah dan transkrip sudah dilegalisir.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-2-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Bayar Biaya Pendaftaran</h6>
                            <p>Transfer Rp 1.000.000 ke rekening BTN FEB UNTAG Semarang dan simpan bukti transfer.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-3-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Serahkan Berkas</h6>
                            <p>Datang ke sekretariat PSMPD FEB UNTAG Semarang atau kirim via email beserta scan dokumen.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-4-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Seleksi Administrasi</h6>
                            <p>Tim panitia memeriksa kelengkapan dan keabsahan dokumen yang Anda serahkan.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-5-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Wawancara & Pengumuman</h6>
                            <p>Calon yang lolos seleksi administrasi akan mengikuti wawancara. Hasil diumumkan via email dan website.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-icon"><i class="bi bi-check-circle-fill"></i></div>
                        <div class="step-body">
                            <h6>Daftar Ulang & Mulai Studi</h6>
                            <p>Mahasiswa yang diterima melakukan daftar ulang dan siap memulai perjalanan akademik doktoral.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ── KONTAK ── --}}
<section style="padding:80px 0; background:#f8f9fb;">
    <div class="container-xl">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-line mx-auto"></div>
            <h2 class="section-title">Hubungi Sekretariat</h2>
            <p class="section-subtitle">Tim kami siap membantu Anda dalam proses pendaftaran.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="kontak-card">
                    <div class="kontak-icon" style="background:#dcfce7;">
                        <i class="bi bi-whatsapp" style="color:#16a34a;"></i>
                    </div>
                    <h6>WhatsApp / Telepon</h6>
                    <a href="https://wa.me/6282319475792?text=Halo%20PSMPD%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran%20Program%20Doktor%20Manajemen" target="_blank">
                        082319475792
                    </a>
                    <p class="mt-2" style="font-size:.78rem;">Klik untuk chat langsung</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                <div class="kontak-card">
                    <div class="kontak-icon" style="background:#ede9fe;">
                        <i class="bi bi-envelope-fill" style="color:#7c3aed;"></i>
                    </div>
                    <h6>Email</h6>
                    <a href="mailto:psmpd@untag-smg.ac.id">psmpd@untag-smg.ac.id</a>
                    <p class="mt-2" style="font-size:.78rem;">Balasan dalam 1×24 jam</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                <div class="kontak-card">
                    <div class="kontak-icon" style="background:#fee2e2;">
                        <i class="bi bi-geo-alt-fill" style="color:#dc2626;"></i>
                    </div>
                    <h6>Alamat</h6>
                    <p>Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur, Semarang 50233</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                <div class="kontak-card">
                    <div class="kontak-icon" style="background:#fef3c7;">
                        <i class="bi bi-clock-fill" style="color:#d97706;"></i>
                    </div>
                    <h6>Jam Layanan</h6>
                    <p style="font-size:.85rem;">
                        <strong>Senin – Jumat</strong><br>08.00 – 16.00 WIB<br>
                        <strong class="mt-2 d-inline-block">Sabtu</strong><br>08.00 – 12.00 WIB
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA ── --}}
<section style="padding:60px 0 80px; background:#fff;">
    <div class="container-xl">
        <div class="cta-section" data-aos="zoom-in">
            <div class="position-relative">
                <div style="font-size:.78rem;letter-spacing:.15em;text-transform:uppercase;opacity:.6;margin-bottom:12px;">
                    Gelombang I TA 2025/2026 — Pendaftaran Terbuka
                </div>
                <h2 style="font-size:clamp(1.5rem,3vw,2.2rem);font-weight:900;margin-bottom:12px;">Wujudkan Gelar Doktor Anda</h2>
                <p style="color:rgba(255,255,255,.75);max-width:500px;margin:0 auto 32px;font-size:.95rem;">
                    Bergabunglah dengan komunitas akademisi dan profesional terbaik di Program Doktor Manajemen FEB UNTAG Semarang.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="https://wa.me/6282319475792?text=Halo%20PSMPD%2C%20saya%20ingin%20mendaftar%20Program%20Doktor%20Manajemen%20FEB%20UNTAG%20Semarang.%20Mohon%20informasi%20selengkapnya."
                       target="_blank" class="btn-daftar">
                        <i class="bi bi-send-fill"></i> Daftar Sekarang
                    </a>
                    <a href="https://wa.me/6282319475792?text=Halo%20PSMPD%2C%20saya%20ingin%20konsultasi%20tentang%20Program%20Doktor%20Manajemen%20FEB%20UNTAG%20Semarang"
                       target="_blank" class="btn-wa">
                        <i class="bi bi-whatsapp"></i> Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
function copyRek() {
    navigator.clipboard.writeText('0057101390000046').then(function() {
        const btn = document.querySelector('.copy-btn');
        btn.innerHTML = '<i class="bi bi-check2"></i> Tersalin!';
        setTimeout(() => btn.innerHTML = '<i class="bi bi-copy"></i> Salin', 2000);
    });
}
</script>
@endsection
