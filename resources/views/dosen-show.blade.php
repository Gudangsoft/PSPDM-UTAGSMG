@extends('layouts.app')
@section('title', $dosen->nama . ' - Tim Dosen ' . ($site['singkatan']?->value ?? 'PSMPD'))
@section('og_title', $dosen->nama . ' - Program Doktor Manajemen FEB UNTAG Semarang')
@section('og_description', $dosen->bio ? Str::limit(strip_tags($dosen->bio), 150) : 'Profil dosen Program Doktor Manajemen FEB UNTAG Semarang.')
@if($dosen->foto)@section('og_image', asset('storage/' . $dosen->foto))@endif

@section('styles')
<style>
/* ── Profile Hero ── */
.profile-hero {
    background:
        radial-gradient(ellipse 70% 80% at 100% 40%, rgba(192,48,74,.18) 0%, transparent 55%),
        linear-gradient(148deg, #1a1a2e 0%, #16213e 50%, #0f172a 100%);
    padding: 56px 0 0; position: relative; overflow: hidden;
}
.profile-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
}
.profile-photo {
    width: 160px; height: 160px;
    border-radius: 50%; object-fit: cover; object-position: top center;
    border: 5px solid rgba(255,255,255,.2);
    box-shadow: 0 12px 40px rgba(0,0,0,.4);
    background: #2d2d4e;
}
.profile-photo-fallback {
    width: 160px; height: 160px;
    border-radius: 50%;
    background: linear-gradient(135deg, #C0304A, #8B1A2E);
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem; font-weight: 900; color: #fff;
    border: 5px solid rgba(255,255,255,.2);
    box-shadow: 0 12px 40px rgba(0,0,0,.4);
    flex-shrink: 0;
}
.profile-nama { color: #fff; font-size: clamp(1.4rem, 3vw, 2rem); font-weight: 800; margin-bottom: 4px; }
.profile-jabatan { color: rgba(255,255,255,.65); font-size: .9rem; font-weight: 500; }
.profile-konsentrasi {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(192,48,74,.25); border: 1px solid rgba(192,48,74,.45);
    color: #fca5a5; border-radius: 50px; padding: 4px 14px;
    font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
    margin-top: 10px;
}
.profile-nidn {
    color: rgba(255,255,255,.45); font-size: .75rem; margin-top: 8px;
    font-family: 'Inter', monospace; letter-spacing: .05em;
}
.profile-quick-links { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 16px; }
.profile-qlink {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
    color: rgba(255,255,255,.85); border-radius: 50px;
    padding: 6px 16px; font-size: .78rem; font-weight: 600;
    text-decoration: none; transition: background .2s;
}
.profile-qlink:hover { background: #C0304A; border-color: #C0304A; color: #fff; }

/* ── Wave separator ── */
.profile-wave {
    display: block; width: 100%; height: 48px;
    background: #f8f9fb;
    clip-path: ellipse(55% 100% at 50% 100%);
    margin-top: -1px;
}

/* ── Content sections ── */
.profile-content { padding: 48px 0 80px; background: #f8f9fb; }

.info-card {
    background: #fff; border-radius: 16px;
    border: 1px solid #f0f0f0;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    overflow: hidden; margin-bottom: 24px;
}
.info-card-header {
    padding: 16px 24px;
    border-bottom: 1px solid #f5f5f5;
    display: flex; align-items: center; gap: 10px;
}
.info-card-header .icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: linear-gradient(135deg, #C0304A, #8B1A2E);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: .9rem; flex-shrink: 0;
}
.info-card-header h5 { font-size: .95rem; font-weight: 800; color: #1a1a2e; margin: 0; }
.info-card-body { padding: 24px; }

/* Bio */
.bio-text {
    font-size: .93rem; line-height: 1.9; color: #374151;
    white-space: pre-line;
}

/* Keahlian chips */
.keahlian-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: #fff5f5; border: 1px solid #fecaca;
    color: #C0304A; border-radius: 50px;
    padding: 5px 14px; font-size: .8rem; font-weight: 600; margin: 4px;
}

/* Profile sidebar */
.sidebar-card {
    background: #fff; border-radius: 16px;
    border: 1px solid #f0f0f0;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    padding: 24px; margin-bottom: 20px;
}
.sidebar-card h6 { font-size: .82rem; font-weight: 800; color: #6b7280; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px; }
.profile-info-row { display: flex; flex-direction: column; gap: 14px; }
.profile-info-item { display: flex; gap: 12px; align-items: flex-start; }
.profile-info-item .pi-icon {
    width: 32px; height: 32px; border-radius: 8px;
    background: #f3f4f6; color: #C0304A;
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem; flex-shrink: 0; margin-top: 2px;
}
.profile-info-item .pi-label { font-size: .72rem; color: #9ca3af; font-weight: 600; margin-bottom: 2px; }
.profile-info-item .pi-value { font-size: .88rem; color: #374151; font-weight: 600; word-break: break-all; }
.profile-info-item a.pi-value { color: #C0304A; text-decoration: none; }
.profile-info-item a.pi-value:hover { text-decoration: underline; }

/* Research links */
.research-link {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: 10px; border: 1px solid #f0f0f0;
    text-decoration: none; color: #374151;
    transition: border-color .2s, background .2s;
    margin-bottom: 8px;
}
.research-link:hover { background: #fff5f5; border-color: #fecaca; color: #C0304A; }
.research-link .rl-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; flex-shrink: 0;
}
.research-link .rl-label { font-size: .82rem; font-weight: 700; }
.research-link .rl-sub { font-size: .72rem; color: #9ca3af; }

/* Back button */
.btn-back {
    display: inline-flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,.7); font-size: .82rem; font-weight: 600;
    text-decoration: none; margin-bottom: 28px;
    transition: color .2s;
}
.btn-back:hover { color: #fff; }
.btn-back-bottom {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1a1a2e; color: #fff;
    padding: 12px 28px; border-radius: 50px;
    font-size: .88rem; font-weight: 700;
    text-decoration: none; transition: background .2s;
}
.btn-back-bottom:hover { background: #C0304A; color: #fff; }

@media (max-width: 767px) {
    .profile-hero { padding: 36px 0 0; }
    .profile-photo, .profile-photo-fallback { width: 120px; height: 120px; font-size: 2.2rem; }
    .profile-nama { font-size: 1.35rem; }
    .profile-content { padding: 36px 0 60px; }
    .info-card-body { padding: 18px; }
    .sidebar-card { padding: 18px; }
}
</style>
@endsection

@section('content')

{{-- ── PROFILE HERO ── --}}
<div class="profile-hero">
    <div class="container-xl position-relative">
        <a href="{{ route('dosen') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Tim Dosen
        </a>

        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-4 pb-10">
            {{-- Photo --}}
            <div style="flex-shrink:0;">
                @if($dosen->foto)
                <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama }}" class="profile-photo">
                @else
                <div class="profile-photo-fallback">{{ strtoupper(substr($dosen->nama, 0, 1)) }}</div>
                @endif
            </div>

            {{-- Info --}}
            <div class="pb-4 pb-md-8" style="padding-bottom:32px;">
                <div class="profile-jabatan mb-2">{{ $dosen->jabatan }}</div>
                <div class="profile-nama">{{ $dosen->nama }}</div>
                @if($dosen->konsentrasi)
                <div><span class="profile-konsentrasi"><i class="bi bi-bookmark-fill"></i> {{ $dosen->konsentrasi }}</span></div>
                @endif
                @if($dosen->nidn)
                <div class="profile-nidn">NIDN: {{ $dosen->nidn }}</div>
                @endif

                <div class="profile-quick-links">
                    @if($dosen->email)
                    <a href="mailto:{{ $dosen->email }}" class="profile-qlink">
                        <i class="bi bi-envelope-fill"></i> Email
                    </a>
                    @endif
                    @if($dosen->google_scholar)
                    <a href="{{ $dosen->google_scholar }}" target="_blank" class="profile-qlink">
                        <i class="bi bi-mortarboard-fill"></i> Google Scholar
                    </a>
                    @endif
                    @if(!empty($dosen->sinta_url))
                    <a href="{{ $dosen->sinta_url }}" target="_blank" class="profile-qlink">
                        <i class="bi bi-journal-richtext"></i> SINTA
                    </a>
                    @endif
                    @if(!empty($dosen->scopus_url))
                    <a href="{{ $dosen->scopus_url }}" target="_blank" class="profile-qlink">
                        <i class="bi bi-file-earmark-text-fill"></i> Scopus
                    </a>
                    @endif
                    @if(!empty($dosen->researchgate_url))
                    <a href="{{ $dosen->researchgate_url }}" target="_blank" class="profile-qlink">
                        <i class="bi bi-people-fill"></i> ResearchGate
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="profile-wave"></div>
</div>

{{-- ── CONTENT ── --}}
<div class="profile-content">
    <div class="container-xl">
        <div class="row g-4">

            {{-- MAIN: Bio & Keahlian --}}
            <div class="col-lg-8">

                {{-- Biografi --}}
                @if($dosen->bio)
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                        <h5>Biografi</h5>
                    </div>
                    <div class="info-card-body">
                        <div class="bio-text">{{ $dosen->bio }}</div>
                    </div>
                </div>
                @endif

                {{-- Bidang Keahlian --}}
                @if($dosen->keahlian)
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon"><i class="bi bi-lightning-charge-fill"></i></div>
                        <h5>Bidang Keahlian</h5>
                    </div>
                    <div class="info-card-body">
                        <div>
                            @foreach(array_filter(array_map('trim', preg_split('/[,;\n]+/', $dosen->keahlian))) as $keahlian)
                            <span class="keahlian-chip"><i class="bi bi-check-circle-fill" style="font-size:.7rem;"></i>{{ $keahlian }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Publikasi & Profil Akademik --}}
                @if($dosen->google_scholar || !empty($dosen->sinta_url) || !empty($dosen->scopus_url) || !empty($dosen->researchgate_url))
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                        <h5>Profil Akademik &amp; Publikasi</h5>
                    </div>
                    <div class="info-card-body">
                        @if($dosen->google_scholar)
                        <a href="{{ $dosen->google_scholar }}" target="_blank" rel="noopener" class="research-link">
                            <div class="rl-icon" style="background:#e8f0fe; color:#4285f4;"><i class="bi bi-mortarboard-fill"></i></div>
                            <div>
                                <div class="rl-label">Google Scholar</div>
                                <div class="rl-sub">Lihat daftar publikasi ilmiah</div>
                            </div>
                            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.75rem; color:#9ca3af;"></i>
                        </a>
                        @endif
                        @if(!empty($dosen->sinta_url))
                        <a href="{{ $dosen->sinta_url }}" target="_blank" rel="noopener" class="research-link">
                            <div class="rl-icon" style="background:#fff0e6; color:#e06000;"><i class="bi bi-journal-richtext"></i></div>
                            <div>
                                <div class="rl-label">SINTA (Science and Technology Index)</div>
                                <div class="rl-sub">Profil dan skor SINTA</div>
                            </div>
                            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.75rem; color:#9ca3af;"></i>
                        </a>
                        @endif
                        @if(!empty($dosen->scopus_url))
                        <a href="{{ $dosen->scopus_url }}" target="_blank" rel="noopener" class="research-link">
                            <div class="rl-icon" style="background:#fff5e6; color:#f47c00;"><i class="bi bi-file-earmark-text-fill"></i></div>
                            <div>
                                <div class="rl-label">Scopus</div>
                                <div class="rl-sub">Profil publikasi terindeks Scopus</div>
                            </div>
                            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.75rem; color:#9ca3af;"></i>
                        </a>
                        @endif
                        @if(!empty($dosen->researchgate_url))
                        <a href="{{ $dosen->researchgate_url }}" target="_blank" rel="noopener" class="research-link">
                            <div class="rl-icon" style="background:#e8f7f4; color:#00a89d;"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <div class="rl-label">ResearchGate</div>
                                <div class="rl-sub">Jaringan dan kolaborasi riset</div>
                            </div>
                            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.75rem; color:#9ca3af;"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Back button --}}
                <div class="text-center mt-4">
                    <a href="{{ route('dosen') }}" class="btn-back-bottom">
                        <i class="bi bi-arrow-left"></i> Kembali ke Tim Dosen
                    </a>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                {{-- Informasi Dosen --}}
                <div class="sidebar-card">
                    <h6>Informasi Dosen</h6>
                    <div class="profile-info-row">
                        @if($dosen->nidn)
                        <div class="profile-info-item">
                            <div class="pi-icon"><i class="bi bi-person-badge-fill"></i></div>
                            <div>
                                <div class="pi-label">NIDN</div>
                                <div class="pi-value">{{ $dosen->nidn }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="profile-info-item">
                            <div class="pi-icon"><i class="bi bi-patch-check-fill"></i></div>
                            <div>
                                <div class="pi-label">Jabatan Akademik</div>
                                <div class="pi-value">{{ $dosen->jabatan }}</div>
                            </div>
                        </div>
                        @if($dosen->konsentrasi)
                        <div class="profile-info-item">
                            <div class="pi-icon"><i class="bi bi-bookmark-fill"></i></div>
                            <div>
                                <div class="pi-label">Konsentrasi</div>
                                <div class="pi-value">{{ $dosen->konsentrasi }}</div>
                            </div>
                        </div>
                        @endif
                        @if($dosen->email)
                        <div class="profile-info-item">
                            <div class="pi-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <div class="pi-label">Email</div>
                                <a href="mailto:{{ $dosen->email }}" class="pi-value">{{ $dosen->email }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Kontak Cepat --}}
                @if($dosen->email)
                <div class="sidebar-card" style="text-align:center; background:linear-gradient(135deg,#1a1a2e,#16213e); color:#fff; border:none;">
                    <div style="width:52px; height:52px; border-radius:14px; background:rgba(192,48,74,.3); display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:1.3rem; color:#fca5a5;">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div style="font-weight:800; font-size:.95rem; margin-bottom:6px;">Hubungi Dosen</div>
                    <div style="font-size:.78rem; color:rgba(255,255,255,.6); margin-bottom:16px;">Kirim email untuk konsultasi akademik</div>
                    <a href="mailto:{{ $dosen->email }}"
                       style="display:inline-flex; align-items:center; gap:6px; background:#C0304A; color:#fff; padding:9px 22px; border-radius:50px; font-size:.82rem; font-weight:700; text-decoration:none; transition:background .2s;"
                       onmouseover="this.style.background='#8B1A2E'" onmouseout="this.style.background='#C0304A'">
                        <i class="bi bi-envelope-fill"></i> Kirim Email
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
