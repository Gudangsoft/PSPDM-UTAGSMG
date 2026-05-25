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

        @php
            $authUser   = auth()->user();
            $pesanBaru  = \App\Models\PesanKontak::where('is_read', false)->count();
        @endphp

        @if($authUser->hasPermission('sdm'))
        <div class="sidebar-section">SDM & Akademik</div>
        <a href="{{ route('admin.konsentrasi.index') }}" class="sidebar-link {{ request()->routeIs('admin.konsentrasi.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Konsentrasi
        </a>
        <a href="{{ route('admin.kurikulum.index') }}" class="sidebar-link {{ request()->routeIs('admin.kurikulum.*') ? 'active' : '' }}">
            <i class="bi bi-book-half"></i> Kurikulum
        </a>
        <a href="{{ route('admin.jadwal-akademik.index') }}" class="sidebar-link {{ request()->routeIs('admin.jadwal-akademik.*') ? 'active' : '' }}">
            <i class="bi bi-calendar3-week"></i> Jadwal Akademik
        </a>
        <a href="{{ route('admin.jabatan.index') }}" class="sidebar-link {{ request()->routeIs('admin.jabatan.*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Jabatan Akademik
        </a>
        <a href="{{ route('admin.dosen.index') }}" class="sidebar-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Dosen & Staf
        </a>
        <a href="{{ route('admin.pejabat.index') }}" class="sidebar-link {{ request()->routeIs('admin.pejabat.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-2"></i> Struktur & Pejabat
        </a>
        <a href="{{ route('admin.sambutan.index') }}" class="sidebar-link {{ request()->routeIs('admin.sambutan.*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote"></i> Sambutan Ketua
        </a>
        <a href="{{ route('admin.riset-unggulan.index') }}" class="sidebar-link {{ request()->routeIs('admin.riset-unggulan.*') ? 'active' : '' }}">
            <i class="bi bi-lightbulb"></i> Unggulan Riset
        </a>
        <a href="{{ route('admin.publikasi.index') }}" class="sidebar-link {{ request()->routeIs('admin.publikasi.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> Publikasi & Riset
        </a>
        <a href="{{ route('admin.testimonial.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonial.*') ? 'active' : '' }}">
            <i class="bi bi-chat-left-quote"></i> Testimoni Alumni
        </a>
        @endif

        @if($authUser->hasPermission('konten'))
        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.beranda.index') }}" class="sidebar-link {{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">
            <i class="bi bi-house-heart"></i> Konten Beranda
        </a>
        <a href="{{ route('admin.berita.index') }}" class="sidebar-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Berita
        </a>
        <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
            <i class="bi bi-bell"></i> Pengumuman
        </a>
        <a href="{{ route('admin.agenda.index') }}" class="sidebar-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Agenda & Kegiatan
        </a>
        <a href="{{ route('admin.faq.index') }}" class="sidebar-link {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
            <i class="bi bi-question-circle"></i> FAQ
        </a>
        <a href="{{ route('admin.download.index') }}" class="sidebar-link {{ request()->routeIs('admin.download.*') ? 'active' : '' }}">
            <i class="bi bi-download"></i> Download Center
        </a>
        <a href="{{ route('admin.halaman.index') }}" class="sidebar-link {{ request()->routeIs('admin.halaman.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-richtext"></i> Halaman Dinamis
        </a>
        @endif

        @if($authUser->hasPermission('galeri'))
        @if(!$authUser->hasPermission('konten'))<div class="sidebar-section">Konten</div>@endif
        <a href="{{ route('admin.galeri.index') }}" class="sidebar-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Galeri Foto
        </a>
        <a href="{{ route('admin.album.index') }}" class="sidebar-link {{ request()->routeIs('admin.album.*') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i> Album
        </a>
        @endif

        @if($authUser->hasPermission('pmb'))
        <div class="sidebar-section">PMB</div>
        <a href="{{ route('admin.jadwal-pmb.index') }}" class="sidebar-link {{ request()->routeIs('admin.jadwal-pmb.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Jadwal PMB
        </a>
        @endif

        @if($authUser->hasPermission('komunikasi'))
        <div class="sidebar-section">Komunikasi</div>
        <a href="{{ route('admin.pesan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Pesan Masuk
            @if($pesanBaru > 0)
            <span class="sidebar-badge">{{ $pesanBaru }}</span>
            @endif
        </a>
        <a href="{{ route('admin.wa.index') }}" class="sidebar-link {{ request()->routeIs('admin.wa.*') ? 'active' : '' }}">
            <i class="bi bi-whatsapp"></i> WA Blaster
        </a>
        <a href="{{ route('admin.mail.index') }}" class="sidebar-link {{ request()->routeIs('admin.mail.*') ? 'active' : '' }}">
            <i class="bi bi-envelope-paper"></i> Kirim Email
        </a>
        @endif

        @if($authUser->hasPermission('sistem'))
        <div class="sidebar-section">Sistem</div>
        <a href="{{ route('admin.menu.index') }}" class="sidebar-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
            <i class="bi bi-menu-button-wide"></i> Menu Navigasi
        </a>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
        <a href="{{ route('admin.activity-log.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity-log.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Log Aktivitas
        </a>
        <a href="{{ route('admin.export.pesan') }}" class="sidebar-link" title="Export CSV">
            <i class="bi bi-file-earmark-spreadsheet"></i> Export Pesan CSV
        </a>
        <a href="{{ route('admin.export.dosen') }}" class="sidebar-link" title="Export CSV">
            <i class="bi bi-file-earmark-spreadsheet"></i> Export Dosen CSV
        </a>
        @endif

        @if($authUser->hasPermission('hak_akses'))
        <div class="sidebar-section">Hak Akses</div>
        <a href="{{ route('admin.hak-akses.index') }}" class="sidebar-link {{ request()->routeIs('admin.hak-akses.*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock"></i> Role & Pengguna
        </a>
        @endif

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
                @if($authUser->foto)
                <img src="{{ $authUser->foto_url }}" class="topbar-avatar" style="object-fit:cover;border:2px solid #f5c0cc;">
                @else
                <div class="topbar-avatar">{{ strtoupper(substr($authUser->name ?? 'A', 0, 1)) }}</div>
                @endif
                <span class="d-none d-md-block" style="font-size:.875rem; font-weight:600; color:#333;">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3" style="min-width:200px;">
                <li><h6 class="dropdown-header" style="font-size:.78rem;">{{ auth()->user()->email ?? '' }}</h6></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                        <i class="bi bi-person-gear me-2 text-muted"></i>Edit Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
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
<script>
// ── Password: eye toggle + strength bar ──────────────────────
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="password"]').forEach(function (input) {
        // Wrap in relative container
        var wrapper = document.createElement('div');
        wrapper.style.cssText = 'position:relative;';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        // Eye button
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.innerHTML = '<i class="bi bi-eye"></i>';
        btn.title = 'Tampilkan password';
        btn.style.cssText = 'position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:#aaa;cursor:pointer;padding:2px 4px;font-size:1rem;line-height:1;z-index:5;';
        btn.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.innerHTML = show ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
            btn.title = show ? 'Sembunyikan password' : 'Tampilkan password';
            btn.style.color = show ? '#C0304A' : '#aaa';
        });
        input.style.paddingRight = '40px';
        wrapper.appendChild(btn);

        // Strength bar — only for new-password fields (name="password")
        if (input.name === 'password') {
            var meter = document.createElement('div');
            meter.style.cssText = 'margin-top:5px;';
            meter.innerHTML =
                '<div style="height:5px;border-radius:3px;background:#eee;overflow:hidden;">' +
                    '<div class="pw-bar" style="height:100%;width:0;border-radius:3px;transition:width .3s,background .3s;"></div>' +
                '</div>' +
                '<div class="pw-label" style="font-size:.72rem;margin-top:3px;font-weight:600;"></div>';
            wrapper.parentNode.insertBefore(meter, wrapper.nextSibling);

            input.addEventListener('input', function () {
                var val = input.value;
                var bar   = meter.querySelector('.pw-bar');
                var label = meter.querySelector('.pw-label');
                if (!val) { bar.style.width = '0'; label.textContent = ''; return; }

                var score = 0;
                if (val.length >= 8)  score++;
                if (val.length >= 12) score++;
                if (/[A-Z]/.test(val)) score++;
                if (/[0-9]/.test(val)) score++;
                if (/[^A-Za-z0-9]/.test(val)) score++;

                var levels = [
                    { pct: '20%', color: '#ef4444', text: 'Sangat Lemah' },
                    { pct: '40%', color: '#f97316', text: 'Lemah' },
                    { pct: '60%', color: '#eab308', text: 'Sedang' },
                    { pct: '80%', color: '#22c55e', text: 'Kuat' },
                    { pct: '100%', color: '#16a34a', text: 'Sangat Kuat' },
                ];
                var lvl = levels[Math.min(score - 1, 4)];
                bar.style.width       = lvl.pct;
                bar.style.background  = lvl.color;
                label.textContent     = lvl.text;
                label.style.color     = lvl.color;
            });
        }
    });
});
</script>
@yield('scripts')
</body>
</html>
