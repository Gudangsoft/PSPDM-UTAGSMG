@extends('layouts.app')
@section('title', 'Agenda & Kegiatan - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')
@section('og_title', 'Agenda & Kegiatan – ' . ($site['singkatan']?->value ?? 'PSMPD') . ' FEB UNTAG Semarang')
@section('og_description', 'Jadwal agenda dan kegiatan Program Studi ' . ($site['nama_prodi']?->value ?? 'Manajemen Program Doktor') . ' FEB UNTAG Semarang.')

@section('styles')
<style>
/* ── Agenda page ────────────────────────────────────────────────────────── */

/* Upcoming agenda card */
.agenda-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 22px rgba(0,0,0,0.07);
    overflow: hidden;
    display: flex;
    transition: transform 0.25s, box-shadow 0.25s;
}
.agenda-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.12);
}

/* Date block (left column) */
.agenda-date-block {
    background: linear-gradient(155deg, var(--red-primary) 0%, var(--red-dark) 100%);
    color: #fff;
    min-width: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 16px;
    text-align: center;
    flex-shrink: 0;
}
.agenda-date-block .day {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1;
    font-family: 'Inter', sans-serif;
}
.agenda-date-block .month-year {
    font-size: 0.72rem;
    font-weight: 600;
    opacity: 0.9;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 4px;
    line-height: 1.4;
}

/* Agenda body (right column) */
.agenda-body {
    padding: 20px 24px;
    flex: 1;
    min-width: 0;
}
.agenda-body .agenda-title {
    font-weight: 700;
    font-size: 1.05rem;
    color: var(--dark);
    margin-bottom: 6px;
}
.agenda-body .agenda-desc {
    font-size: 0.85rem;
    color: var(--gray-text);
    line-height: 1.65;
    margin-bottom: 12px;
}
.agenda-meta-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    color: #555;
    background: #f8f9fa;
    border-radius: 20px;
    padding: 4px 12px;
    margin-right: 6px;
    margin-bottom: 4px;
}
.agenda-meta-badge i { color: var(--red-primary); }

/* Date range strip */
.agenda-date-range {
    font-size: 0.75rem;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    background: rgba(0,0,0,0.18);
    border-radius: 4px;
    padding: 2px 8px;
    margin-top: 6px;
    text-align: center;
}

/* Section divider label */
.section-label {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}
.section-label h2 {
    font-size: 1.45rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    white-space: nowrap;
}
.section-label::after {
    content: '';
    flex: 1;
    height: 2px;
    background: linear-gradient(to right, var(--red-primary), transparent);
    border-radius: 2px;
}

/* Past agenda list */
.past-agenda-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 12px 18px;
    background: #fff;
    border-radius: 10px;
    border-left: 4px solid #e0e0e0;
    transition: border-color 0.2s, background 0.2s;
}
.past-agenda-item:hover {
    border-left-color: var(--red-primary);
    background: #fff8f9;
}
.past-date-pill {
    background: #f0f0f0;
    color: #555;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    white-space: nowrap;
    flex-shrink: 0;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    margin-top: 2px;
}
.past-agenda-title {
    font-weight: 600;
    font-size: 0.88rem;
    color: var(--dark);
    margin-bottom: 2px;
}
.past-agenda-meta {
    font-size: 0.75rem;
    color: var(--gray-text);
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: var(--gray-text);
}
.empty-state i { font-size: 3rem; color: #ddd; display: block; margin-bottom: 14px; }

@media (max-width: 576px) {
    .agenda-date-block .day { font-size: 2rem; }
    .agenda-date-block { min-width: 80px; padding: 16px 12px; }
    .agenda-body { padding: 16px; }
}
</style>
@endsection

@section('content')

{{-- ── PAGE HERO ──────────────────────────────────────────────────────────── --}}
<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-calendar-event me-2"></i>Agenda &amp; Kegiatan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Agenda &amp; Kegiatan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN CONTENT ───────────────────────────────────────────────────────── --}}
<section class="py-5" style="background:#f8f9fa;">
    <div class="container-xl">

        {{-- ═══════════════════════ AGENDA MENDATANG ═══════════════════════ --}}
        <div class="mb-5">
            <div class="section-label">
                <h2><i class="bi bi-calendar2-check me-2 text-danger"></i>Agenda Mendatang</h2>
            </div>

            @if($mendatang->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-calendar2-x"></i>
                    <h6 style="font-weight:700; color:var(--dark);">Belum ada agenda mendatang.</h6>
                    <p class="text-muted" style="font-size:0.85rem;">
                        Informasi agenda akan diperbarui secara berkala. Silakan cek kembali halaman ini.
                    </p>
                </div>
            @else
                <div class="d-flex flex-column gap-3">
                    @foreach($mendatang as $a)
                    @php
                        // Set locale Bahasa Indonesia for Carbon
                        $a->tanggal_mulai->locale('id');
                        $mulai = $a->tanggal_mulai;
                        $selesai = $a->tanggal_selesai;
                        $hasRange = $selesai && $selesai->format('Y-m-d') !== $mulai->format('Y-m-d');
                        // Month + Year in Indonesian
                        $bulan = $mulai->isoFormat('MMMM');
                        $tahun = $mulai->format('Y');
                    @endphp
                    <div class="agenda-card" data-aos="fade-up">
                        {{-- Date block --}}
                        <div class="agenda-date-block">
                            <div class="day">{{ $mulai->format('d') }}</div>
                            <div class="month-year">{{ $bulan }}<br>{{ $tahun }}</div>
                            @if($hasRange)
                            @php
                                $selesai->locale('id');
                                $bulanSelesai = $selesai->isoFormat('MMMM');
                            @endphp
                            <div class="agenda-date-range">
                                s/d {{ $selesai->format('d') }} {{ $bulanSelesai }}
                            </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="agenda-body">
                            <div class="agenda-title">{{ $a->judul }}</div>
                            @if($a->deskripsi)
                                <div class="agenda-desc">
                                    {{ Str::limit($a->deskripsi, 150) }}
                                </div>
                            @endif
                            <div class="d-flex flex-wrap align-items-center gap-1">
                                @if($a->waktu)
                                    <span class="agenda-meta-badge">
                                        <i class="bi bi-clock"></i>
                                        {{ $a->waktu }}
                                    </span>
                                @endif
                                @if($a->lokasi)
                                    <span class="agenda-meta-badge">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $a->lokasi }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ═══════════════════════ AGENDA TELAH BERLANGSUNG ═══════════════ --}}
        @if($lewat->isNotEmpty())
        <div data-aos="fade-up">
            <div class="section-label">
                <h2><i class="bi bi-calendar2-minus me-2" style="color:#999;"></i>Agenda Telah Berlangsung</h2>
            </div>

            <div class="d-flex flex-column gap-2">
                @foreach($lewat as $a)
                @php
                    $a->tanggal_mulai->locale('id');
                    $tgl = $a->tanggal_mulai;
                    $bulanPast = $tgl->isoFormat('MMM');
                @endphp
                <div class="past-agenda-item">
                    <div class="past-date-pill">
                        {{ $tgl->format('d') }} {{ $bulanPast }} {{ $tgl->format('Y') }}
                    </div>
                    <div style="min-width:0;">
                        <div class="past-agenda-title">{{ $a->judul }}</div>
                        <div class="past-agenda-meta d-flex flex-wrap gap-2">
                            @if($a->waktu)
                                <span><i class="bi bi-clock me-1"></i>{{ $a->waktu }}</span>
                            @endif
                            @if($a->lokasi)
                                <span><i class="bi bi-geo-alt me-1"></i>{{ $a->lokasi }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
