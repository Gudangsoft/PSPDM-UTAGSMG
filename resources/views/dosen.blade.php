@extends('layouts.app')
@section('title', 'Tim Dosen - ' . ($site['singkatan']?->value ?? 'PSMPD'))
@section('og_title', 'Tim Dosen & Peneliti - Program Doktor Manajemen FEB UNTAG Semarang')
@section('og_description', 'Kenali para akademisi dan peneliti terbaik yang membimbing Program Doktor Manajemen FEB UNTAG Semarang.')

@section('styles')
<style>
:root {
    --crimson: #B91C1C;
    --crimson-dark: #7F1D1D;
    --navy: #0F172A;
    --navy-mid: #1E293B;
    --gold: #D4A853;
    --off-white: #F8F7F4;
}

/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
.faculty-hero {
    background: var(--navy);
    padding: 72px 0 0;
    position: relative;
    overflow: hidden;
}
/* Decorative diagonal red stripe */
.faculty-hero::after {
    content: '';
    position: absolute;
    top: 0; right: -80px;
    width: 420px; height: 100%;
    background: linear-gradient(160deg, transparent 30%, rgba(185,28,28,.08) 30%, rgba(185,28,28,.12) 70%, transparent 70%);
    pointer-events: none;
}
/* Dot grid pattern */
.faculty-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 28px 28px;
}

.hero-inner { position: relative; z-index: 2; }

.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    color: var(--gold); font-size: .72rem; font-weight: 700;
    letter-spacing: .2em; text-transform: uppercase;
    margin-bottom: 20px;
}
.hero-eyebrow::before {
    content: '';
    display: block; width: 36px; height: 2px;
    background: var(--gold);
}

.faculty-hero h1 {
    font-family: 'Playfair Display', serif;
    color: #fff;
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 20px;
    letter-spacing: -.02em;
}
.faculty-hero h1 em {
    font-style: italic;
    color: transparent;
    -webkit-text-stroke: 1.5px rgba(255,255,255,.5);
}

.hero-desc {
    color: rgba(255,255,255,.55);
    font-size: .95rem; line-height: 1.8;
    max-width: 480px; margin-bottom: 0;
}

/* Stats row */
.hero-stats {
    display: flex; gap: 0;
    border-top: 1px solid rgba(255,255,255,.08);
    margin-top: 48px;
}
.hero-stat {
    flex: 1; padding: 24px 0;
    border-right: 1px solid rgba(255,255,255,.08);
    text-align: center;
}
.hero-stat:last-child { border-right: none; }
.hero-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem; font-weight: 700;
    color: #fff; line-height: 1;
    margin-bottom: 4px;
}
.hero-stat-num span { color: var(--gold); }
.hero-stat-lbl { font-size: .7rem; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: .1em; }

/* ══════════════════════════════════════
   FILTER / NAV TABS
══════════════════════════════════════ */
.faculty-filter {
    background: var(--navy-mid);
    border-bottom: 1px solid rgba(255,255,255,.06);
    position: sticky; top: 62px; z-index: 99;
}
.faculty-filter-inner {
    display: flex; gap: 0;
    overflow-x: auto; scrollbar-width: none;
}
.faculty-filter-inner::-webkit-scrollbar { display: none; }
.ftab {
    padding: 14px 24px;
    font-size: .8rem; font-weight: 600;
    color: rgba(255,255,255,.45);
    border: none; background: none;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
    transition: color .2s, border-color .2s;
    letter-spacing: .04em; text-transform: uppercase;
}
.ftab:hover { color: rgba(255,255,255,.8); }
.ftab.active { color: #fff; border-bottom-color: var(--crimson); }

/* ══════════════════════════════════════
   GRID
══════════════════════════════════════ */
.faculty-grid-wrap {
    background: var(--off-white);
    padding: 64px 0 96px;
}

/* ── Card ── */
.faculty-card {
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    display: flex; flex-direction: column;
    height: 100%;
    transition: box-shadow .3s, transform .3s;
    position: relative;
}
.faculty-card::before {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--crimson);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform .35s cubic-bezier(.4,0,.2,1);
}
.faculty-card:hover::before { transform: scaleY(1); }
.faculty-card:hover {
    box-shadow: 0 24px 64px rgba(0,0,0,.13);
    transform: translateY(-4px);
}

/* Photo */
.fc-photo {
    width: 100%;
    background: #f1f1ef;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    position: relative;
}
.fc-photo img {
    width: 100%; height: auto;
    display: block; object-fit: contain;
    transition: transform .5s cubic-bezier(.4,0,.2,1);
}
.faculty-card:hover .fc-photo img { transform: scale(1.04); }

