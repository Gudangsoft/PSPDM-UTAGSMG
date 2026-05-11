@extends('layouts.app')
@section('title', 'Biaya Pendidikan - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')

@php
/* ── Data biaya per semester ─────────────────────────────────────────────
   Sesuaikan nilai di sini sesuai kebijakan program studi.
   kuliah   : biaya SKS / UKT per semester
   disertasi: biaya bimbingan / ujian disertasi (0 = belum ada)
*/
$semesters = [
    1 => ['kuliah' => 10_000_000, 'disertasi' =>        0, 'keterangan' => 'Perkuliahan & Orientasi'],
    2 => ['kuliah' => 10_000_000, 'disertasi' =>  3_400_000, 'keterangan' => 'Perkuliahan & Seminar Proposal'],
    3 => ['kuliah' =>  9_000_000, 'disertasi' =>  4_400_000, 'keterangan' => 'Penulisan Disertasi Tahap I'],
    4 => ['kuliah' =>  9_000_000, 'disertasi' =>  5_000_000, 'keterangan' => 'Penulisan Disertasi Tahap II'],
    5 => ['kuliah' =>  8_500_000, 'disertasi' =>  5_000_000, 'keterangan' => 'Ujian Kelayakan & Revisi'],
    6 => ['kuliah' =>  8_500_000, 'disertasi' =>  6_450_000, 'keterangan' => 'Ujian Promosi Doktor'],
];

$totalKuliah    = collect($semesters)->sum('kuliah');
$totalDisertasi = collect($semesters)->sum('disertasi');
$grandTotal     = $totalKuliah + $totalDisertasi;
$rataRata       = round($grandTotal / count($semesters));
$maxSemTotal    = collect($semesters)->map(fn($s) => $s['kuliah'] + $s['disertasi'])->max();

$fase = [
    1 => ['label' => 'Tahun I',  'color' => '#8B1A2E', 'bg' => '#fff0f3'],
    2 => ['label' => 'Tahun I',  'color' => '#8B1A2E', 'bg' => '#fff0f3'],
    3 => ['label' => 'Tahun II', 'color' => '#A0263C', 'bg' => '#fff5f7'],
    4 => ['label' => 'Tahun II', 'color' => '#A0263C', 'bg' => '#fff5f7'],
    5 => ['label' => 'Tahun III','color' => '#C0304A', 'bg' => '#fffbfb'],
    6 => ['label' => 'Tahun III','color' => '#C0304A', 'bg' => '#fffbfb'],
];

$singkatan = $site['singkatan']?->value ?? 'PSMPD';
$namaProdi = $site['nama_prodi']?->value ?? 'Program Studi Manajemen Program Doktor';

$rupiah = fn(int $n): string => 'Rp ' . number_format($n, 0, ',', '.');
@endphp

@section('styles')
<style>
/* ===== HERO ===== */
.biaya-hero { padding: 64px 0 50px; }

