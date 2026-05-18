@php
    // Helper closure untuk membaca setting dengan fallback
    $s = fn(string $key, string $default = '') => $site[$key]?->value ?? $default;

    $namaProdi   = $s('nama_prodi',  'Program Studi Manajemen Program Doktor');
    $singkatan   = $s('singkatan',   'PSMPD');
    $telepon     = $s('telepon',     '(024) 8316405');
    $email       = $s('email',       'psmpd@untag-smg.ac.id');
    $alamat      = $s('alamat',      'Jl. Pawiyatan Luhur IV No.1, Semarang');
    $facebook    = $s('facebook',    '#');
    $instagram   = $s('instagram',   '#');
    $youtube     = $s('youtube',     '#');
    $twitter     = $s('twitter',     '#');
    $whatsapp    = $s('whatsapp',    '');
    $website     = $s('website',     'https://untag-smg.ac.id');
    $deskripsi   = $s('deskripsi_singkat', 'Program Studi Manajemen Program Doktor FEB UNTAG Semarang menghasilkan doktor manajemen yang kompeten, berintegritas, dan berdaya saing global berlandaskan nilai-nilai Pancasila.');
    $logoPath    = $s('logo',        '');
    $faviconPath = $s('favicon',     '');
    $logoUrl     = $logoPath  ? asset('storage/' . $logoPath)   : null;
    $faviconUrl  = $faviconPath ? asset('storage/' . $faviconPath) : asset('favicon.ico');
    $whatsappUrl = $whatsapp ? 'https://wa.me/' . preg_replace('/\D/', '', $whatsapp) : '#';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $namaProdi }} - Fakultas Ekonomi dan Bisnis Universitas 17 Agustus 1945 Semarang">
    <meta name="keywords" content="doktor manajemen, PSMPD, UNTAG Semarang, program doktor, FEB UNTAG">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $singkatan . ' - FEB UNTAG Semarang')">
    <meta property="og:description" content="@yield('og_description', $deskripsi)">
    <meta property="og:image" content="@yield('og_image', $logoUrl ?? '')">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $singkatan . ' - FEB UNTAG Semarang')">
    <meta name="twitter:description" content="@yield('og_description', $deskripsi)">
    <meta name="twitter:image" content="@yield('og_image', $logoUrl ?? '')">
    <title>@yield('title', $singkatan . ' - FEB UNTAG Semarang')</title>

    {{-- Favicon: dari database, fallback ke default --}}
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $faviconUrl }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --red-primary: #C0304A;
            --red-dark: #952035;
            --red-light: #ff4444;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-mid: #e9ecef;
            --gray-text: #6c757d;
            --dark: #1a1a2e;
            --gold: #c8a84b;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: #333; overflow-x: hidden; }
        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

        /* ========== TOP BAR ========== */
        .top-bar {
            background:
                linear-gradient(130deg, transparent 8%, rgba(255,255,255,0.09) 32%, rgba(255,240,245,0.16) 43%, rgba(255,255,255,0.09) 54%, transparent 72%),
                linear-gradient(90deg, #4A0A18 0%, #8B1828 45%, #6D1020 100%);
            color: rgba(255,255,255,0.9); font-size: 0.8rem; padding: 6px 0;
        }
        .top-bar a { color: rgba(255,255,255,0.9); text-decoration: none; }
        .top-bar a:hover { color: #fff; }

        /* ========== HEADER ========== */
        .site-header {
            background:
                radial-gradient(ellipse 50% 200% at 100% 50%, rgba(255,160,180,0.22) 0%, transparent 55%),
                radial-gradient(ellipse 30% 200% at 0% 50%, rgba(40,0,8,0.55) 0%, transparent 55%),
                linear-gradient(120deg, #6B0D1A 0%, #9C1828 32%, #C8223E 62%, #9C1828 86%, #6B0D1A 100%);
            padding: 12px 0; box-shadow: 0 3px 28px rgba(50,0,12,0.45);
        }
        .site-header .logo-text { color: white; text-decoration: none; }
        .site-header .logo-text h4 { font-size: 1.1rem; font-weight: 700; margin: 0; line-height: 1.2; font-family: 'Inter', sans-serif; letter-spacing: 0.5px; }
        .site-header .logo-text small { font-size: 0.72rem; opacity: 0.85; letter-spacing: 0.3px; }
        .logo-icon { width: 150px; height: 150px; background: transparent; border-radius: 0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .logo-icon img { width: 100%; height: 100%; object-fit: contain; padding: 0; }
        .logo-icon .logo-fallback { font-size: 1.2rem; font-weight: 900; color: white; }

        /* ========== NAVBAR ========== */
        .main-nav { background: white; box-shadow: 0 2px 15px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .main-nav .navbar-nav .nav-link { color: var(--dark) !important; font-weight: 500; font-size: 0.88rem; padding: 14px 14px !important; transition: color 0.2s, background 0.2s; position: relative; text-transform: uppercase; letter-spacing: 0.3px; }
        .main-nav .navbar-nav .nav-link:after { content: ''; position: absolute; bottom: 0; left: 14px; right: 14px; height: 3px; background: var(--red-primary); border-radius: 2px; transform: scaleX(0); transition: transform 0.2s; }
        .main-nav .navbar-nav .nav-link:hover, .main-nav .navbar-nav .nav-link.active { color: var(--red-primary) !important; }
        .main-nav .navbar-nav .nav-link:hover:after, .main-nav .navbar-nav .nav-link.active:after { transform: scaleX(1); }
        .main-nav .dropdown-menu { border: none; box-shadow: 0 8px 30px rgba(0,0,0,0.12); border-radius: 8px; padding: 8px 0; min-width: 220px; }
        .main-nav .dropdown-item { font-size: 0.85rem; padding: 8px 20px; color: #333; transition: background 0.2s, color 0.2s; }
        .main-nav .dropdown-item:hover { background: #fff5f5; color: var(--red-primary); }
        .main-nav .navbar-toggler { border: none; padding: 4px 8px; }
        .main-nav .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23C0304A' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }

        /* ========== PAGE HERO ========== */
        .page-hero {
            background:
                radial-gradient(ellipse 60% 80% at 100% 50%,
                    rgba(255,255,255,0.55) 0%,
                    rgba(255,190,210,0.30) 28%,
                    transparent 58%
                ),
                radial-gradient(ellipse 50% 55% at 100% 0%,
                    rgba(255,140,165,0.30) 0%,
                    transparent 55%
                ),
                radial-gradient(ellipse 40% 70% at 0% 100%, rgba(45,0,8,0.80) 0%, transparent 50%),
                radial-gradient(ellipse 40% 70% at 100% 100%, rgba(45,0,8,0.80) 0%, transparent 50%),
                linear-gradient(148deg, #880F1E 0%, #BC1C32 28%, #D82540 56%, #BC1C32 80%, #880F1E 100%);
            padding: 60px 0; color: white; position: relative; overflow: hidden;
        }
        .page-hero h1 { text-shadow: 0 2px 16px rgba(50,0,10,0.60), 0 4px 28px rgba(50,0,10,0.28); }
        .page-hero::before { display: none; }
        .page-hero::after { display: none; }
        .page-hero h1 { font-size: 2rem; font-weight: 700; margin: 0; }
        .page-hero .breadcrumb { margin: 8px 0 0; }
        .page-hero .breadcrumb-item { color: rgba(255,255,255,0.8); font-size: 0.85rem; }
        .page-hero .breadcrumb-item.active { color: white; }
        .page-hero .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.6); }
        .page-hero .breadcrumb-item a { color: rgba(255,255,255,0.8); text-decoration: none; }
        .page-hero .breadcrumb-item a:hover { color: white; }

        /* ========== SECTIONS ========== */
        .section-title { position: relative; text-align: center; margin-bottom: 40px; }
        .section-title h2 { font-size: 2rem; color: var(--dark); font-weight: 700; margin-bottom: 10px; }
        .section-title p { color: var(--gray-text); max-width: 600px; margin: 0 auto; }
        .section-title::after { content: ''; display: block; width: 60px; height: 4px; background: linear-gradient(to right, #8B1A2E, #C0304A, #F09AAA, #FDEEF1); margin: 12px auto 0; border-radius: 2px; }

        /* ========== CARDS ========== */
        .card { border: none; border-radius: 12px; transition: transform 0.3s, box-shadow 0.3s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(0,0,0,0.12); }
        .card-img-top { border-radius: 12px 12px 0 0; }

        /* ========== BUTTONS ========== */
        .btn-primary { background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 100%); border: none; padding: 10px 24px; font-weight: 600; border-radius: 8px; box-shadow: 0 4px 14px rgba(139,26,46,0.35); transition: all 0.25s; }
        .btn-primary:hover { background: linear-gradient(135deg, #D04060 0%, #A0243E 100%); border: none; box-shadow: 0 6px 18px rgba(139,26,46,0.45); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
        .btn-outline-primary { color: var(--red-primary); border-color: var(--red-primary); padding: 10px 24px; font-weight: 600; border-radius: 8px; }
        .btn-outline-primary:hover { background: linear-gradient(135deg, #C0304A, #8B1A2E); border-color: #8B1A2E; color: white; }

        /* ========== BADGES ========== */
        .badge-red { background: var(--red-primary); color: white; font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; }

        /* ========== FOOTER ========== */
        .site-footer { background: linear-gradient(135deg, var(--dark) 0%, #16213e 100%); color: rgba(255,255,255,0.8); padding-top: 60px; }
        .site-footer h5 { color: white; font-weight: 700; font-family: 'Inter', sans-serif; margin-bottom: 20px; font-size: 1rem; }
        .site-footer p, .site-footer li { font-size: 0.875rem; line-height: 1.8; }
        .site-footer a { color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.2s; }
        .site-footer a:hover { color: white; }
        .site-footer ul { list-style: none; padding: 0; }
        .site-footer ul li { padding: 3px 0; }
        .site-footer ul li i { color: var(--red-light); margin-right: 6px; width: 16px; }
        .footer-logo-wrap { width: 90px; height: 90px; background: transparent; border-radius: 0; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; overflow: hidden; }
        .footer-logo-wrap img { width: 100%; height: 100%; object-fit: contain; padding: 0; }
        .footer-logo-fallback { width: 80px; height: 80px; background: linear-gradient(135deg, #C0304A, #8B1A2E); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.3rem; color: white; margin-bottom: 15px; }
        .footer-bottom { background: rgba(0,0,0,0.3); padding: 16px 0; margin-top: 40px; font-size: 0.8rem; color: rgba(255,255,255,0.6); }
        .footer-bottom a { color: rgba(255,255,255,0.7); text-decoration: none; }
        .social-links a { display: inline-flex; width: 36px; height: 36px; align-items: center; justify-content: center; background: rgba(255,255,255,0.1); color: white; border-radius: 50%; margin-right: 6px; transition: background 0.2s, transform 0.2s; font-size: 0.9rem; }
        .social-links a:hover { background: linear-gradient(135deg, #C0304A, #8B1A2E); transform: translateY(-2px); }

        /* ========== TICKER ========== */
        .ticker-wrap {
            background:
                linear-gradient(130deg, transparent 10%, rgba(255,255,255,0.10) 36%, rgba(255,240,245,0.18) 46%, rgba(255,255,255,0.10) 56%, transparent 74%),
                linear-gradient(90deg, #7B1528 0%, #C02035 45%, #BB1E30 100%);
            padding: 8px 0; overflow: hidden;
        }
        .ticker-label { background: rgba(0,0,0,0.22); color: white; padding: 4px 16px; font-weight: 700; font-size: 0.8rem; white-space: nowrap; flex-shrink: 0; border-radius: 0 4px 4px 0; }
        .ticker-content { display: flex; align-items: center; overflow: hidden; flex: 1; }
        .ticker-inner { display: flex; gap: 50px; animation: ticker 30s linear infinite; white-space: nowrap; }
        .ticker-inner a { color: white; text-decoration: none; font-size: 0.82rem; }
        .ticker-inner a:hover { text-decoration: underline; }
        @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* ========== PAGINATION ========== */
        .pagination .page-link { color: var(--red-primary); }
        .pagination .page-item.active .page-link { background: var(--red-primary); border-color: var(--red-primary); }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991px) {
            /* Navbar desktop underline indicator off */
            .main-nav .navbar-nav .nav-link:after { display: none; }
            .page-hero h1 { font-size: 1.6rem; }
            .page-hero { padding: 44px 0; }

            /* ── Mobile navbar menu ── */
            .main-nav .navbar-collapse {
                background: #fff;
                border-top: 3px solid var(--red-primary);
                border-radius: 0 0 12px 12px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                padding: 8px 0 16px;
                margin-top: 8px;
            }
            .main-nav .navbar-nav .nav-link {
                padding: 12px 20px !important;
                font-size: 0.9rem;
                border-bottom: 1px solid #f5f5f5;
            }
            .main-nav .navbar-nav .nav-item:last-child .nav-link { border-bottom: none; }
            .main-nav .navbar-nav .nav-link.active {
                background: #fff5f5;
                color: var(--red-primary) !important;
                border-left: 3px solid var(--red-primary);
            }
            .main-nav .dropdown-menu {
                box-shadow: none;
                border-top: 1px solid #f5f5f5;
                border-radius: 0;
                padding: 4px 0 4px 16px;
                margin: 0;
            }
            .main-nav .dropdown-item {
                padding: 10px 20px;
                border-bottom: 1px solid #f9f9f9;
            }
        }

        @media (max-width: 767px) {
            /* Header compact */
            .site-header { padding: 8px 0; }
            .logo-icon { width: 52px !important; height: 52px !important; }
            .site-header .logo-text h4 { font-size: 0.85rem; line-height: 1.25; }
            .site-header .logo-text small { display: none; }

            /* Navbar toggler alignment */
            .main-nav .container-xl { padding-left: 12px; padding-right: 12px; }
            .main-nav .navbar-toggler { margin-left: auto; }

            /* Page hero */
            .page-hero { padding: 36px 0 32px; }
            .page-hero h1 { font-size: 1.4rem; }

            /* Footer */
            .site-footer { padding-top: 40px; }
            .footer-bottom { text-align: center; }
            .footer-bottom .d-flex { flex-direction: column; gap: 6px !important; }
        }

        @media (max-width: 575px) {
            .site-header { padding: 6px 0; }
            .logo-icon { width: 44px !important; height: 44px !important; }
            .site-header .logo-text h4 { font-size: 0.78rem; }
            .page-hero h1 { font-size: 1.25rem; }
            .page-hero { padding: 28px 0 24px; }
            .ticker-label { font-size: 0.72rem; padding: 4px 10px; }
            .ticker-inner a { font-size: 0.76rem; }
        }
    </style>

    @yield('styles')
</head>
<body>

{{-- Progress Bar --}}
<div id="scroll-progress" style="
    position:fixed; top:0; left:0; height:3px; width:0%;
    background:linear-gradient(90deg,#C0304A,#FF6B8A,#C0304A);
    z-index:9999; transition:width .1s linear;
    box-shadow:0 0 8px rgba(192,48,74,.6);
"></div>

{{-- ===== PMB FLOATING BUTTONS + BACK TO TOP ===== --}}
@php
    $pmbWaMsg = rawurlencode("Halo Admin PSMPD FEB UNTAG Semarang 🎓\n\nSaya ingin mendapatkan informasi lebih lanjut mengenai *Pendaftaran Program Studi Manajemen Program Doktor (PSMPD) FEB UNTAG Semarang*.\n\nMohon bantuannya. Terima kasih 🙏");
    $pmbWaUrl = $whatsapp ? 'https://wa.me/' . preg_replace('/\D/', '', $whatsapp) . '?text=' . $pmbWaMsg : '#';
    $pmbDaftarUrl = route('halaman.show', 'pmb');
@endphp

<style>
.fab-group {
    position: fixed;
    bottom: 20px;
    right: 16px;
    z-index: 9991;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.fab-btn {
    position: relative;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: #fff;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
    flex-shrink: 0;
}
.fab-btn:hover { transform: scale(1.1); color: #fff; }
.fab-btn .fab-label {
    position: absolute;
    right: 58px;
    white-space: nowrap;
    background: rgba(20,20,20,.85);
    color: #fff;
    font-size: .71rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 20px;
    pointer-events: none;
    opacity: 0;
    transform: translateX(6px);
    transition: opacity .2s, transform .2s;
}
.fab-btn:hover .fab-label { opacity: 1; transform: translateX(0); }
.fab-daftar {
    background: linear-gradient(135deg, #C0304A, #8B1A2E);
    box-shadow: 0 4px 16px rgba(192,48,74,.5);
    animation: fabPulseRed 3s infinite;
}
.fab-wa {
    background: #25D366;
    box-shadow: 0 4px 16px rgba(37,211,102,.45);
    animation: fabPulseGreen 2.5s infinite;
}
.fab-top {
    background: linear-gradient(135deg, #374151, #1f2937);
    box-shadow: 0 4px 14px rgba(0,0,0,.25);
    opacity: 0;
    pointer-events: none;
    transform: translateY(8px);
    transition: opacity .3s, transform .3s, box-shadow .2s;
}
.fab-top.visible { opacity: 1; pointer-events: auto; transform: translateY(0); }
@keyframes fabPulseGreen {
    0%,100% { box-shadow: 0 4px 14px rgba(37,211,102,.45); }
    50%      { box-shadow: 0 6px 22px rgba(37,211,102,.8); }
}
@keyframes fabPulseRed {
    0%,100% { box-shadow: 0 4px 14px rgba(192,48,74,.5); }
    50%      { box-shadow: 0 6px 22px rgba(192,48,74,.85); }
}
@media (max-width: 575.98px) {
    .fab-btn .fab-label { display: none; }
    .fab-group { bottom: 14px; right: 12px; gap: 8px; }
    .fab-btn { width: 46px; height: 46px; font-size: 1.15rem; }
}
</style>

<div class="fab-group">
    {{-- Daftar Sekarang --}}
    <a href="{{ $pmbDaftarUrl }}" class="fab-btn fab-daftar" title="Daftar Program Doktor">
        <i class="bi bi-pencil-square"></i>
        <span class="fab-label">Daftar Sekarang</span>
    </a>

    {{-- WA Konsultasi --}}
    @if($whatsapp)
    <a href="{{ $pmbWaUrl }}" target="_blank" rel="noopener" class="fab-btn fab-wa" title="Konsultasi PMB">
        <i class="bi bi-whatsapp"></i>
        <span class="fab-label">Konsultasi PMB</span>
    </a>
    @endif

    {{-- Back to Top --}}
    <button id="back-to-top" class="fab-btn fab-top" title="Kembali ke atas">
        <i class="bi bi-chevron-up"></i>
        <span class="fab-label">Ke atas</span>
    </button>
</div>

    {{-- ===== PMB ANNOUNCEMENT BAR ===== --}}
    @php $adaPmb = \App\Models\JadwalPmb::where('is_active', true)->exists(); @endphp
    @if($adaPmb)
    <div id="pmb-bar" style="background:linear-gradient(90deg,#8B1A2E,#C0304A,#8B1A2E);
         background-size:200% 100%; animation:barSlide 4s linear infinite;
         color:white; text-align:center; padding:8px 16px; font-size:.82rem; font-weight:600;
         position:relative; z-index:1050;">
        <span style="margin-right:12px;">
            🎓 Pendaftaran Program Doktor Manajemen FEB UNTAG Semarang sedang <strong>TERBUKA!</strong>
        </span>
        <a href="{{ route('halaman.show', 'pmb') }}"
           style="background:white; color:#C0304A; padding:3px 14px; border-radius:20px;
                  font-weight:700; text-decoration:none; font-size:.78rem; margin-right:8px;">
            Daftar Sekarang &rarr;
        </a>
        <button onclick="document.getElementById('pmb-bar').style.display='none'"
                style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                       background:none; border:none; color:rgba(255,255,255,.7);
                       cursor:pointer; font-size:1rem; line-height:1;"
                title="Tutup">&times;</button>
    </div>
    <style>
    @keyframes barSlide { 0%{background-position:0 0} 100%{background-position:200% 0} }
    </style>
    @endif

    {{-- ===== TOP BAR (data dari DB) ===== --}}
    <div class="top-bar d-none d-md-block">
        <div class="container-xl">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-3">
                    <span><i class="bi bi-telephone-fill me-1"></i> {{ $telepon }}</span>
                    <span><i class="bi bi-envelope-fill me-1"></i> {{ $email }}</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    @if($facebook && $facebook !== '#')
                    <a href="{{ $facebook }}" target="_blank" rel="noopener" title="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($instagram && $instagram !== '#')
                    <a href="{{ $instagram }}" target="_blank" rel="noopener" title="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($youtube && $youtube !== '#')
                    <a href="{{ $youtube }}" target="_blank" rel="noopener" title="YouTube"><i class="bi bi-youtube"></i></a>
                    @endif
                    @if($whatsapp)
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    @endif
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="badge-red py-1 px-2 rounded">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- ===== HEADER (logo & nama prodi dari DB) ===== --}}
    <header class="site-header">
        <div class="container-xl">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-icon">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $singkatan }} Logo">
                    @else
                        <span class="logo-fallback">{{ $singkatan }}</span>
                    @endif
                </div>
                <a href="{{ route('home') }}" class="logo-text">
                    <h4>{{ strtoupper($namaProdi) }}</h4>
                    <small>Fakultas Ekonomi dan Bisnis &bull; Universitas 17 Agustus 1945 Semarang</small>
                </a>
            </div>
        </div>
    </header>

    {{-- ===== TICKER PENGUMUMAN ===== --}}
    @php
        $tickerItems = \App\Models\Pengumuman::aktif()->latest()->take(5)->get();
    @endphp
    @if($tickerItems->count() > 0)
    <div class="ticker-wrap">
        <div class="container-xl d-flex align-items-center gap-0" style="overflow:hidden;">
            <span class="ticker-label"><i class="bi bi-megaphone-fill me-1"></i> PENGUMUMAN</span>
            <div class="ticker-content ms-3">
                <div class="ticker-inner">
                    @foreach($tickerItems as $item)
                        <a href="{{ route('pengumuman.show', $item) }}">{{ $item->judul }}</a>
                    @endforeach
                    @foreach($tickerItems as $item)
                        <a href="{{ route('pengumuman.show', $item) }}">{{ $item->judul }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== MAIN NAVIGATION ===== --}}
    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container-xl d-flex align-items-center">
            {{-- Brand di navbar khusus mobile --}}
            <a href="{{ route('home') }}" class="d-lg-none me-auto text-decoration-none"
               style="font-size:.75rem;font-weight:700;color:var(--red-primary);letter-spacing:.5px;line-height:1.2;max-width:180px;">
                {{ $singkatan }}<br>
                <span style="font-weight:400;color:#666;font-size:.68rem;">FEB UNTAG Semarang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    style="padding:6px 10px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto gap-1">
                    @foreach($menuItems as $item)
                        @if($item->children->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ $item->isActiveWithChildren() ? 'active' : '' }}"
                               href="#" data-bs-toggle="dropdown">{{ $item->label }}</a>
                            <ul class="dropdown-menu">
                                @foreach($item->children as $child)
                                <li>
                                    <a class="dropdown-item {{ $child->isActive() ? 'active' : '' }}"
                                       href="{{ $child->resolved_url }}" target="{{ $child->target }}">
                                        @if($child->icon)<i class="bi {{ $child->icon }} me-2" style="color:var(--red-primary)"></i>@endif
                                        {{ $child->label }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ $item->isActive() ? 'active' : '' }}"
                               href="{{ $item->resolved_url }}" target="{{ $item->target }}">
                                {{ $item->label }}
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
                @php
                    $ctaAktif = ($site['cta_aktif']?->value ?? '1') === '1';
                    $ctaLabel = $site['cta_label']?->value ?? 'Daftar Sekarang';
                    $ctaRaw   = $site['cta_url']?->value ?? '';
                    try {
                        $ctaUrl = $ctaRaw ? (str_starts_with($ctaRaw, 'http') || str_starts_with($ctaRaw, '/') ? $ctaRaw : route($ctaRaw)) : route('akademik');
                    } catch (\Throwable $e) {
                        $ctaUrl = $ctaRaw ?: route('akademik');
                    }
                @endphp
                @if($ctaAktif)
                <a href="{{ $ctaUrl }}" class="btn btn-primary btn-sm ms-2 d-none d-lg-inline-flex align-items-center gap-1">
                    <i class="bi bi-pencil-square"></i> {{ $ctaLabel }}
                </a>
                @endif
                {{-- Mobile-only CTA inside menu --}}
                @if($ctaAktif)
                <div class="d-lg-none px-3 pt-2 pb-1">
                    <a href="{{ $ctaUrl }}"
                       class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2"
                       style="border-radius:8px;font-weight:700;">
                        <i class="bi bi-pencil-square"></i> {{ $ctaLabel }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER (semua data dari DB) ===== --}}
    <footer class="site-footer">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    {{-- Logo Footer dari DB --}}
                    @if($logoUrl)
                    <div class="footer-logo-wrap">
                        <img src="{{ $logoUrl }}" alt="{{ $singkatan }}">
                    </div>
                    @else
                    <div class="footer-logo-fallback">{{ $singkatan }}</div>
                    @endif

                    <p style="font-size:0.875rem; line-height:1.8;">{{ $deskripsi }}</p>

                    {{-- Social Media dari DB --}}
                    <div class="social-links mt-3">
                        @if($facebook && $facebook !== '#')
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" title="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($instagram && $instagram !== '#')
                        <a href="{{ $instagram }}" target="_blank" rel="noopener" title="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($youtube && $youtube !== '#')
                        <a href="{{ $youtube }}" target="_blank" rel="noopener" title="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                        @if($twitter && $twitter !== '#')
                        <a href="{{ $twitter }}" target="_blank" rel="noopener" title="Twitter/X"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if($whatsapp)
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5>Menu Cepat</h5>
                    <ul>
                        <li><a href="{{ route('tentang') }}"><i class="bi bi-chevron-right"></i>Tentang Prodi</a></li>
                        <li><a href="{{ route('konsentrasi') }}"><i class="bi bi-chevron-right"></i>Konsentrasi</a></li>
                        <li><a href="{{ route('profil-lulusan') }}"><i class="bi bi-chevron-right"></i>Profil Lulusan</a></li>
                        <li><a href="{{ route('akademik') }}"><i class="bi bi-chevron-right"></i>Akademik</a></li>
                        <li><a href="{{ route('dosen') }}"><i class="bi bi-chevron-right"></i>Dosen</a></li>
                        <li><a href="{{ route('penelitian') }}"><i class="bi bi-chevron-right"></i>Penelitian</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5>Informasi</h5>
                    <ul>
                        <li><a href="{{ route('berita.index') }}"><i class="bi bi-chevron-right"></i>Berita</a></li>
                        <li><a href="{{ route('pengumuman.index') }}"><i class="bi bi-chevron-right"></i>Pengumuman</a></li>
                        <li><a href="{{ route('galeri') }}"><i class="bi bi-chevron-right"></i>Galeri</a></li>
                        <li><a href="{{ route('kontak') }}"><i class="bi bi-chevron-right"></i>Kontak</a></li>
                        <li><a href="{{ route('akademik') }}"><i class="bi bi-chevron-right"></i>Pendaftaran</a></li>
                    </ul>
                </div>

                {{-- Kontak dari DB --}}
                <div class="col-lg-4 col-md-6">
                    <h5>Kontak Kami</h5>
                    <ul>
                        <li><i class="bi bi-geo-alt-fill"></i>{{ $alamat }}</li>
                        <li><i class="bi bi-telephone-fill"></i>{{ $telepon }}</li>
                        <li><i class="bi bi-envelope-fill"></i>{{ $email }}</li>
                        @if($website)
                        <li><i class="bi bi-globe"></i><a href="{{ $website }}" target="_blank">{{ preg_replace('#^https?://#', '', $website) }}</a></li>
                        @endif
                        @if($whatsapp)
                        <li><i class="bi bi-whatsapp"></i><a href="{{ $whatsappUrl }}" target="_blank">{{ $whatsapp }}</a></li>
                        @endif
                    </ul>
                    <div class="mt-3">
                        <h5 style="font-size:0.875rem;">Jam Layanan</h5>
                        <small style="opacity:0.8;">Senin – Jumat: 08.00 – 16.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-4">
            <div class="container-xl d-flex flex-wrap justify-content-between gap-2">
                <span>&copy; {{ date('Y') }} {{ $singkatan }}-FEB UNTAG Semarang. Hak Cipta Dilindungi.</span>
                <span>{{ $namaProdi }} &bull; Universitas 17 Agustus 1945 Semarang</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 80 });</script>

    @yield('scripts')
    <script>
    (function () {
        const bar = document.getElementById('scroll-progress');
        const btn = document.getElementById('back-to-top');

        window.addEventListener('scroll', function () {
            // Progress bar
            const scrolled = window.scrollY;
            const total    = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.width = (total > 0 ? (scrolled / total) * 100 : 0) + '%';

            // Back to top visibility
            if (scrolled > 300) {
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }, { passive: true });

        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
    </script>
</body>
</html>