/* Overlay on hover */
.fc-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(15,23,42,.82) 0%, transparent 50%);
    opacity: 0;
    transition: opacity .3s;
    display: flex; align-items: flex-end; justify-content: center;
    padding-bottom: 18px; gap: 8px;
}
.faculty-card:hover .fc-overlay { opacity: 1; }
.fc-overlay-link {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(255,255,255,.92);
    color: var(--navy); display: flex; align-items: center; justify-content: center;
    font-size: .85rem; text-decoration: none;
    transition: background .2s, color .2s, transform .2s;
}
.fc-overlay-link:hover { background: var(--crimson); color: #fff; transform: scale(1.1); }

/* Body */
.fc-body { padding: 24px 24px 20px; flex: 1; display: flex; flex-direction: column; }

.fc-jabatan {
    font-size: .65rem; font-weight: 700;
    color: var(--crimson); letter-spacing: .14em;
    text-transform: uppercase; margin-bottom: 6px;
}
.fc-nama {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem; font-weight: 700;
    color: var(--navy); line-height: 1.3;
    margin-bottom: 10px;
}
.fc-divider {
    height: 1px; background: #e5e7eb;
    margin-bottom: 12px;
}
.fc-kons {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: .66rem; font-weight: 600;
    color: #6B7280; letter-spacing: .04em;
    margin-bottom: 10px;
}
.fc-bio {
    font-size: .8rem; color: #9CA3AF; line-height: 1.7;
    margin-bottom: 18px; flex: 1;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden;
}
.fc-links { display: flex; gap: 4px; margin-bottom: 16px; flex-wrap: wrap; }
.fc-link {
    width: 28px; height: 28px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: .75rem; text-decoration: none;
    color: #9CA3AF; background: #F3F4F6;
    transition: background .2s, color .2s;
}
.fc-link:hover { background: var(--crimson); color: #fff; }

/* CTA */
.fc-cta {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px;
    border: 1px solid #E5E7EB;
    border-radius: 4px;
    text-decoration: none;
    color: var(--navy); font-size: .78rem; font-weight: 700;
    letter-spacing: .04em; text-transform: uppercase;
    transition: background .2s, border-color .2s, color .2s;
    margin-top: auto;
}
.fc-cta:hover { background: var(--navy); border-color: var(--navy); color: #fff; }
.fc-cta .fc-cta-arrow {
    width: 24px; height: 24px; border-radius: 50%;
    background: var(--navy); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem;
    transition: background .2s;
}
.fc-cta:hover .fc-cta-arrow { background: var(--crimson); }

/* No result */
.no-result { display:none; text-align:center; padding:80px 20px; color:#9CA3AF; }
.no-result i { font-size:3rem; display:block; margin-bottom:16px; }

/* ══════════════════════════════════════
   MOBILE
══════════════════════════════════════ */
@media (max-width: 991px) {
    .faculty-hero { padding: 48px 0 0; }
    .faculty-hero h1 { font-size: 2.4rem; }
    .hero-stats { flex-wrap: wrap; }
    .hero-stat { flex: 0 0 50%; border-bottom: 1px solid rgba(255,255,255,.08); }
    .hero-stat:nth-child(2) { border-right: none; }
}
@media (max-width: 767px) {
    .faculty-hero { padding: 36px 0 0; }
    .faculty-hero h1 { font-size: 1.9rem; }
    .hero-desc { font-size: .88rem; }
    .faculty-filter { top: 56px; }
    .ftab { padding: 12px 16px; font-size: .72rem; }
    .hero-stat-num { font-size: 1.5rem; }
    .faculty-grid-wrap { padding: 40px 0 64px; }
    .fc-body { padding: 18px 18px 16px; }
    .fc-overlay { opacity: 1; background: linear-gradient(to top, rgba(15,23,42,.75) 0%, transparent 45%); }
}
@media (max-width: 575px) {
    .hero-stat { flex: 0 0 50%; }
    .faculty-hero h1 { font-size: 1.65rem; }
}
</style>
@endsection

@section('content')

{{-- ══ HERO ══ --}}
<div class="faculty-hero">
    <div class="container-xl">
        <div class="hero-inner">
            <div class="row align-items-end">
                <div class="col-lg-7 pb-0">
                    <div class="hero-eyebrow">Program Doktor Manajemen</div>
                    <h1>Tim <em>Akademisi</em><br>&amp; Peneliti</h1>
                    <p class="hero-desc">Para Guru Besar, Doktor, dan peneliti terbaik yang membimbing perjalanan ilmiah Anda menuju kontribusi nyata bagi ilmu manajemen.</p>
                </div>
                <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-end">
                    <div style="text-align:right; padding-bottom:8px;">
                        <a href="{{ route('halaman.show', 'pendaftaran') }}"
                           style="display:inline-flex;align-items:center;gap:10px;background:var(--crimson);color:#fff;padding:14px 28px;border-radius:4px;font-size:.82rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;text-decoration:none;transition:background .2s;"
                           onmouseover="this.style.background='var(--crimson-dark)'" onmouseout="this.style.background='var(--crimson)'">
                            Daftar Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats bar --}}
    @php
        $totalDosen = $dosen->count();
        $guruBesar  = $dosen->filter(fn($d)=>str_contains(strtolower($d->jabatan),'guru besar')||str_contains(strtolower($d->jabatan),'profesor'))->count();
        $hasScholar = $dosen->whereNotNull('google_scholar')->count();
        $konsCount  = $dosen->pluck('konsentrasi')->filter()->unique()->count();
    @endphp
    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-num">{{ $totalDosen }}<span>+</span></div>
            <div class="hero-stat-lbl">Dosen Aktif</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num">{{ $guruBesar }}</div>
            <div class="hero-stat-lbl">Guru Besar</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num">{{ $hasScholar }}</div>
            <div class="hero-stat-lbl">Google Scholar</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-num">{{ $konsCount }}</div>
            <div class="hero-stat-lbl">Konsentrasi</div>
        </div>
    </div>
</div>

{{-- ══ FILTER TABS ══ --}}
@php $konsentrasiList = $dosen->pluck('konsentrasi')->filter()->unique()->values(); @endphp
<div class="faculty-filter">
    <div class="container-xl">
        <div class="faculty-filter-inner">
            <button class="ftab active" data-filter="semua">Semua Dosen</button>
            @foreach($konsentrasiList as $kons)
            <button class="ftab" data-filter="{{ Str::slug($kons) }}">{{ $kons }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- ══ GRID ══ --}}
<div class="faculty-grid-wrap">
    <div class="container-xl">
        @if($dosen->count() > 0)
        <div class="row g-4" id="faculty-grid">
            @foreach($dosen as $d)
            <div class="col-sm-6 col-lg-4 faculty-item" data-konsentrasi="{{ Str::slug($d->konsentrasi) }}">
                <div class="faculty-card">

                    {{-- Photo --}}
                    <div class="fc-photo">
                        <img src="{{ $d->foto_url }}"
                             alt="{{ $d->nama }}"
                             loading="lazy"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($d->nama) }}&background=1E293B&color=ffffff&size=400&bold=true'">
                        <div class="fc-overlay">
                            @if($d->email)
                            <a href="mailto:{{ $d->email }}" class="fc-overlay-link" title="Email"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                            @if($d->google_scholar)
                            <a href="{{ $d->google_scholar }}" target="_blank" class="fc-overlay-link" title="Google Scholar"><i class="bi bi-mortarboard-fill"></i></a>
                            @endif
                            @if(!empty($d->sinta_url))
                            <a href="{{ $d->sinta_url }}" target="_blank" class="fc-overlay-link" title="SINTA"><i class="bi bi-journal-richtext"></i></a>
                            @endif
                            <a href="{{ route('dosen.show', $d) }}" class="fc-overlay-link" title="Profil Lengkap"><i class="bi bi-person-fill"></i></a>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="fc-body">
                        <div class="fc-jabatan">{{ $d->jabatan }}</div>
                        <div class="fc-nama">{{ $d->nama }}</div>
                        <div class="fc-divider"></div>
                        @if($d->konsentrasi)
                        <div class="fc-kons"><i class="bi bi-bookmark-fill" style="font-size:.55rem;color:var(--crimson);"></i> {{ $d->konsentrasi }}</div>
                        @endif
                        <p class="fc-bio">{{ $d->bio ?: 'Dosen Program Doktor Manajemen FEB UNTAG Semarang dengan keahlian di bidang ' . ($d->keahlian ? Str::limit($d->keahlian, 60) : 'manajemen strategis.') }}</p>
                        <div class="fc-links">
                            @if($d->email)
                            <a href="mailto:{{ $d->email }}" class="fc-link" title="Email"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                            @if($d->google_scholar)
                            <a href="{{ $d->google_scholar }}" target="_blank" class="fc-link" title="Google Scholar"><i class="bi bi-mortarboard-fill"></i></a>
                            @endif
                            @if(!empty($d->sinta_url))
                            <a href="{{ $d->sinta_url }}" target="_blank" class="fc-link" title="SINTA"><i class="bi bi-journal-richtext"></i></a>
                            @endif
                            @if(!empty($d->scopus_url))
                            <a href="{{ $d->scopus_url }}" target="_blank" class="fc-link" title="Scopus"><i class="bi bi-file-earmark-text-fill"></i></a>
                            @endif
                            @if(!empty($d->researchgate_url))
                            <a href="{{ $d->researchgate_url }}" target="_blank" class="fc-link" title="ResearchGate"><i class="bi bi-people-fill"></i></a>
                            @endif
                        </div>
                        <a href="{{ route('dosen.show', $d) }}" class="fc-cta">
                            Lihat Profil
                            <span class="fc-cta-arrow"><i class="bi bi-arrow-right"></i></span>
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <div class="no-result" id="no-result">
            <i class="bi bi-search"></i>
            Tidak ada dosen pada konsentrasi ini.
        </div>

        @else
        <div class="text-center py-5" style="color:#9CA3AF;">
            <i class="bi bi-people" style="font-size:4rem; display:block; margin-bottom:16px;"></i>
            <p>Data dosen belum tersedia.</p>
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
    const tabs  = document.querySelectorAll('.ftab');
    const items = document.querySelectorAll('.faculty-item');
    const noRes = document.getElementById('no-result');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            let visible  = 0;

            items.forEach(item => {
                const match = filter === 'semua' || item.dataset.konsentrasi === filter;
                item.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            if (noRes) noRes.style.display = visible === 0 ? 'block' : 'none';
        });
    });
})();
</script>
@endsection
