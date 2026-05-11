<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $adminFaviconPath = $site['favicon']->value ?? '';
        $adminFaviconUrl  = $adminFaviconPath ? asset('storage/' . $adminFaviconPath) : asset('favicon.ico');
        $adminLogoPath    = $site['logo']->value ?? '';
        $adminLogoUrl     = $adminLogoPath ? asset('storage/' . $adminLogoPath) : null;
        $adminSingkatan   = $site['singkatan']->value ?? 'S3';
        $adminNamaProdi   = $site['nama_prodi']->value ?? 'PSMPD Admin';
    @endphp
    <title>@yield('title', 'Admin') - {{ $adminSingkatan }}</title>
    <link rel="icon" type="image/x-icon" href="{{ $adminFaviconUrl }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --red: #C0304A; --red-dark: #952035; --sidebar-w: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; min-height: 100vh; }

        /* SIDEBAR */
        .admin-sidebar {
            width: var(--sidebar-w); background: linear-gradient(180deg,#1a1a2e 0%,#16213e 100%);
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 1050;
            overflow-y: auto; transition: transform .3s;
            scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.1) transparent;
        }
        .sidebar-header {
            background: linear-gradient(135deg,var(--red),var(--red-dark));
            padding: 20px 20px 18px;
        }
        .sidebar-header .brand { color: white; text-decoration: none; }
        .sidebar-header .brand-title { font-weight: 800; font-size: 0.95rem; line-height: 1.2; }
        .sidebar-header .brand-sub { font-size: 0.72rem; opacity: 0.85; }
        .sidebar-logo { width: 44px; height: 44px; background: rgba(255,255,255,.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 900; color: white; font-size: 1.1rem; flex-shrink: 0; }

        .sidebar-nav { padding: 12px 0; }
        .sidebar-section { padding: 20px 20px 6px; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,.35); }
        .sidebar-link {
            display: flex; align-items: center; gap: 10px; padding: 10px 20px;
            color: rgba(255,255,255,.7); text-decoration: none; font-size: 0.875rem; font-weight: 500;
            transition: all .2s; border-left: 3px solid transparent;
        }
        .sidebar-link:hover { color: white; background: rgba(255,255,255,.07); border-left-color: var(--red); }
        .sidebar-link.active { color: white; background: rgba(192,48,74,.2); border-left-color: var(--red); }
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sidebar-badge { margin-left: auto; background: var(--red); color: white; font-size: 0.7rem; padding: 2px 7px; border-radius: 20px; font-weight: 700; }

        /* TOPBAR */
        .admin-topbar {
            background: white; height: 64px; position: fixed; top: 0;
            left: var(--sidebar-w); right: 0; z-index: 1040;
            display: flex; align-items: center; padding: 0 24px;
            box-shadow: 0 1px 15px rgba(0,0,0,.06);
        }
        .topbar-title { font-size: 1rem; font-weight: 700; color: #333; }
        .topbar-user { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .topbar-avatar { width: 38px; height: 38px; background: linear-gradient(135deg,var(--red),var(--red-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem; }

        /* MAIN CONTENT */
        .admin-main { margin-left: var(--sidebar-w); margin-top: 64px; padding: 28px 28px; min-height: calc(100vh - 64px); }

        /* CARDS */
        .admin-card { background: white; border-radius: 14px; box-shadow: 0 2px 15px rgba(0,0,0,.06); border: none; }
        .admin-card .card-header { background: none; border-bottom: 1px solid #f0f0f0; padding: 18px 24px; font-weight: 700; font-size: 0.95rem; }
        .stat-card { background: white; border-radius: 14px; padding: 20px; box-shadow: 0 2px 15px rgba(0,0,0,.06); overflow: hidden; position: relative; }
        .stat-card .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .stat-card .stat-value { font-size: 2rem; font-weight: 800; line-height: 1; color: #1a1a2e; margin-bottom: 4px; }
        .stat-card .stat-label { font-size: 0.8rem; color: #888; font-weight: 500; }
        .stat-card .stat-bg-icon { position: absolute; right: -8px; bottom: -8px; font-size: 4.5rem; opacity: .05; }

        /* TABLES */
        .admin-table { font-size: 0.875rem; }
        .admin-table th { font-weight: 600; color: #666; text-transform: uppercase; font-size: 0.72rem; letter-spacing: .5px; padding: 12px 16px; background: #f8f9fa; border: none; }
        .admin-table td { padding: 12px 16px; vertical-align: middle; border-color: #f5f5f5; color: #444; }
        .admin-table tr:hover td { background: #fafafa; }

        /* FORMS */
        .form-label { font-weight: 600; font-size: 0.85rem; color: #444; margin-bottom: 6px; }
        .form-control, .form-select { border-color: #e8e8e8; border-radius: 10px; font-size: 0.875rem; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--red); box-shadow: 0 0 0 .2rem rgba(192,48,74,.1); }
        .btn-admin-primary { background: linear-gradient(135deg,var(--red),var(--red-dark)); border: none; color: white; font-weight: 600; border-radius: 10px; padding: 10px 20px; }
        .btn-admin-primary:hover { opacity: .9; color: white; }

        /* MOBILE */
        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-topbar, .admin-main { left: 0; margin-left: 0; }
        }

        /* ALERTS */
        .alert-success { background: #f0fff4; border-color: #68d391; color: #276749; }
        .alert-danger { background: #fff5f5; border-color: #fc8181; color: #c53030; }
    </style>
    @yield('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="brand d-flex gap-2 align-items-center text-decoration-none">
            <div class="sidebar-logo">
                @if($adminLogoUrl)
                    <img src="{{ $adminLogoUrl }}" alt="{{ $adminSingkatan }}" style="width:100%;height:100%;object-fit:contain;padding:4px;border-radius:10px;">
                @else
                    {{ $adminSingkatan }}
                @endif
            </div>
            <div>
                <div class="brand-title">{{ $adminSingkatan }} Admin</div>
                <div class="brand-sub">FEB UNTAG Semarang</div>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
        </a>

        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.beranda.index') }}" class="sidebar-link {{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">
            <i class="bi bi-house-heart"></i> Konten Beranda
        </a>
        <a href="{{ route('admin.sambutan.index') }}" class="sidebar-link {{ request()->routeIs('admin.sambutan.*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote"></i> Sambutan Ketua
        </a>
        <a href="{{ route('admin.berita.index') }}" class="sidebar-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Berita
        </a>
        <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
            <i class="bi bi-bell"></i> Pengumuman
        </a>
        <a href="{{ route('admin.jadwal-pmb.index') }}" class="sidebar-link {{ request()->routeIs('admin.jadwal-pmb.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Jadwal PMB
        </a>
        <a href="{{ route('admin.konsentrasi.index') }}" class="sidebar-link {{ request()->routeIs('admin.konsentrasi.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Konsentrasi
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="sidebar-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Galeri
        </a>
        <a href="{{ route('admin.dosen.index') }}" class="sidebar-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Dosen & Staf
        </a>
        <a href="{{ route('admin.pejabat.index') }}" class="sidebar-link {{ request()->routeIs('admin.pejabat.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-2"></i> Struktur & Pejabat
        </a>

        <div class="sidebar-section">Komunikasi</div>
        <a href="{{ route('admin.pesan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Pesan Masuk
            @php $pesanBaru = \App\Models\PesanKontak::where('is_read', false)->count(); @endphp
            @if($pesanBaru > 0)
            <span class="sidebar-badge">{{ $pesanBaru }}</span>
            @endif
        </a>

        <div class="sidebar-section">Sistem</div>
        <a href="{{ route('admin.menu.index') }}" class="sidebar-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
            <i class="bi bi-menu-button-wide"></i> Menu Navigasi
        </a>
        <a href="{{ route('admin.halaman.index') }}" class="sidebar-link {{ request()->routeIs('admin.halaman.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-richtext"></i> Halaman Dinamis
        </a>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>

        <div class="sidebar-section">Akun</div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 text-start" style="background:none;">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </nav>
</aside>

{{-- TOPBAR --}}
<div class="admin-topbar">
    <button class="btn btn-sm d-lg-none me-3" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
        <i class="bi bi-list fs-5"></i>
    </button>
    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
    <div class="ms-auto d-flex align-items-center gap-3">
        <a href="{{ route('admin.pesan.index') }}" class="position-relative text-muted">
            <i class="bi bi-bell fs-5"></i>
            @if($pesanBaru > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.65rem;">{{ $pesanBaru }}</span>
            @endif
        </a>
        <div class="dropdown">
            <div class="topbar-user dropdown-toggle" data-bs-toggle="dropdown">
                <div class="topbar-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                <span class="d-none d-md-block" style="font-size:.875rem; font-weight:600; color:#333;">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                <li><h6 class="dropdown-header">{{ auth()->user()->email ?? '' }}</h6></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- MAIN --}}
<main class="admin-main">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
