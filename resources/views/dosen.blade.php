@extends('layouts.app')
@section('title', 'Tim Dosen - ' . ($site['singkatan']?->value ?? 'PSMPD'))
@section('og_title', 'Tim Dosen & Peneliti - Program Doktor Manajemen FEB UNTAG Semarang')
@section('og_description', 'Kenali para akademisi dan peneliti terbaik yang membimbing Program Doktor Manajemen FEB UNTAG Semarang.')

@section('styles')
<style>
/* ── Hero ── */
.dosen-hero {
    background:
        radial-gradient(ellipse 60% 80% at 100% 50%, rgba(192,48,74,.2) 0%, transparent 55%),
        linear-gradient(148deg, #1a1a2e 0%, #16213e 40%, #0f172a 100%);
    padding: 60px 0 50px; position: relative; overflow: hidden;
}
.dosen-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
}
.dosen-hero h1 { color:#fff; font-size:clamp(1.8rem,4vw,2.6rem); font-weight:800; margin-bottom:10px; }
.dosen-hero p  { color:rgba(255,255,255,.75); font-size:1rem; max-width:520px; }
.hero-stat-pill {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.18);
    color:#fff; border-radius:50px; padding:6px 18px;
    font-size:.82rem; font-weight:600;
}
.hero-stat-pill strong { color:#f87171; }
.breadcrumb-dark .breadcrumb-item, .breadcrumb-dark .breadcrumb-item a { color:rgba(255,255,255,.55); font-size:.82rem; }
.breadcrumb-dark .breadcrumb-item.active { color:#fff; }
.breadcrumb-dark .breadcrumb-item+.breadcrumb-item::before { color:rgba(255,255,255,.35); }

/* ── Filter bar ── */
.filter-bar {
    background:#fff; border-bottom:1px solid #f0f0f0;
    padding:14px 0; position:sticky; top:62px; z-index:99;
    box-shadow:0 2px 12px rgba(0,0,0,.06);
}
.filter-btn {
    border:1.5px solid #e5e7eb; background:#fff; color:#6b7280;
    border-radius:50px; padding:6px 18px;
    font-size:.82rem; font-weight:600;
    cursor:pointer; transition:all .2s; white-space:nowrap;
    display:inline-block;
}
.filter-btn:hover { border-color:#C0304A; color:#C0304A; }
.filter-btn.active { background:#C0304A; border-color:#C0304A; color:#fff; }

/* ── Dosen card ── */
.dosen-card {
    background:#fff; border-radius:16px; overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,.07); border:1px solid #f0f0f0;
    transition:transform .25s, box-shadow .25s;
    height:100%; display:flex; flex-direction:column;
}
.dosen-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,.13); }
.dosen-photo-wrap {
    position:relative; overflow:hidden;
    height:220px; background:#f3f4f6; flex-shrink:0;
}
.dosen-photo-wrap img {
    width:100%; height:100%; object-fit:cover; transition:transform .4s;
    object-position: top center;
}
.dosen-card:hover .dosen-photo-wrap img { transform:scale(1.06); }
.dosen-photo-overlay {
    position:absolute; inset:0;
    background:linear-gradient(to top, rgba(15,23,42,.88) 0%, transparent 55%);
    opacity:0; transition:opacity .3s;
    display:flex; align-items:flex-end; justify-content:center;
    padding-bottom:16px; gap:8px;
}
.dosen-card:hover .dosen-photo-overlay { opacity:1; }
.dosen-photo-overlay a {
    width:34px; height:34px; border-radius:50%;
    background:rgba(255,255,255,.9); color:#1a1a2e;
    display:flex; align-items:center; justify-content:center;
    font-size:.85rem; text-decoration:none;
    transition:background .2s, transform .2s;
}
.dosen-photo-overlay a:hover { background:#C0304A; color:#fff; transform:scale(1.12); }
.dosen-card-top { height:4px; background:linear-gradient(90deg, #C0304A, #8B1A2E, #e84a6a); }
.dosen-card-body { padding:20px; flex:1; display:flex; flex-direction:column; }
.dosen-konsentrasi {
    font-size:.67rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em;
    color:#C0304A; background:#fff5f5; border:1px solid #fecaca;
    padding:3px 10px; border-radius:20px; display:inline-block; margin-bottom:10px;
}
.dosen-card .nama { font-size:.97rem; font-weight:800; color:#1a1a2e; margin-bottom:2px; line-height:1.3; }
.dosen-card .jabatan { font-size:.77rem; color:#6b7280; margin-bottom:10px; font-weight:500; }
.dosen-card .bio-excerpt {
    font-size:.8rem; color:#9ca3af; line-height:1.65; margin-bottom:14px; flex:1;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.dosen-links { display:flex; gap:5px; flex-wrap:wrap; margin-bottom:14px; }
.dosen-link-icon {
    width:30px; height:30px; border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:.8rem; text-decoration:none;
    background:#f3f4f6; color:#6b7280; transition:background .2s, color .2s;
}
.dosen-link-icon:hover { background:#C0304A; color:#fff; }
.btn-profil {
    display:flex; align-items:center; justify-content:center; gap:6px;
    background:#1a1a2e; color:#fff; padding:9px 0; border-radius:10px;
    font-size:.82rem; font-weight:700; text-decoration:none;
    transition:background .2s; margin-top:auto;
}
.btn-profil:hover { background:#C0304A; color:#fff; }
.no-result { display:none; text-align:center; padding:60px 20px; color:#9ca3af; }

@media (max-width:767px) {
    .dosen-hero { padding:36px 0 44px; }
    .filter-bar { top:56px; }
    .filter-scroll { overflow-x:auto; padding-bottom:2px; }
    .dosen-photo-overlay { opacity:1; }
    .dosen-photo-wrap { height:190px; }
}
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="dosen-hero">
    <div class="container-xl position-relative">
        <nav aria-label="breadcrumb" class="breadcrumb-dark mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Tim Dosen</li>
            </ol>
        </nav>
        <h1>Tim Dosen &amp; Peneliti</h1>
        <p>Para akademisi dan peneliti terbaik yang membimbing perjalanan doktoral Anda menuju kontribusi ilmu manajemen yang orisinal.</p>
        <div class="d-flex flex-wrap gap-2 mt-4">
            <div class="hero-stat-pill"><strong>{{ $dosen->count() }}</strong>&nbsp;Dosen Aktif</div>
            @php $guruBesar = $dosen->filter(fn($d) => str_contains(strtolower($d->jabatan), 'guru besar') || str_contains(strtolower($d->jabatan), 'profesor')); @endphp
            @if($guruBesar->count())
            <div class="hero-stat-pill"><strong>{{ $guruBesar->count() }}</strong>&nbsp;Guru Besar</div>
            @endif
            @if($dosen->whereNotNull('google_scholar')->count())
            <div class="hero-stat-pill"><strong>{{ $dosen->whereNotNull('google_scholar')->count() }}</strong>&nbsp;Google Scholar</div>
            @endif
        </div>
    </div>
</div>

{{-- FILTER BAR --}}
@php $konsentrasiList = $dosen->pluck('konsentrasi')->filter()->unique()->values(); @endphp
@if($konsentrasiList->count() > 1)
<div class="filter-bar">
    <div class="container-xl">
        <div class="filter-scroll d-flex gap-2">
            <button class="filter-btn active" data-filter="semua">Semua</button>
            @foreach($konsentrasiList as $kons)
            <button class="filter-btn" data-filter="{{ Str::slug($kons) }}">{{ $kons }}</button>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- GRID DOSEN --}}
<section style="padding:56px 0 80px; background:#f8f9fb;">
    <div class="container-xl">
        @if($dosen->count() > 0)
        <div class="row g-4" id="dosen-grid">
            @foreach($dosen as $d)
            <div class="col-sm-6 col-lg-4 dosen-item" data-konsentrasi="{{ Str::slug($d->konsentrasi) }}">
                <div class="dosen-card">
                    <div class="dosen-card-top"></div>
                    <div class="dosen-photo-wrap">
                        <img src="{{ $d->foto_url }}"
                             alt="{{ $d->nama }}"
                             loading="lazy"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($d->nama) }}&background=C0304A&color=fff&size=220'">
                        <div class="dosen-photo-overlay">
                            @if($d->email)
                            <a href="mailto:{{ $d->email }}" title="Email"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                            @if($d->google_scholar)
                            <a href="{{ $d->google_scholar }}" target="_blank" title="Google Scholar"><i class="bi bi-mortarboard-fill"></i></a>
                            @endif
                            @if(!empty($d->sinta_url))
                            <a href="{{ $d->sinta_url }}" target="_blank" title="SINTA"><i class="bi bi-journal-richtext"></i></a>
                            @endif
                            <a href="{{ route('dosen.show', $d) }}" title="Lihat Profil"><i class="bi bi-person-fill"></i></a>
                        </div>
                    </div>
                    <div class="dosen-card-body">
                        @if($d->konsentrasi)
                        <span class="dosen-konsentrasi">{{ Str::limit($d->konsentrasi, 32) }}</span>
                        @endif
                        <div class="nama">{{ $d->nama }}</div>
                        <div class="jabatan"><i class="bi bi-patch-check-fill text-danger me-1" style="font-size:.65rem;"></i>{{ $d->jabatan }}</div>
                        <p class="bio-excerpt">{{ $d->bio ?: 'Dosen Program Doktor Manajemen FEB UNTAG Semarang.' }}</p>
                        <div class="dosen-links">
                            @if($d->email)
                            <a href="mailto:{{ $d->email }}" class="dosen-link-icon" title="Email"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                            @if($d->google_scholar)
                            <a href="{{ $d->google_scholar }}" target="_blank" class="dosen-link-icon" title="Google Scholar"><i class="bi bi-mortarboard-fill"></i></a>
                            @endif
                            @if(!empty($d->sinta_url))
                            <a href="{{ $d->sinta_url }}" target="_blank" class="dosen-link-icon" title="SINTA"><i class="bi bi-journal-richtext"></i></a>
                            @endif
                            @if(!empty($d->scopus_url))
                            <a href="{{ $d->scopus_url }}" target="_blank" class="dosen-link-icon" title="Scopus"><i class="bi bi-file-earmark-text-fill"></i></a>
                            @endif
                            @if(!empty($d->researchgate_url))
                            <a href="{{ $d->researchgate_url }}" target="_blank" class="dosen-link-icon" title="ResearchGate"><i class="bi bi-people-fill"></i></a>
                            @endif
                        </div>
                        <a href="{{ route('dosen.show', $d) }}" class="btn-profil">
                            <i class="bi bi-person-lines-fill"></i> Lihat Profil Lengkap
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="no-result" id="no-result">
            <i class="bi bi-search" style="font-size:2.5rem; display:block; margin-bottom:12px;"></i>
            Tidak ada dosen pada konsentrasi ini.
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-people" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Data dosen belum tersedia.</p>
        </div>
        @endif
    </div>
</section>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        let visible = 0;
        document.querySelectorAll('.dosen-item').forEach(item => {
            const match = filter === 'semua' || item.dataset.konsentrasi === filter;
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('no-result').style.display = visible === 0 ? 'block' : 'none';
    });
});
</script>
@endsection