/* ===== OVERVIEW CARDS ===== */
.overview-card {
    background: white; border-radius: 18px;
    padding: 28px 24px; text-align: center;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    border-top: 4px solid transparent;
    border-image: linear-gradient(to right, #8B1A2E, #C0304A, #F09AAA) 1;
    transition: transform 0.25s, box-shadow 0.25s;
    height: 100%;
}
.overview-card:hover { transform: translateY(-5px); box-shadow: 0 12px 36px rgba(0,0,0,0.11); }
.overview-card .oc-icon {
    width: 60px; height: 60px; border-radius: 16px; margin: 0 auto 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; background: #fff5f7; color: var(--red-primary);
}
.overview-card .oc-value {
    font-size: 1.65rem; font-weight: 800; color: var(--dark);
    line-height: 1.1; margin-bottom: 6px; font-family: 'Inter', sans-serif;
}
.overview-card .oc-label { font-size: 0.82rem; color: #888; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }

/* ===== SEMESTER TABLE ===== */
.biaya-table-wrap { background: white; border-radius: 20px; box-shadow: 0 4px 28px rgba(0,0,0,0.07); overflow: hidden; }
.biaya-table-head {
    background: linear-gradient(120deg, #6D1020, #9B2038 40%, #C0304A 80%, #CC3F58 100%);
    color: white; padding: 18px 28px;
    display: grid; grid-template-columns: 40px 1fr 150px 150px 150px 130px;
    gap: 12px; align-items: center;
    font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
}
.biaya-row {
    display: grid; grid-template-columns: 40px 1fr 150px 150px 150px 130px;
    gap: 12px; align-items: center;
    padding: 18px 28px; border-bottom: 1px solid #f5f5f5;
    transition: background 0.2s;
}
.biaya-row:last-child { border-bottom: none; }
.biaya-row:hover { background: #fffbfb; }
.sem-badge {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #C0304A, #8B1A2E);
    color: white; font-weight: 800; font-size: 0.8rem;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.fase-chip {
    display: inline-block; padding: 2px 10px; border-radius: 20px;
    font-size: 0.68rem; font-weight: 700; margin-left: 8px;
    text-transform: uppercase; letter-spacing: 0.3px;
}
.sem-keterangan { font-size: 0.8rem; color: #888; }
.biaya-amount { font-size: 0.9rem; font-weight: 600; color: var(--dark); }
.biaya-disertasi { font-size: 0.9rem; color: #555; }
.biaya-disertasi.none { color: #bbb; font-style: italic; }
.biaya-total-sem {
    font-size: 0.95rem; font-weight: 700; color: var(--red-primary);
    text-align: right;
}
.biaya-bar-wrap { height: 6px; background: #f0f0f0; border-radius: 3px; margin-top: 4px; }
.biaya-bar { height: 100%; border-radius: 3px; background: linear-gradient(to right, #C0304A, #8B1A2E); }

/* Total row */
.biaya-total-row {
    display: grid; grid-template-columns: 40px 1fr 150px 150px 150px 130px;
    gap: 12px; align-items: center;
    padding: 20px 28px;
    background: linear-gradient(135deg, #fff5f7 0%, #ffecf0 100%);
    border-top: 2px solid #f5c0cc;
}
.biaya-total-row .grand-total {
    font-size: 1.15rem; font-weight: 900; color: var(--red-primary); text-align: right;
}
.biaya-total-row .total-label { font-weight: 700; font-size: 0.9rem; color: var(--dark); }

/* ===== INFO CARDS ===== */
.info-card {
    background: white; border-radius: 14px; padding: 24px;
    box-shadow: 0 3px 18px rgba(0,0,0,0.06); height: 100%;
}
.info-card h6 { font-size: 0.9rem; font-weight: 700; color: var(--dark); margin-bottom: 14px; }
.info-card ul { list-style: none; padding: 0; margin: 0; }
.info-card ul li {
    font-size: 0.83rem; color: #555; padding: 5px 0; border-bottom: 1px solid #f8f8f8;
    display: flex; align-items: flex-start; gap: 8px;
}
.info-card ul li:last-child { border-bottom: none; }
.info-card ul li i { color: var(--red-primary); flex-shrink: 0; margin-top: 2px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .biaya-table-head,
    .biaya-row,
    .biaya-total-row {
        grid-template-columns: 1fr;
        gap: 6px;
    }
    .biaya-table-head { display: none; }
    .biaya-row { padding: 16px 20px; }
    .biaya-row > *:first-child { display: none; }
    .biaya-total-row > *:first-child,
    .biaya-total-row > *:nth-child(3),
    .biaya-total-row > *:nth-child(4),
    .biaya-total-row > *:nth-child(5) { display: none; }
    .biaya-amount, .biaya-disertasi, .biaya-total-sem { text-align: left; }
    .biaya-total-sem::before { content: 'Total/Sem: '; font-size:.75rem; color:#888; font-weight:400; }
    .overview-card .oc-value { font-size: 1.35rem; }
}
@media (max-width: 575px) {
    .overview-card { padding: 20px 16px; }
}
</style>
@endsection

@section('content')

{{-- PAGE HERO --}}
<div class="page-hero biaya-hero">
    <div class="container-xl">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:52px;height:52px;background:rgba(255,255,255,0.18);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                💰
            </div>
            <div>
                <h1 class="mb-0" style="font-size:1.85rem;">Biaya Pendidikan</h1>
                <p class="mb-0 mt-1" style="opacity:.85;font-size:.88rem;">{{ $namaProdi }} – FEB UNTAG Semarang</p>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Biaya Pendidikan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- OVERVIEW CARDS --}}
<section style="background:#f8f9fa; padding:50px 0 40px;">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="overview-card">
                    <div class="oc-icon"><i class="bi bi-cash-coin"></i></div>
                    <div class="oc-value">{{ $rupiah($grandTotal) }}</div>
                    <div class="oc-label">Total Investasi Pendidikan</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="overview-card">
                    <div class="oc-icon"><i class="bi bi-calendar3"></i></div>
                    <div class="oc-value">{{ count($semesters) }} Semester</div>
                    <div class="oc-label">Durasi Program ({{ count($semesters) / 2 }} Tahun)</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="overview-card">
                    <div class="oc-icon"><i class="bi bi-graph-down-arrow"></i></div>
                    <div class="oc-value">{{ $rupiah($rataRata) }}</div>
                    <div class="oc-label">Rata-rata Biaya per Semester</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TABEL BIAYA SEMESTER --}}
<section style="background:#f8f9fa; padding:0 0 60px;">
    <div class="container-xl">
        <div class="section-title text-start mb-4" data-aos="fade-up" style="text-align:left !important;">
            <h2 style="font-size:1.55rem;">Estimasi Biaya Per Semester</h2>
            <p>Rincian investasi pendidikan selama 6 semester program doktor</p>
        </div>

        <div class="biaya-table-wrap" data-aos="fade-up" data-aos-delay="80">
            {{-- Header --}}
            <div class="biaya-table-head">
                <div>#</div>
                <div>Semester & Kegiatan</div>
                <div style="text-align:right;">Biaya Kuliah</div>
                <div style="text-align:right;">Biaya Disertasi</div>
                <div style="text-align:right;">Total / Semester</div>
                <div style="text-align:right;">Proporsi</div>
            </div>

            {{-- Rows --}}
            @foreach($semesters as $sem => $data)
            @php
                $total    = $data['kuliah'] + $data['disertasi'];
                $pct      = $maxSemTotal > 0 ? round($total / $maxSemTotal * 100) : 0;
                $f        = $fase[$sem];
            @endphp
            <div class="biaya-row">
                <div>
                    <div class="sem-badge">{{ $sem }}</div>
                </div>
                <div>
                    <div style="font-weight:600; font-size:.9rem; color:var(--dark); display:flex; align-items:center; flex-wrap:wrap; gap:6px;">
                        Semester {{ $sem }}
                        <span class="fase-chip" style="background:{{ $f['bg'] }}; color:{{ $f['color'] }};">{{ $f['label'] }}</span>
                    </div>
                    <div class="sem-keterangan mt-1">{{ $data['keterangan'] }}</div>
                </div>
                <div class="biaya-amount" style="text-align:right;">
                    {{ $rupiah($data['kuliah']) }}
                </div>
                <div class="{{ $data['disertasi'] > 0 ? 'biaya-disertasi' : 'biaya-disertasi none' }}" style="text-align:right;">
                    {{ $data['disertasi'] > 0 ? $rupiah($data['disertasi']) : '—' }}
                </div>
                <div class="biaya-total-sem">
                    {{ $rupiah($total) }}
                </div>
                <div>
                    <div style="font-size:.72rem; color:#888; text-align:right; margin-bottom:4px;">{{ $pct }}%</div>
                    <div class="biaya-bar-wrap">
                        <div class="biaya-bar" style="width:{{ $pct }}%;"></div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Total row --}}
            <div class="biaya-total-row">
                <div></div>
                <div class="total-label"><i class="bi bi-calculator me-2 text-danger"></i>Total Keseluruhan</div>
                <div style="text-align:right; font-weight:700; font-size:.9rem; color:var(--dark);">{{ $rupiah($totalKuliah) }}</div>
                <div style="text-align:right; font-weight:700; font-size:.9rem; color:var(--dark);">{{ $rupiah($totalDisertasi) }}</div>
                <div class="grand-total">{{ $rupiah($grandTotal) }}</div>
                <div></div>
            </div>
        </div>

        {{-- Catatan kaki tabel --}}
        <p class="text-muted mt-3 mb-0" style="font-size:.78rem;">
            <i class="bi bi-info-circle me-1"></i>
            Biaya di atas bersifat <strong>estimasi</strong> dan dapat berubah sewaktu-waktu. Konfirmasi biaya resmi dapat diperoleh melalui bagian keuangan atau Tata Usaha Fakultas.
        </p>
    </div>
</section>

{{-- INFO TAMBAHAN --}}
<section style="background:white; padding:60px 0;">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Informasi Pembayaran</h2>
            <p>Hal-hal yang perlu diketahui terkait biaya dan mekanisme pembayaran</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="info-card">
                    <h6><i class="bi bi-check2-circle text-danger me-2"></i>Yang Termasuk Biaya</h6>
                    <ul>
                        <li><i class="bi bi-dot"></i>Biaya SKS / perkuliahan per semester</li>
                        <li><i class="bi bi-dot"></i>Biaya bimbingan akademik & promotor</li>
                        <li><i class="bi bi-dot"></i>Biaya seminar proposal disertasi</li>
                        <li><i class="bi bi-dot"></i>Biaya ujian kelayakan disertasi</li>
                        <li><i class="bi bi-dot"></i>Biaya ujian promosi doktor (Semester 6)</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="info-card">
                    <h6><i class="bi bi-bank text-danger me-2"></i>Metode Pembayaran</h6>
                    <ul>
                        <li><i class="bi bi-dot"></i>Transfer bank sesuai tagihan dari sistem akademik</li>
                        <li><i class="bi bi-dot"></i>Pembayaran dilakukan per semester sesuai jadwal</li>
                        <li><i class="bi bi-dot"></i>Bukti transfer dikonfirmasi ke bagian keuangan</li>
                        <li><i class="bi bi-dot"></i>Terdapat kemungkinan cicilan (konfirmasi ke TU)</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <h6><i class="bi bi-lightbulb text-danger me-2"></i>Catatan Penting</h6>
                    <ul>
                        <li><i class="bi bi-dot"></i>Biaya disertasi mulai dikenakan semester 2</li>
                        <li><i class="bi bi-dot"></i>Mahasiswa penerima beasiswa: konfirmasi subsidi ke program studi</li>
                        <li><i class="bi bi-dot"></i>Biaya dapat berubah berdasarkan kebijakan universitas</li>
                        <li><i class="bi bi-dot"></i>Tidak termasuk biaya hidup, akomodasi, dan buku teks</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FASE PENDIDIKAN VISUAL --}}
<section style="background:#f8f9fa; padding:60px 0;">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Fase Studi & Fokus Biaya</h2>
            <p>Program doktor dibagi menjadi 3 tahun dengan fokus berbeda setiap tahunnya</p>
        </div>
        <div class="row g-4">
            @php
            $faseInfo = [
                ['tahun'=>'Tahun I', 'sem'=>'Sem 1 – 2', 'icon'=>'bi-book-half',
                 'judul'=>'Perkuliahan Intensif', 'warna'=>'#8B1A2E',
                 'total'=> $semesters[1]['kuliah']+$semesters[1]['disertasi']+$semesters[2]['kuliah']+$semesters[2]['disertasi'],
                 'deskripsi'=>'Mahasiswa mengikuti mata kuliah inti, metodologi penelitian, dan seminar untuk memperkuat landasan teoritis.'],
                ['tahun'=>'Tahun II', 'sem'=>'Sem 3 – 4', 'icon'=>'bi-pencil-square',
                 'judul'=>'Penulisan Disertasi', 'warna'=>'#A0263C',
                 'total'=> $semesters[3]['kuliah']+$semesters[3]['disertasi']+$semesters[4]['kuliah']+$semesters[4]['disertasi'],
                 'deskripsi'=>'Fokus pada penelitian lapangan, pengumpulan dan analisis data, serta penulisan bab disertasi secara intensif.'],
                ['tahun'=>'Tahun III', 'sem'=>'Sem 5 – 6', 'icon'=>'bi-mortarboard-fill',
                 'judul'=>'Finalisasi & Promosi', 'warna'=>'#C0304A',
                 'total'=> $semesters[5]['kuliah']+$semesters[5]['disertasi']+$semesters[6]['kuliah']+$semesters[6]['disertasi'],
                 'deskripsi'=>'Penyelesaian disertasi, ujian kelayakan, revisi akhir, dan culminasi pada sidang promosi doktor.'],
            ];
            @endphp
            @foreach($faseInfo as $i => $f)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="info-card text-center" style="border-top: 5px solid {{ $f['warna'] }};">
                    <div style="width:64px;height:64px;border-radius:18px;background:linear-gradient(135deg,{{ $f['warna'] }},#8B1A2E);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.6rem;color:white;box-shadow:0 6px 20px rgba(139,26,46,0.3);">
                        <i class="bi {{ $f['icon'] }}"></i>
                    </div>
                    <div style="font-size:.72rem;font-weight:700;color:{{ $f['warna'] }};text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">{{ $f['tahun'] }} &bull; {{ $f['sem'] }}</div>
                    <h5 style="font-size:1rem;font-weight:800;color:var(--dark);margin-bottom:10px;">{{ $f['judul'] }}</h5>
                    <p style="font-size:.82rem;color:#666;line-height:1.65;margin-bottom:16px;">{{ $f['deskripsi'] }}</p>
                    <div style="background:linear-gradient(135deg,{{ $f['warna'] }},#8B1A2E);color:white;padding:10px 16px;border-radius:10px;font-weight:800;font-size:1rem;">
                        {{ $rupiah($f['total']) }}
                    </div>
                    <div style="font-size:.72rem;color:#888;margin-top:6px;">Total investasi {{ $f['tahun'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container-xl position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 style="font-size:2rem; font-weight:700; color:white; margin-bottom:14px;">
                    Siap Berinvestasi untuk Masa Depan?
                </h2>
                <p style="color:rgba(255,255,255,0.88); font-size:1rem; line-height:1.75; max-width:560px; margin:0;">
                    Bergabunglah dengan {{ $singkatan }}-FEB UNTAG Semarang dan raih gelar Doktor Manajemen yang diakui secara nasional maupun internasional. Tim kami siap membantu proses pendaftaran Anda.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end d-flex flex-column flex-lg-column gap-3 align-items-start align-items-lg-end" data-aos="fade-left" data-aos-delay="100">
                <a href="{{ route('akademik') }}" class="btn btn-light btn-lg px-4 rounded-3" style="font-weight:700; color:var(--red-primary);">
                    <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-4 rounded-3" style="font-weight:600;">
                    <i class="bi bi-chat-left-dots me-2"></i>Konsultasi Biaya
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
