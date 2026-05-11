@extends('layouts.app')

@section('title', 'Beranda - PSMPD-FEB UNTAG Semarang')

@section('styles')
<style>
/* ===== HERO ===== */
.hero-section {
    background: linear-gradient(135deg, #5C0E1C 0%, #8B1A2E 25%, #C0304A 60%, #D8506A 80%, #F5C0CB 100%);
    min-height: 90vh;
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    padding: 80px 0;
}
.hero-section::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.hero-section .hero-badge {
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);
    color: white; padding: 6px 16px; border-radius: 30px;
    font-size: 0.82rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;
    display: inline-block; margin-bottom: 20px;
}
.hero-section h1 {
    font-size: clamp(1.8rem, 4vw, 3.2rem); font-weight: 700; color: white;
    line-height: 1.25; margin-bottom: 20px; font-family: 'Playfair Display', serif;
}
.hero-section h1 span { color: #FFD700; }
.hero-section p {
    color: rgba(255,255,255,0.88); font-size: 1.05rem; line-height: 1.75; max-width: 560px;
}
.hero-buttons .btn { padding: 13px 30px; font-weight: 600; border-radius: 8px; font-size: 0.95rem; }
.hero-buttons .btn-light { color: var(--red-primary); }
.hero-buttons .btn-outline-light { border-width: 2px; }

.hero-card {
    background: white; border-radius: 16px; padding: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}
.stat-item { text-align: center; padding: 16px; }
.stat-item .number {
    font-size: 2.4rem; font-weight: 800; color: var(--red-primary);
    line-height: 1; font-family: 'Inter', sans-serif;
}
.stat-item .label { font-size: 0.8rem; color: #888; margin-top: 4px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
.hero-card hr { border-color: #f0f0f0; margin: 16px 0; }
.hero-accredit { background: #fff8f8; border-radius: 10px; padding: 14px 18px; }
.hero-accredit .badge-a { background: var(--red-primary); color: white; font-size: 1.5rem; font-weight: 900; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

/* ===== STATS BAR ===== */
.stats-bar {
    background: white; box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 0;
}
.stat-bar-item {
    padding: 28px 24px; text-align: center; border-right: 1px solid #f0f0f0;
    transition: background 0.2s;
}
.stat-bar-item:last-child { border-right: none; }
.stat-bar-item:hover { background: #fff5f5; }
.stat-bar-item .icon { font-size: 2rem; color: var(--red-primary); margin-bottom: 8px; display: block; }
.stat-bar-item .value { font-size: 1.8rem; font-weight: 800; color: var(--dark); line-height: 1; }
.stat-bar-item .desc { font-size: 0.8rem; color: #888; margin-top: 4px; }

/* ===== SECTIONS ===== */
.section-pad { padding: 80px 0; }
.bg-light-red { background: #fff5f5; }
.bg-dark-section { background: var(--dark); }

/* ===== KONSENTRASI ===== */
.konsentrasi-card {
    border: none; border-radius: 16px; overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.konsentrasi-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(192,48,74,0.15); }
.konsentrasi-icon-wrap {
    width: 70px; height: 70px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.8rem; margin-bottom: 20px; flex-shrink: 0;
}
.konsentrasi-card .card-body { padding: 32px; }
.konsentrasi-card h4 { font-size: 1.15rem; color: var(--dark); font-weight: 700; margin-bottom: 12px; }
.konsentrasi-card p { font-size: 0.875rem; color: var(--gray-text); line-height: 1.75; }
.konsentrasi-card .card-number {
    position: absolute; top: -15px; right: 20px;
    font-size: 5rem; font-weight: 900; color: rgba(0,0,0,0.04);
    line-height: 1; user-select: none;
}

/* ===== KEUNGGULAN ===== */
.keunggulan-item { text-align: center; padding: 30px 20px; }
.keunggulan-icon {
    width: 72px; height: 72px; border-radius: 50%;
    background: linear-gradient(135deg, var(--red-primary), var(--red-dark));
    color: white; font-size: 1.6rem;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px; box-shadow: 0 8px 20px rgba(192,48,74,0.3);
}
.keunggulan-item h5 { font-size: 1rem; font-weight: 700; color: white; margin-bottom: 8px; font-family: 'Inter', sans-serif; }
.keunggulan-item p { font-size: 0.82rem; color: rgba(255,255,255,0.75); line-height: 1.65; }

/* ===== PROFIL LULUSAN ===== */
.lulusan-card {
    background: white; border-radius: 14px; padding: 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%;
    border-left: 4px solid var(--red-primary);
    transition: box-shadow 0.3s, transform 0.3s;
}
.lulusan-card:hover { box-shadow: 0 12px 35px rgba(0,0,0,0.1); transform: translateY(-4px); }
.lulusan-number { width: 40px; height: 40px; background: linear-gradient(135deg, #C0304A, #8B1A2E); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem; flex-shrink: 0; }
.lulusan-card h5 { font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; font-family: 'Inter', sans-serif; }
.lulusan-card p { font-size: 0.83rem; color: var(--gray-text); line-height: 1.7; margin: 0; }

/* ===== SAMBUTAN ===== */
.sambutan-home { padding: 80px 0; background: white; }
.sambutan-img-wrap { position: relative; display: inline-block; }
.sambutan-img-wrap img,
.sambutan-img-placeholder {
    width: 260px; height: 320px; border-radius: 20px; display: block;
    object-fit: cover;
    box-shadow: 0 20px 60px rgba(139,0,0,0.2);
}
.sambutan-img-placeholder {
    background: linear-gradient(135deg, var(--red-primary), var(--red-dark));
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    color: white;
}
.sambutan-img-deco {
    position: absolute; bottom: -14px; right: -14px;
    width: 80px; height: 80px; border-radius: 14px;
    background: linear-gradient(135deg, var(--red-primary), var(--red-dark));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.8rem;
    box-shadow: 0 8px 25px rgba(192,48,74,0.35);
}
.sambutan-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff5f5; color: var(--red-primary);
    border: 1px solid rgba(192,48,74,0.15);
    padding: 6px 16px; border-radius: 30px;
    font-size: 0.8rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    margin-bottom: 16px;
}
.sambutan-quote {
    font-size: 1rem; line-height: 1.85; color: #444;
    border-left: 4px solid var(--red-primary);
    padding-left: 20px; margin: 16px 0 24px;
}
.sambutan-divider { width: 48px; height: 4px; background: linear-gradient(to right, #8B1A2E, #C0304A, #F09AAA); border-radius: 2px; flex-shrink: 0; }

/* ===== BERITA ===== */
.news-card { border-radius: 14px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%; }
.news-card img { height: 200px; object-fit: cover; width: 100%; }
.news-card .card-body { padding: 20px; }
.news-card .news-meta { font-size: 0.78rem; color: #888; margin-bottom: 8px; }
.news-card h5 { font-size: 0.95rem; font-weight: 700; line-height: 1.45; color: var(--dark); margin-bottom: 10px; }
.news-card p { font-size: 0.82rem; color: #666; line-height: 1.65; }
.news-card:hover h5 { color: var(--red-primary); }

/* ===== GALERI HOME ===== */
.galeri-item { position: relative; overflow: hidden; border-radius: 12px; cursor: pointer; }
.galeri-item img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.4s; }
.galeri-item:hover img { transform: scale(1.08); }
.galeri-overlay { position: absolute; inset: 0; background: rgba(192,48,74,0.75); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; border-radius: 12px; }
.galeri-item:hover .galeri-overlay { opacity: 1; }
.galeri-overlay i { color: white; font-size: 2rem; }

/* ===== CTA ===== */
.cta-section {
    background: linear-gradient(135deg, #6D1020 0%, #9B2038 30%, #C0304A 60%, #D8506A 85%, #F5C0CB 100%);
    padding: 80px 0; position: relative; overflow: hidden;
}
.cta-section::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, transparent 50%, rgba(255,255,255,0.07) 100%);
}
.cta-section::after {
    content: ''; position: absolute; right: -80px; top: -80px;
    width: 380px; height: 380px; border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 65%);
}
</style>
@endsection

@section('content')

@php
// ── Local helpers (child views don't inherit parent @php scope) ───────────
$s = fn(string $key, string $default = '') => $site[$key]?->value ?? $default;
$singkatan = $s('singkatan', 'PSMPD');

// ── Helper: resolve URL (route name / path / absolute) ──────────────────
$resolveUrl = function(string $raw, string $fallbackRoute) use ($site): string {
    $v = trim($raw);
    if (!$v) { try { return route($fallbackRoute); } catch(\Throwable $e){ return '#'; } }
    if (str_starts_with($v,'http') || str_starts_with($v,'/')) return $v;
    try { return route($v); } catch(\Throwable $e){ return $v; }
};

// ── Hero ─────────────────────────────────────────────────────────────────
$heroBadge    = $s('hero_badge',   'Terakreditasi Unggul');
$heroJudul1   = $s('hero_judul_1', 'Program Doktor');
$heroJudulHl  = $s('hero_judul_hl','Manajemen');
$heroJudul2   = $s('hero_judul_2', 'Berbasis Nilai Pancasila');
$heroDeskripsi= $s('hero_deskripsi','Hadir sebagai pusat unggulan riset dan pengembangan teori manajemen, berorientasi pada transformasi strategis untuk melahirkan pemikir manajemen Indonesia yang orisinal, inovatif, dan berdaya saing global.');
$heroBtn1Lbl  = $s('hero_btn1_label','Daftar Sekarang');
$heroBtn1Url  = $resolveUrl($s('hero_btn1_url',''), 'akademik');
$heroBtn2Lbl  = $s('hero_btn2_label','Pelajari Lebih Lanjut');
$heroBtn2Url  = $resolveUrl($s('hero_btn2_url',''), 'tentang');

// ── Hero card ─────────────────────────────────────────────────────────────
$heroStat = [
    1 => [$s('hero_stat1_angka','3'),    $s('hero_stat1_label','Konsentrasi')],
    2 => [$s('hero_stat2_angka','6'),    $s('hero_stat2_label','Semester')],
    3 => [$s('hero_stat3_angka','180+'), $s('hero_stat3_label','Alumni')],
];
$heroAkrNama  = $s('hero_akreditasi_nama','Akreditasi Unggul');
$heroAkrBadan = $s('hero_akreditasi_badan','BAN-PT – Kemenristekdikti');
$heroSkNomor  = $s('hero_sk_nomor','SK No. 123');
$heroSkValid  = $s('hero_sk_valid','Valid 2024–2029');
$heroPmbLabel = $s('hero_pmb_label','Penerimaan Mahasiswa Baru');
$heroPmbBtn   = $s('hero_pmb_btn','Lihat Jadwal');
$heroPmbUrl   = $resolveUrl($s('hero_pmb_url',''), 'akademik');

// ── Stats bar ─────────────────────────────────────────────────────────────
$statsDef = [
    1 => ['bi-award',           'A',    'Akreditasi BAN-PT'],
    2 => ['bi-people',          '20+',  'Dosen Berkualifikasi S3'],
    3 => ['bi-journal-richtext','150+', 'Publikasi Internasional'],
    4 => ['bi-globe2',          '10+',  'Mitra Internasional'],
];
$statsBar = [];
foreach([1,2,3,4] as $i) {
    $statsBar[$i] = [
        'icon'  => $s('stats_'.$i.'_icon',  $statsDef[$i][0]),
        'nilai' => $s('stats_'.$i.'_nilai', $statsDef[$i][1]),
        'desc'  => $s('stats_'.$i.'_desc',  $statsDef[$i][2]),
    ];
}

// ── Konsentrasi ───────────────────────────────────────────────────────────
$konsDef = [
    1 => ['bi-people-fill',      'Manajemen Modal Manusia Strategis',              'Mengkaji pengembangan, pengelolaan, dan optimalisasi sumber daya manusia secara strategis untuk meningkatkan kinerja organisasi dan daya saing institusi di era global.'],
    2 => ['bi-graph-up-arrow',   'Manajemen Ekosistem Pasar Inovatif',             'Mempelajari dinamika pasar berbasis teknologi, transformasi bisnis, dan strategi pengelolaan ekosistem pasar yang inovatif, adaptif, dan kompetitif di tingkat nasional maupun internasional.'],
    3 => ['bi-currency-exchange','Manajemen Keuangan Etis & Pengembangan Berkelanjutan','Mengintegrasikan prinsip etika, tata kelola keuangan yang bertanggung jawab, dan strategi pengembangan berkelanjutan untuk menciptakan nilai ekonomi yang berdampak sosial dan lingkungan positif.'],
];
$konsItems = [];
foreach([1,2,3] as $i) {
    $konsItems[$i] = [
        'icon'      => $s('kons_'.$i.'_icon',      $konsDef[$i][0]),
        'judul'     => $s('kons_'.$i.'_judul',     $konsDef[$i][1]),
        'deskripsi' => $s('kons_'.$i.'_deskripsi', $konsDef[$i][2]),
    ];
}

// ── Keunggulan ────────────────────────────────────────────────────────────
$unggulDef = [
    1 => ['bi-award-fill',          'Terakreditasi Unggul',    'Akreditasi tertinggi BAN-PT menjamin kualitas pendidikan'],
    2 => ['bi-mortarboard-fill',    'Dosen Guru Besar',        'Dibimbing oleh professor dan doktor berpengalaman'],
    3 => ['bi-journal-check',       'Riset Bereputasi',        'Publikasi terindeks Scopus dan WoS'],
    4 => ['bi-globe-americas',      'Jaringan Global',         'Kolaborasi riset internasional dan pertukaran akademisi'],
    5 => ['bi-shield-check',        'Berbasis Pancasila',      'Mengintegrasikan nilai-nilai Pancasila dalam kurikulum'],
    6 => ['bi-lightning-charge-fill','Kurikulum Inovatif',     'Kurikulum adaptif sesuai kebutuhan industri dan riset'],
];
$unggulItems = [];
foreach([1,2,3,4,5,6] as $i) {
    $unggulItems[$i] = [
        'icon'      => $s('unggul_'.$i.'_icon',      $unggulDef[$i][0]),
        'judul'     => $s('unggul_'.$i.'_judul',     $unggulDef[$i][1]),
        'deskripsi' => $s('unggul_'.$i.'_deskripsi', $unggulDef[$i][2]),
    ];
}

// ── Profil Lulusan ────────────────────────────────────────────────────────
$lulusanDef = [
    1 => ['Eksekutif Strategis & Pemimpin Modal Manusia',       'Mampu memimpin pengembangan SDM secara strategis di level puncak pada institusi nasional maupun multinasional.'],
    2 => ['Konsultan Transformasi Bisnis & Ekosistem Pasar',    'Mampu merancang dan mengimplementasikan strategi pemasaran inovatif serta pengelolaan ekosistem pasar yang adaptif.'],
    3 => ['Pemimpin Keuangan Etis & Pengembangan Berkelanjutan','Mampu mengelola keuangan organisasi secara etis, bertanggung jawab, dan berorientasi pada nilai jangka panjang.'],
    4 => ['Pengambil Kebijakan & Pemimpin Sektor Publik',       'Mampu merumuskan kebijakan strategis berbasis riset di bidang SDM, pasar, dan keuangan untuk pembangunan nasional.'],
    5 => ['Akademisi, Ilmuwan & Peneliti Manajemen',            'Mampu menghasilkan karya ilmiah bereputasi internasional dan berkontribusi pada pengembangan ilmu manajemen.'],
];
$lulusanItems = [];
foreach([1,2,3,4,5] as $i) {
    $lulusanItems[$i] = [
        'judul'     => $s('lulusan_'.$i.'_judul',     $lulusanDef[$i][0]),
        'deskripsi' => $s('lulusan_'.$i.'_deskripsi', $lulusanDef[$i][1]),
    ];
}

// ── CTA section ───────────────────────────────────────────────────────────
$ctaSeksiJudul  = $s('cta_section_judul',      'Siap Melangkah ke Jenjang Doktoral?');
$ctaSeksiTeks   = $s('cta_section_teks',       'Bergabunglah bersama para pemimpin, akademisi, dan profesional terbaik Indonesia. Wujudkan impian Anda menjadi doktor manajemen yang berpengaruh.');
$ctaSeksiBtn1L  = $s('cta_section_btn1_label', 'Daftar Sekarang');
$ctaSeksiBtn1U  = $resolveUrl($s('cta_section_btn1_url',''), 'akademik');
$ctaSeksiBtn2L  = $s('cta_section_btn2_label', 'Hubungi Kami');
$ctaSeksiBtn2U  = $resolveUrl($s('cta_section_btn2_url',''), 'kontak');
@endphp

{{-- HERO --}}
<section class="hero-section">
    <div class="container-xl position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="hero-badge"><i class="bi bi-star-fill me-1"></i> {{ $heroBadge }}</span>
                <h1>
                    {{ $heroJudul1 }} <span>{{ $heroJudulHl }}</span><br>
                    {{ $heroJudul2 }}
                </h1>
                <p>{{ $heroDeskripsi }}</p>
                <div class="hero-buttons d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ $heroBtn1Url }}" class="btn btn-light">
                        <i class="bi bi-pencil-square me-2"></i>{{ $heroBtn1Lbl }}
                    </a>
                    <a href="{{ $heroBtn2Url }}" class="btn btn-outline-light">
                        <i class="bi bi-play-circle me-2"></i>{{ $heroBtn2Lbl }}
                    </a>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left" data-aos-delay="150">
                <div class="hero-card">
                    <div class="row g-0">
                        @foreach($heroStat as $idx => $stat)
                        <div class="col-4 stat-item {{ $idx === 2 ? 'border-start border-end' : '' }}">
                            <div class="number">{{ $stat[0] }}</div>
                            <div class="label">{{ $stat[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="hero-accredit d-flex align-items-center gap-3">
                        <div class="badge-a">A</div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#333;">{{ $heroAkrNama }}</div>
                            <div style="font-size:0.78rem; color:#888;">{{ $heroAkrBadan }}</div>
                        </div>
                        <div class="ms-auto text-end">
                            <div style="font-weight:700; font-size:0.9rem; color:#333;">{{ $heroSkNomor }}</div>
                            <div style="font-size:0.78rem; color:#888;">{{ $heroSkValid }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3 mt-1">
                        <div style="font-size:0.82rem; color:#555;"><i class="bi bi-calendar3 me-2 text-danger"></i>{{ $heroPmbLabel }}</div>
                        <a href="{{ $heroPmbUrl }}" class="btn btn-primary btn-sm ms-auto">{{ $heroPmbBtn }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS BAR --}}
<section class="stats-bar">
    <div class="container-xl">
        <div class="row g-0">
            @foreach($statsBar as $idx => $stat)
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ ($idx-1)*100 }}">
                <div class="stat-bar-item">
                    <span class="icon"><i class="bi {{ $stat['icon'] }}"></i></span>
                    <div class="value">{{ $stat['nilai'] }}</div>
                    <div class="desc">{{ $stat['desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SAMBUTAN KETUA PROGRAM STUDI --}}
@php
    $sbNama      = $site['sambutan_nama']->value    ?? '';
    $sbJabatan   = $site['sambutan_jabatan']->value ?? 'Ketua Program Studi';
    $sbFoto      = $site['sambutan_foto']->value    ?? '';
    $sbIsi       = $site['sambutan_isi']->value     ?? '';
    $sbChip      = $site['sambutan_chip']->value    ?? 'Sambutan Ketua Program Studi';
    $sbJudul     = $site['sambutan_judul']->value   ?? 'Selamat Datang di';
    $namaProdiSb = $site['nama_prodi']->value       ?? 'Program Studi Manajemen Program Doktor';
    $singkatanSb = $site['singkatan']->value        ?? 'PSMPD';
@endphp
@if($sbNama || $sbIsi)
<section class="sambutan-home">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            <div class="col-lg-4 text-center" data-aos="fade-right">
                <div class="sambutan-img-wrap d-inline-block">
                    @if($sbFoto)
                        <img src="{{ asset('storage/'.$sbFoto) }}" alt="{{ $sbNama }}">
                    @else
                        <div class="sambutan-img-placeholder">
                            <i class="bi bi-person-fill" style="font-size:4rem; opacity:.6;"></i>
                        </div>
                    @endif
                    <div class="sambutan-img-deco"><i class="bi bi-quote"></i></div>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left">
                <div class="sambutan-chip"><i class="bi bi-chat-quote-fill"></i> {{ $sbChip }}</div>
                <h2 style="font-size:1.9rem; color:var(--dark); margin-bottom:8px; font-family:'Playfair Display',serif;">
                    {{ $sbJudul }} <span style="color:var(--red-primary);">{{ $singkatanSb }}</span>
                </h2>
                <blockquote class="sambutan-quote">
                    {{ Str::limit($sbIsi, 500) }}
                </blockquote>
                <div class="d-flex align-items-center gap-3">
                    <div class="sambutan-divider"></div>
                    <div>
                        <p style="font-size:1.05rem; font-weight:700; color:var(--dark); margin:0;">{{ $sbNama }}</p>
                        <p style="font-size:0.85rem; color:var(--red-primary); font-weight:600; margin:0;">{{ $sbJabatan }}</p>
                        <p style="font-size:0.8rem; color:#888; margin:0;">{{ $namaProdiSb }} &bull; FEB UNTAG Semarang</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('struktur') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-diagram-2 me-1"></i>Lihat Struktur Organisasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- KONSENTRASI --}}
<section class="section-pad">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>{{ $s('kons_section_judul', 'Konsentrasi Program Studi') }}</h2>
            <p>{{ $s('kons_section_desc', 'Tiga bidang unggulan yang dirancang untuk melahirkan pemimpin dan inovator manajemen tingkat doktoral') }}</p>
        </div>
        <div class="row g-4">
            @foreach($konsItems as $i => $kons)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i-1)*120 }}">
                <div class="konsentrasi-card card position-relative">
                    <span class="konsentrasi-card card-number">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="card-body">
                        <div class="konsentrasi-icon-wrap" style="background:#fff0f0; color:var(--red-primary);">
                            <i class="bi {{ $kons['icon'] }}"></i>
                        </div>
                        <h4>{{ $kons['judul'] }}</h4>
                        <p>{{ $kons['deskripsi'] }}</p>
                        <a href="{{ route('konsentrasi') }}" class="btn btn-outline-primary btn-sm mt-2">Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="section-pad bg-dark-section">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up" style="color:white;">
            <h2 style="color:white;">{{ $s('unggul_section_judul', 'Keunggulan '.$singkatan.'-FEB UNTAG') }}</h2>
            <p style="color:rgba(255,255,255,0.7);">{{ $s('unggul_section_desc', 'Pusat unggulan riset dan pengembangan teori manajemen berbasis nilai-nilai Pancasila') }}</p>
        </div>
        <div class="row g-4">
            @foreach($unggulItems as $i => $item)
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ ($i-1)*80 }}">
                <div class="keunggulan-item">
                    <div class="keunggulan-icon"><i class="bi {{ $item['icon'] }}"></i></div>
                    <h5>{{ $item['judul'] }}</h5>
                    <p>{{ $item['deskripsi'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROFIL LULUSAN --}}
<section class="section-pad bg-light-red">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>{{ $s('lulusan_section_judul', 'Profil Lulusan') }}</h2>
            <p>{{ $s('lulusan_section_desc', 'Lulusan '.$singkatan.'-FEB UNTAG siap memimpin di berbagai sektor strategis nasional maupun internasional') }}</p>
        </div>
        <div class="row g-4">
            @foreach($lulusanItems as $i => $lulusan)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i-1)*80 }}">
                <div class="lulusan-card d-flex gap-3">
                    <div class="lulusan-number">{{ $i }}</div>
                    <div>
                        <h5>{{ $lulusan['judul'] }}</h5>
                        <p>{{ $lulusan['deskripsi'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-6 col-lg-4 d-flex align-items-center justify-content-center" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center p-4">
                    <div style="font-size:4rem; color:var(--red-primary); opacity:0.2;">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <a href="{{ route('profil-lulusan') }}" class="btn btn-primary">
                        Lihat Detail Profil Lulusan <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BERITA TERBARU --}}
@if($berita_terbaru->count() > 0)
<section class="section-pad">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
            <div class="section-title text-start mb-0 pb-0" style="text-align:left!important;">
                <h2 style="text-align:left!important;">{{ $s('berita_section_judul', 'Berita Terbaru') }}</h2>
                <p style="max-width:100%; text-align:left!important;">{{ $s('berita_section_desc', 'Informasi terkini dari '.$singkatan.'-FEB UNTAG Semarang') }}</p>
            </div>
            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary d-none d-md-inline-flex align-items-center gap-1 flex-shrink-0">
                Semua Berita <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($berita_terbaru as $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="news-card card">
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" onerror="this.src='https://via.placeholder.com/400x200/CC0000/ffffff?text=Berita'">
                    <div class="card-body">
                        <div class="news-meta d-flex align-items-center gap-2">
                            <span class="badge-red">{{ $item->kategori }}</span>
                            <span><i class="bi bi-clock me-1"></i>{{ $item->published_at?->isoFormat('D MMM Y') }}</span>
                        </div>
                        <h5>{{ $item->judul }}</h5>
                        <p>{{ Str::limit($item->ringkasan ?? strip_tags($item->konten), 100) }}</p>
                        <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-outline-primary btn-sm">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4 d-md-none">
            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary">Semua Berita</a>
        </div>
    </div>
</section>
@endif

{{-- GALERI --}}
@if($galeri->count() > 0)
<section class="section-pad" style="background:#f8f8f8; padding-top:60px;">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>{{ $s('galeri_section_judul', 'Galeri Kegiatan') }}</h2>
            <p>{{ $s('galeri_section_desc', 'Momen berharga dalam perjalanan akademik '.$singkatan.'-FEB UNTAG') }}</p>
        </div>
        <div class="row g-3">
            @foreach($galeri->take(8) as $foto)
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="galeri-item">
                    <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}" onerror="this.src='https://via.placeholder.com/300x180/CC0000/ffffff?text=Galeri'">
                    <div class="galeri-overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="btn btn-outline-primary">
                <i class="bi bi-images me-2"></i>Lihat Semua Galeri
            </a>
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <div class="container-xl position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 style="color:white; font-size:2rem;">{{ $ctaSeksiJudul }}</h2>
                <p style="color:rgba(255,255,255,0.85); font-size:1.05rem; margin:0;">{{ $ctaSeksiTeks }}</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="{{ $ctaSeksiBtn1U }}" class="btn btn-light btn-lg me-2 mb-2">
                    <i class="bi bi-pencil-square me-2"></i>{{ $ctaSeksiBtn1L }}
                </a>
                <a href="{{ $ctaSeksiBtn2U }}" class="btn btn-outline-light btn-lg mb-2">
                    <i class="bi bi-chat-dots me-2"></i>{{ $ctaSeksiBtn2L }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
